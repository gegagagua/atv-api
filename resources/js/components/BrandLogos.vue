<template>
  <section class="py-16 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-foreground">
          {{ t('brands.title') }}
        </h2>
        <div class="flex space-x-2">
          <span class="inline-flex items-center rounded-full border border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-foreground text-background">
            {{ t('brands.makes') }}
          </span>
          <span class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 text-foreground">
            {{ t('brands.types') }}
          </span>
        </div>
      </div>

      <div class="flex items-center justify-between mb-6">
        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-9 rounded-md px-3 hover:bg-accent hover:text-accent-foreground">
          <svg class="h-5 w-5 pointer-events-none shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <div v-if="loading" class="flex-1 mx-4 text-center py-8 text-muted-foreground">
          Loading brands...
        </div>
        <div v-else class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 flex-1 mx-4">
          <div
            v-for="brand in brands.slice(0, 6)"
            :key="brand.id"
            class="bg-card border border-border rounded-lg p-6 hover:shadow-md transition-shadow cursor-pointer text-center flex flex-col items-center justify-center"
          >
            <div v-if="brand.image" class="mb-3 h-16 w-16 flex items-center justify-center">
              <img 
                :src="brand.image" 
                :alt="brand.name + ' logo'" 
                class="max-h-full max-w-full object-contain"
                onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'64\' height=\'64\'%3E%3Crect width=\'64\' height=\'64\' fill=\'%23f3f4f6\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\' font-size=\'24\' fill=\'%239ca3af\'%3E🏁%3C/text%3E%3C/svg%3E'"
              />
            </div>
            <div v-else class="mb-3 h-16 w-16 flex items-center justify-center text-4xl">
              🏁
            </div>
            <h3 class="font-semibold text-foreground">{{ brand.name }}</h3>
          </div>
        </div>

        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-9 rounded-md px-3 hover:bg-accent hover:text-accent-foreground">
          <svg class="h-5 w-5 pointer-events-none shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>
      </div>

      <div class="text-center">
        <a href="#" class="text-atv-orange hover:text-atv-orange-dark font-medium">
          {{ t('brands.seeAll') }}
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useLanguage } from '../composables/useLanguage';
import { getBrands } from '../services/atv';

const { t } = useLanguage();
const brands = ref([]);
const loading = ref(true);

onMounted(async () => {
  try {
    const res = await getBrands();
    if (res.data) {
      brands.value = res.data.map(brand => ({
        id: brand.id,
        name: brand.title,
        image: brand.image || null,
      }));
    }
  } catch (error) {
    console.error('Error loading brands:', error);
  } finally {
    loading.value = false;
  }
});
</script>

