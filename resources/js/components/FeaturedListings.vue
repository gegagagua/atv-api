<template>
  <section class="py-16 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-foreground">{{ t('featured.title') }}</h2>
        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-10 px-4 py-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground border-atv-orange text-atv-orange hover:bg-atv-orange hover:text-white">
          {{ t('featured.viewAll') }}
        </button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div
          v-for="listing in featuredListings"
          :key="listing.id"
          class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-shadow cursor-pointer"
        >
          <div class="p-0">
            <div class="bg-atv-gray rounded-t-lg h-48 flex items-center justify-center text-6xl">
              {{ listing.image }}
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
import { useLanguage } from '../composables/useLanguage';

const { t } = useLanguage();

const featuredListings = [
  {
    id: 1,
    title: '2024 Polaris RZR XP 1000',
    price: '$21,999',
    location: 'Dallas, TX',
    mileage: 'New',
    image: '🏁',
    dealer: 'Dallas ATV',
    features: ['4WD', 'Sport', 'Side by Side'],
  },
  {
    id: 2,
    title: '2023 Can-Am Defender HD8',
    price: '$18,499',
    location: 'Phoenix, AZ',
    mileage: '125 miles',
    image: '🔴',
    dealer: 'Desert ATVs',
    features: ['Utility', 'Work Ready', 'HD Series'],
  },
  {
    id: 3,
    title: '2024 Honda Pioneer 1000',
    price: '$19,999',
    location: 'Denver, CO',
    mileage: 'New',
    image: '🔴',
    dealer: 'Rocky Mountain Honda',
    features: ['6-Speed', '3-Seater', 'Trail Ready'],
  },
  {
    id: 4,
    title: '2023 Yamaha YXZ1000R SS',
    price: '$22,799',
    location: 'Atlanta, GA',
    mileage: '50 miles',
    image: '🔵',
    dealer: 'Southern ATVs',
    features: ['Sport', 'Manual Trans', 'Turbocharged'],
  },
];
</script>

