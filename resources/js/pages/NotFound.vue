<template>
  <Layout>
    <main class="py-16">
      <div class="max-w-4xl mx-auto px-4 text-center">
        <h1 class="text-6xl font-bold mb-4">404</h1>
        <p class="text-xl text-muted-foreground mb-8">Page Not Found</p>
        <router-link to="/" class="px-6 py-3 bg-atv-orange hover:bg-atv-orange-dark text-white rounded-md">
          Go Home
        </router-link>
      </div>
    </main>
  </Layout>
</template>

<script setup>
import Layout from '../components/Layout.vue';
</script>

