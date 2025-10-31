<template>
  <section class="py-16 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between mb-8">
        <h2 class="text-2xl font-bold text-foreground">
          {{ t('brands.title') }}
        </h2>
        <div class="flex space-x-2">
          <span class="px-3 py-1 bg-foreground text-background rounded text-sm">
            {{ t('brands.makes') }}
          </span>
          <span class="px-3 py-1 border border-border rounded text-sm">
            {{ t('brands.types') }}
          </span>
        </div>
      </div>

      <div class="flex items-center justify-between mb-6">
        <button class="p-2 hover:bg-muted rounded-md">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

        <button class="p-2 hover:bg-muted rounded-md">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

