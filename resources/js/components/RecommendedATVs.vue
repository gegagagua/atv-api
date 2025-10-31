<template>
  <section class="py-16 bg-muted/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-foreground">Recommended ATVs</h2>
        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground border-atv-orange text-atv-orange hover:bg-atv-orange hover:text-white">
          View All Recommendations
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
          v-if="loading"
          class="col-span-full text-center py-8 text-muted-foreground"
        >
          Loading recommended ATVs...
        </div>
        <div
          v-for="atv in recommendedATVs"
          :key="atv.id"
          @click="handleCardClick(atv)"
          class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow cursor-pointer bg-white"
        >
          <div class="p-0">
            <div class="relative">
              <div
                v-if="atv.image"
                class="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center overflow-hidden"
              >
                <img :src="atv.image" :alt="atv.title" class="w-full h-full object-cover" />
              </div>
              <div
                v-else
                class="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center text-6xl"
              >
                🏁
              </div>
              <span
                v-if="atv.originalPrice"
                class="absolute top-2 right-2 inline-flex items-center rounded-full border border-transparent bg-primary text-primary-foreground hover:bg-primary/80 px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-atv-orange text-white"
              >
                Save ${{ parseInt(atv.originalPrice.replace(/[$,]/g, '')) - parseInt(atv.price.replace(/[$,]/g, '')) }}
              </span>
            </div>
            <div class="p-4">
              <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-foreground text-sm line-clamp-2">
                  {{ atv.title }}
                </h3>
              </div>
              <div class="flex items-center gap-2 mb-2">
                <div class="text-2xl font-bold text-atv-orange">
                  {{ atv.price }}
                </div>
                <div v-if="atv.originalPrice" class="text-sm text-muted-foreground line-through">
                  {{ atv.originalPrice }}
                </div>
              </div>
              <div class="flex items-center gap-1 mb-2">
                <svg class="h-4 w-4 fill-yellow-400 text-yellow-400" viewBox="0 0 24 24">
                  <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
                <span class="text-sm font-medium">{{ atv.rating }}</span>
                <span class="text-sm text-muted-foreground">({{ atv.reviews }})</span>
              </div>
              <div class="text-sm text-muted-foreground mb-2">
                {{ atv.mileage }} • {{ atv.location }}
              </div>
              <div class="text-sm text-muted-foreground mb-3">
                {{ atv.dealer }}
              </div>
              <div class="flex flex-wrap gap-1">
                <span
                  v-for="feature in atv.features.slice(0, 2)"
                  :key="feature"
                  class="inline-flex items-center rounded-full border border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
                >
                  {{ feature }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import { getAtvs } from '../services/atv';

const router = useRouter();
const recommendedATVs = ref([]);
const loading = ref(true);

const formatPrice = (price) => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(price);
};

const formatListing = (atv) => {
  return {
    id: atv.id,
    title: atv.name || `${atv.year || ''} ${atv.brand?.title || ''} ${atv.name || ''}`.trim(),
    price: formatPrice(atv.price),
    originalPrice: null, // Can add original price logic if needed
    location: atv.location?.name || 'N/A',
    mileage: atv.mileage ? `${atv.mileage} miles` : 'New',
    image: atv.first_image_url || null,
    dealer: atv.user?.name || 'Private Seller',
    rating: 4.5, // Can add rating system later
    reviews: Math.floor(Math.random() * 200), // Placeholder
    features: [
      atv.transmission && `Transmission: ${atv.transmission}`,
      atv.engine && `Engine: ${atv.engine}`,
      atv.fuel && `Fuel: ${atv.fuel}`,
    ].filter(Boolean).slice(0, 2),
  };
};

const handleCardClick = (atv) => {
  router.push(`/find-atvs?id=${atv.id}`);
};

onMounted(async () => {
  try {
    loading.value = true;
    const res = await getAtvs({
      active_only: true,
      per_page: 4,
    });
    if (res.data && res.data.data) {
      recommendedATVs.value = res.data.data.map(formatListing);
    }
  } catch (error) {
    console.error('Error loading recommended ATVs:', error);
  } finally {
    loading.value = false;
  }
});
</script>

