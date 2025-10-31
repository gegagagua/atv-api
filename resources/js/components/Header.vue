<template>
  <header class="bg-background border-b border-atv-gray">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo -->
        <div class="flex items-center">
          <router-link to="/" class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-atv-orange rounded flex items-center justify-center">
              <span class="text-white font-bold text-sm">ATV</span>
            </div>
            <span class="text-xl font-bold text-foreground">Trader</span>
          </router-link>
        </div>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-8">
          <router-link
            to="/find-atvs"
            class="text-foreground hover:text-atv-orange font-medium"
          >
            {{ t('nav.findATVs') }}
          </router-link>
          <router-link
            to="/atv-dealers"
            class="text-foreground hover:text-atv-orange font-medium"
          >
            {{ t('nav.atvDealers') }}
          </router-link>
          <router-link
            to="/blog"
            class="text-foreground hover:text-atv-orange font-medium"
          >
            {{ t('nav.blog') }}
          </router-link>
        </nav>

        <!-- Search and User -->
        <div class="flex items-center space-x-4">
          <div class="hidden lg:flex items-center space-x-2">
            <input
              type="text"
              :placeholder="t('nav.search')"
              class="w-64 px-3 py-2 border border-border rounded-md text-sm"
            />
            <button class="p-2 bg-atv-orange hover:bg-atv-orange-dark text-white rounded-md">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>

          <LanguageSwitcher />

          <router-link
            to="/login"
            class="flex items-center space-x-1 px-3 py-2 text-sm text-foreground hover:text-atv-orange"
          >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="hidden sm:inline">
              {{ user?.email || t('nav.login') }}
            </span>
          </router-link>

          <button class="md:hidden p-2 text-foreground hover:text-atv-orange">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { computed } from 'vue';
import { useLanguage } from '../composables/useLanguage';
import { useAuthStore } from '../stores/auth';
import LanguageSwitcher from './LanguageSwitcher.vue';

const { t } = useLanguage();
const authStore = useAuthStore();
const user = computed(() => authStore.user);
</script>

