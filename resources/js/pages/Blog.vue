<template>
  <Layout>
    <main class="py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-foreground mb-6">{{ t('blog.title') }}</h1>
        
        <div v-if="loading" class="text-center py-12 text-muted-foreground">
          Loading blog posts...
        </div>
        
        <div v-else-if="blogs.length === 0" class="bg-card border border-border rounded-lg p-8 text-center">
          <h2 class="text-xl font-semibold text-foreground mb-4">ATV News, Tips & Guides</h2>
          <p class="text-muted-foreground">
            No blog posts available at the moment. Check back soon!
          </p>
        </div>
        
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="blog in blogs"
            :key="blog.id"
            @click="goToBlog(blog.id)"
            class="bg-card border border-border rounded-lg overflow-hidden hover:shadow-lg transition-shadow cursor-pointer"
          >
            <div v-if="blog.image" class="h-48 overflow-hidden bg-atv-gray">
              <img :src="blog.image" :alt="blog.title" class="w-full h-full object-cover" />
            </div>
            <div v-else class="h-48 bg-atv-gray flex items-center justify-center text-6xl">
              📝
            </div>
            <div class="p-6">
              <h2 class="text-xl font-semibold text-foreground mb-2 line-clamp-2">
                {{ blog.title }}
              </h2>
              <p v-if="blog.description" class="text-sm text-muted-foreground mb-4 line-clamp-3">
                {{ blog.description }}
              </p>
              <div class="flex items-center justify-between text-xs text-muted-foreground">
                <span>{{ formatDate(blog.created_at) }}</span>
                <span class="text-atv-orange hover:underline">Read more →</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Pagination -->
        <div v-if="totalPages > 1" class="flex justify-center items-center gap-2 mt-8">
          <button
            @click="changePage(currentPage - 1)"
            :disabled="currentPage === 1"
            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground"
          >
            Previous
          </button>
          
          <span class="text-sm text-muted-foreground">
            Page {{ currentPage }} of {{ totalPages }}
          </span>
          
          <button
            @click="changePage(currentPage + 1)"
            :disabled="currentPage === totalPages"
            class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground"
          >
            Next
          </button>
        </div>
      </div>
    </main>
  </Layout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { useLanguage } from '../composables/useLanguage';
import { getBlogs } from '../services/blog';
import Layout from '../components/Layout.vue';

const { t } = useLanguage();
const router = useRouter();

const blogs = ref([]);
const loading = ref(true);
const currentPage = ref(1);
const totalPages = ref(1);

const formatDate = (dateString) => {
  if (!dateString) return '';
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
};

const goToBlog = (id) => {
  router.push(`/blog/${id}`);
};

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page;
    loadBlogs();
  }
};

const loadBlogs = async () => {
  try {
    loading.value = true;
    const res = await getBlogs({
      page: currentPage.value,
      per_page: 12,
      active_only: true,
    });
    if (res.data) {
      blogs.value = res.data.data || [];
      totalPages.value = res.data.last_page || 1;
    }
  } catch (error) {
    console.error('Error loading blogs:', error);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  loadBlogs();
});
</script>
