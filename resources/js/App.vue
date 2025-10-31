<template>
    <div id="app" class="min-h-screen bg-background">
        <router-view />
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useAuthStore } from './stores/auth';

const authStore = useAuthStore();

onMounted(() => {
  // Try to fetch user if token exists
  const token = localStorage.getItem('token');
  if (token) {
    authStore.fetchMe();
  }
});
</script>

<style>
/* Global styles if needed */
</style>

