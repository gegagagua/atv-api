<template>
  <div class="rounded-lg border bg-card text-card-foreground shadow-sm group hover:shadow-lg transition-all duration-300 overflow-hidden cursor-pointer">
    <div class="relative">
      <div v-if="listing?.active_images && listing.active_images.length > 0" class="w-full h-48 overflow-hidden">
        <img
          :src="listing.active_images[0].url"
          :alt="listing.name"
          class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
        />
      </div>
      <div v-else class="w-full h-48 bg-atv-gray flex items-center justify-center text-6xl">
        🏁
      </div>
      <button
        @click.stop="toggleFavorite"
        :class="[
          'absolute top-2 right-2 h-8 w-8 rounded-full flex items-center justify-center',
          isFavorited
            ? 'bg-red-500 text-white hover:bg-red-600'
            : 'bg-white/80 text-gray-600 hover:bg-white'
        ]"
      >
        <svg
          :class="['h-4 w-4', isFavorited ? 'fill-current' : '']"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
      </button>
      <span class="absolute top-2 left-2 inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-green-200 bg-green-100 text-green-800">
        {{ listing.year }}
      </span>
    </div>

    <div class="p-4">
      <div class="flex justify-between items-start mb-2">
        <h4 class="font-semibold text-md text-foreground group-hover:text-primary transition-colors">
          {{ listing.name }}
        </h4>
        <div class="text-right">
          <div class="text-xl font-bold text-primary">
            {{ formatPrice(Number(listing.price)) }}
          </div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-2 mb-3 text-sm text-muted-foreground">
        <div class="flex items-center gap-1">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <span>{{ listing.year }} {{ t('listing.year') }}</span>
        </div>
        <div class="flex items-center gap-1 justify-end">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
          </svg>
          <span>{{ listing.mileage ? listing.mileage.toLocaleString() + ' ' + t('listing.mileage') : t('listing.new') }}</span>
        </div>
        <div v-if="listing?.location" class="flex items-center gap-1">
          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <span>{{ listing?.location?.name }}</span>
        </div>
        <div v-if="listing.engine" class="flex items-center gap-1 justify-end">
          <span class="font-medium">{{ listing.engine }}</span>
        </div>
      </div>

      <div class="flex flex-wrap gap-1 mb-3">
        <span class="inline-flex items-center rounded-full border border-transparent bg-secondary text-secondary-foreground hover:bg-secondary/80 px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2">
          {{ listing.transmission }}
        </span>
      </div>

      <div class="flex items-center justify-between text-sm text-muted-foreground mb-3">
        <div class="flex items-center gap-2">
          <span class="text-blue-600 font-medium">
            {{ listing.fuel }}
          </span>
        </div>
        <span>{{ dateToLocale(listing.created_at) }}</span>
      </div>

      <div class="flex gap-2">
        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 flex-1 h-10 px-4 py-2 bg-atv-orange hover:bg-atv-orange-dark text-white">
          <svg class="h-4 w-4 pointer-events-none shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
          </svg>
          {{ t('listing.call') }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useLanguage } from '../composables/useLanguage';
import { dateToLocale } from '../lib/utils';

const props = defineProps({
  listing: {
    type: Object,
    required: true,
  },
});

const { t } = useLanguage();
const isFavorited = ref(false);

const formatPrice = (price) => {
  return `₾${price.toLocaleString()}`;
};

const toggleFavorite = () => {
  isFavorited.value = !isFavorited.value;
};
</script>

