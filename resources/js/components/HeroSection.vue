<template>
  <section
    class="relative bg-cover bg-center bg-no-repeat py-20"
    :style="{ backgroundImage: `url(/images/atv-hero-bg.jpg)` }"
  >
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-lg">
        <div class="bg-atv-beige rounded-lg p-6 shadow-lg">
          <h1 class="text-2xl font-bold text-foreground mb-6">
            {{ t('hero.title') }}
          </h1>

          <div class="space-y-4">
            <input
              type="text"
              :placeholder="t('hero.searchPlaceholder')"
              class="w-full px-3 py-2 border border-border rounded-md"
            />

            <div class="flex space-x-4">
              <input
                type="text"
                :placeholder="t('hero.zipPlaceholder')"
                class="flex-1 px-3 py-2 border border-border rounded-md"
              />

              <select class="w-32 px-3 py-2 border border-border rounded-md">
                <option value="10">10 miles</option>
                <option value="25">25 miles</option>
                <option value="50">50 miles</option>
                <option value="75">75 miles</option>
                <option value="100">100 miles</option>
                <option value="150" selected>150 miles</option>
                <option value="250">250 miles</option>
                <option value="400">400 miles</option>
                <option value="500">500 miles</option>
                <option value="1000">1000 miles</option>
                <option value="nationwide">Nationwide</option>
              </select>
            </div>

            <div class="flex items-center space-x-2">
              <input
                id="online"
                type="checkbox"
                class="rounded border-border"
              />
              <label for="online" class="text-sm text-foreground">
                {{ t('hero.onlineListings') }}
              </label>
            </div>

            <button class="w-full bg-atv-orange hover:bg-atv-orange-dark text-white font-semibold py-3 rounded-md">
              {{ t('hero.searchButton') }}
            </button>

            <div class="text-center">
              <router-link to="/sell-my-atv" class="text-sm text-foreground hover:text-atv-orange underline">
                {{ t('hero.sellLink') }}
              </router-link>
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
</script>

