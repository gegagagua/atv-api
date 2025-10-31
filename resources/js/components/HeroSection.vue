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
                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
              />

              <div class="flex space-x-4">
                <input
                  type="text"
                  :placeholder="t('hero.zipPlaceholder')"
                  class="flex h-10 flex-1 rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                />

                <select class="flex h-10 w-32 items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
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
                  class="peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground"
                />
                <label for="online" class="text-sm text-foreground cursor-pointer">
                  {{ t('hero.onlineListings') }}
                </label>
              </div>

              <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 w-full bg-atv-orange hover:bg-atv-orange-dark text-white font-semibold py-3">
                {{ t('hero.searchButton') }}
              </button>

              <div class="text-center">
                <router-link to="/sell-my-atv" class="text-sm text-foreground hover:text-atv-orange underline underline-offset-4">
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

