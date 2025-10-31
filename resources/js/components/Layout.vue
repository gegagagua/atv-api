<template>
  <div class="min-h-screen bg-background">
    <Header />
    <main>
      <slot />
    </main>
    <Footer />
  </div>
</template>

<script setup>
import Header from './Header.vue';
import Footer from './Footer.vue';
</script>

