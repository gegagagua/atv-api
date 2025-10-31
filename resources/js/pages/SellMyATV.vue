<template>
  <Layout>
    <main class="py-16">
      <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">{{ t('sellMyATV.hero.title') }}</h1>
        <p class="text-xl text-muted-foreground mb-8">{{ t('sellMyATV.hero.subtitle') }}</p>
        <p class="text-center text-muted-foreground">Sell My ATV page - Coming soon</p>
      </div>
    </main>
  </Layout>
</template>

<script setup>
import { useLanguage } from '../composables/useLanguage';
import Layout from '../components/Layout.vue';

const { t } = useLanguage();
</script>

