<template>
  <Layout>
    <main class="py-16">
      <div class="max-w-md mx-auto px-4">
        <div class="bg-white border border-border rounded-lg shadow-sm">
          <div class="p-6 text-center border-b border-border">
            <h1 class="text-2xl font-bold">{{ t('signup.title') }}</h1>
          </div>
          <div class="p-6">
            <p class="text-muted-foreground text-center">Signup page - Coming soon</p>
          </div>
        </div>
      </div>
    </main>
  </Layout>
</template>

<script setup>
import { useLanguage } from '../composables/useLanguage';
import Layout from '../components/Layout.vue';

const { t } = useLanguage();
</script>

