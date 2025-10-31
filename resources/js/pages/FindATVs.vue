<template>
  <Layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex gap-6">
        <!-- Filters Sidebar -->
        <div v-if="showFilters" class="w-80 flex-shrink-0">
          <ATVFilters @filters-change="handleFiltersChange" />
        </div>

        <!-- Main Content -->
        <div class="flex-1">
          <!-- Results Header -->
          <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
              <button
                @click="showFilters = !showFilters"
                class="lg:hidden px-3 py-2 border border-border rounded-md text-sm flex items-center"
              >
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
                {{ t('filters.applyFilters') }}
              </button>
            </div>

            <div class="flex items-center gap-4">
              <!-- Sort Options -->
              <select v-model="sortBy" class="w-48 px-3 py-2 border border-border rounded-md">
                <option value="newest">Newest First</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
                <option value="year-new">Year: New to Old</option>
                <option value="year-old">Year: Old to New</option>
                <option value="mileage-low">Mileage: Low to High</option>
              </select>

              <!-- View Mode Toggle -->
              <div class="flex border border-border rounded-lg">
                <button
                  @click="viewMode = 'grid'"
                  :class="[
                    'p-2 rounded-r-none',
                    viewMode === 'grid' ? 'bg-atv-orange text-white' : 'bg-white'
                  ]"
                >
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                  </svg>
                </button>
                <button
                  @click="viewMode = 'list'"
                  :class="[
                    'p-2 rounded-l-none',
                    viewMode === 'list' ? 'bg-atv-orange text-white' : 'bg-white'
                  ]"
                >
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Listings Grid -->
          <div v-if="data.length > 0">
            <div
              :class="[
                viewMode === 'grid'
                  ? 'grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4'
                  : 'space-y-4'
              ]"
            >
              <ATVListingCard
                v-for="listing in data"
                :key="listing.id"
                :listing="listing"
              />
            </div>

            <!-- Pagination -->
            <div v-if="totalPages > 1" class="flex justify-center items-center gap-2 mt-8">
              <button
                @click="currentPage = Math.max(1, currentPage - 1)"
                :disabled="currentPage === 1"
                class="px-4 py-2 border border-border rounded-md disabled:opacity-50"
              >
                Previous
              </button>

              <button
                v-for="page in totalPages"
                :key="page"
                @click="currentPage = page"
                :class="[
                  'px-4 py-2 border rounded-md text-sm',
                  page === currentPage ? 'bg-atv-orange text-white' : 'border-border'
                ]"
              >
                {{ page }}
              </button>

              <button
                @click="currentPage = Math.min(totalPages, currentPage + 1)"
                :disabled="currentPage === totalPages"
                class="px-4 py-2 border border-border rounded-md disabled:opacity-50"
              >
                Next
              </button>
            </div>
          </div>
          <div v-else class="text-center py-12">
            <h3 class="text-lg font-semibold text-foreground mb-2">No ATVs Found</h3>
            <p class="text-muted-foreground">
              Try changing your search criteria or clearing the filters.
            </p>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useLanguage } from '../composables/useLanguage';
import { getAtvs } from '../services/atv';
import Layout from '../components/Layout.vue';
import ATVFilters from '../components/ATVFilters.vue';
import ATVListingCard from '../components/ATVListingCard.vue';

const { t } = useLanguage();

const sortBy = ref('newest');
const viewMode = ref('grid');
const showFilters = ref(true);
const filters = ref({});
const currentPage = ref(1);
const totalPages = ref(2);
const data = ref([]);

const handleFiltersChange = (newFilters) => {
  filters.value = newFilters;
  currentPage.value = 1;
  // TODO: Apply filters and reload data
};

onMounted(async () => {
  try {
    const res = await getAtvs('');
    if (res.data) {
      data.value = res.data?.data || [];
    }
  } catch (error) {
    console.error('Error loading ATVs:', error);
  }
});
</script>

