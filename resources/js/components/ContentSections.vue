<template>
  <div class="py-16 space-y-0">
    <!-- Sell Section -->
    <section class="bg-atv-beige">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div>
            <div class="w-16 h-16 bg-atv-orange rounded-full flex items-center justify-center mb-6">
              <span class="text-2xl">🏍️</span>
            </div>
            <h2 class="text-3xl font-bold text-foreground mb-4">
              {{ t('sell.title') }}
            </h2>
            <p class="text-lg text-muted-foreground mb-6">
              {{ t('sell.description') }}
            </p>
            <button class="bg-atv-orange hover:bg-atv-orange-dark text-white px-6 py-3 rounded-md">
              {{ t('sell.button') }}
            </button>
          </div>
          <div class="bg-white rounded-lg p-8 shadow-sm">
            <div class="text-6xl text-center mb-4">🏁</div>
            <h3 class="text-xl font-semibold text-center text-foreground">
              {{ t('sell.today') }}
            </h3>
          </div>
        </div>
      </div>
    </section>

    <!-- Buy Online Section -->
    <section class="bg-gradient-to-r from-atv-orange to-orange-400 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div class="text-6xl">🛒</div>
          <div>
            <h2 class="text-3xl font-bold mb-4">{{ t('buyOnline.title') }}</h2>
            <p class="text-lg mb-6 text-white/90">
              {{ t('buyOnline.description') }}
            </p>
            <button class="bg-white text-atv-orange hover:bg-white/90 px-6 py-3 rounded-md">
              {{ t('buyOnline.button') }}
            </button>
          </div>
        </div>
      </div>
    </section>

    <!-- Info Section -->
    <section class="bg-background">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-foreground mb-8 text-center">
          {{ t('info.title') }}
        </h2>
        <div class="prose prose-lg max-w-none text-muted-foreground">
          <p>
            {{ t('info.description') }}
          </p>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { useLanguage } from '../composables/useLanguage';

const { t } = useLanguage();
</script>

