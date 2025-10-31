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
          v-for="atv in recommendedATVs"
          :key="atv.id"
          class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow cursor-pointer bg-white"
        >
          <div class="p-0">
            <div class="relative">
              <div class="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center text-6xl">
                {{ atv.image }}
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

