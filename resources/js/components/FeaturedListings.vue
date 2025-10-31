<template>
  <section class="py-16 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-foreground">{{ t('featured.title') }}</h2>
        <router-link
          to="/find-atvs"
          class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground border-atv-orange text-atv-orange hover:bg-atv-orange hover:text-white"
        >
          {{ t('featured.viewAll') }}
        </router-link>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
          v-if="loading"
          class="col-span-full text-center py-8 text-muted-foreground"
        >
          Loading featured listings...
        </div>
        <div
          v-for="listing in featuredListings"
          :key="listing.id"
          @click="handleCardClick(listing)"
          class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow cursor-pointer"
        >
          <div class="p-0">
            <div
              v-if="listing.image"
              class="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center overflow-hidden"
            >
              <img :src="listing.image" :alt="listing.title" class="w-full h-full object-cover" />
            </div>
            <div
              v-else
              class="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center text-6xl"
            >
              🏁
            </div>
            <div class="p-4">
              <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-foreground text-sm line-clamp-2">
                  {{ listing.title }}
                </h3>
              </div>
              <div class="text-2xl font-bold text-atv-orange mb-2">
                {{ listing.price }}
              </div>
              <div class="text-sm text-muted-foreground mb-2">
                {{ listing.mileage }} • {{ listing.location }}
              </div>
              <div class="text-sm text-muted-foreground mb-3">
                {{ listing.dealer }}
              </div>
              <div class="flex flex-wrap gap-1">
                <span
                  v-for="feature in listing.features.slice(0, 2)"
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
import { useLanguage } from '../composables/useLanguage';
import { getAtvs } from '../services/atv';

const { t } = useLanguage();
const router = useRouter();
const featuredListings = ref([]);
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
    location: atv.location?.name || 'N/A',
    mileage: atv.mileage ? `${atv.mileage} miles` : 'New',
    image: atv.first_image_url || null,
    dealer: atv.user?.name || 'Private Seller',
    features: [
      atv.transmission && `Transmission: ${atv.transmission}`,
      atv.engine && `Engine: ${atv.engine}`,
      atv.fuel && `Fuel: ${atv.fuel}`,
    ].filter(Boolean).slice(0, 2),
  };
};

const handleCardClick = (listing) => {
  router.push(`/find-atvs?id=${listing.id}`);
};

onMounted(async () => {
  try {
    loading.value = true;
    const res = await getAtvs({
      vip_only: true,
      active_only: true,
      per_page: 4,
    });
    if (res.data && res.data.data) {
      featuredListings.value = res.data.data.map(formatListing);
    }
  } catch (error) {
    console.error('Error loading featured listings:', error);
  } finally {
    loading.value = false;
  }
});
</script>

