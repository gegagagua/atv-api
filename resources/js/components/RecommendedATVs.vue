<template>
  <section class="py-16 bg-muted/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-foreground">Recommended ATVs</h2>
        <button class="px-4 py-2 border border-atv-orange text-atv-orange hover:bg-atv-orange hover:text-white rounded-md">
          View All Recommendations
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
          v-for="atv in recommendedATVs"
          :key="atv.id"
          class="hover:shadow-lg transition-shadow cursor-pointer bg-white rounded-lg overflow-hidden"
        >
          <div class="relative">
            <div class="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center text-6xl">
              {{ atv.image }}
            </div>
            <span
              v-if="atv.originalPrice"
              class="absolute top-2 right-2 bg-atv-orange text-white px-2 py-1 rounded text-xs"
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
                class="px-2 py-1 bg-muted text-xs rounded"
              >
                {{ feature }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const recommendedATVs = [
  {
    id: 1,
    title: '2024 Kawasaki Brute Force 750',
    price: '$9,999',
    originalPrice: '$11,499',
    location: 'Miami, FL',
    mileage: 'New',
    image: '🟢',
    dealer: 'Miami Motorsports',
    rating: 4.8,
    reviews: 127,
    features: ['4x4', 'EPS', 'V-Force'],
  },
  {
    id: 2,
    title: '2023 CFMoto CForce 500 HO',
    price: '$6,799',
    location: 'Las Vegas, NV',
    mileage: '250 miles',
    image: '⚫',
    dealer: 'Vegas ATV Center',
    rating: 4.6,
    reviews: 89,
    features: ['CVT', '4WD', 'EPS'],
  },
  {
    id: 3,
    title: '2024 Suzuki KingQuad 750AXi',
    price: '$8,799',
    location: 'Seattle, WA',
    mileage: 'New',
    image: '🟡',
    dealer: 'Northwest ATVs',
    rating: 4.7,
    reviews: 156,
    features: ['Independent Suspension', '4x4', 'EFI'],
  },
  {
    id: 4,
    title: '2023 Polaris Sportsman 570',
    price: '$7,999',
    location: 'Chicago, IL',
    mileage: '75 miles',
    image: '🏁',
    dealer: 'Windy City ATVs',
    rating: 4.9,
    reviews: 203,
    features: ['All-Terrain', 'On-Demand AWD', 'Digital Display'],
  },
];
</script>

