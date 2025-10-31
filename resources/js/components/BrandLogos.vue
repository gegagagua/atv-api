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

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 flex-1 mx-4">
          <div
            v-for="brand in brands.slice(0, 6)"
            :key="brand.name"
            class="bg-card border border-border rounded-lg p-6 hover:shadow-md transition-shadow cursor-pointer text-center"
          >
            <div class="text-4xl mb-3">{{ brand.logo }}</div>
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
import { useLanguage } from '../composables/useLanguage';

const { t } = useLanguage();

const brands = [
  { name: 'Polaris', logo: '🏁' },
  { name: 'Can-Am', logo: '🔴' },
  { name: 'Honda', logo: '🔴' },
  { name: 'Kawasaki', logo: '🟢' },
  { name: 'Yamaha', logo: '🔵' },
  { name: 'CFMoto', logo: '⚫' },
  { name: 'Suzuki', logo: '🟡' },
  { name: 'Kayo USA', logo: '🟠' },
  { name: 'Segway', logo: '⚪' },
  { name: 'Club Car', logo: '🔵' },
];
</script>

