<template>
  <div class="relative">
    <button
      @click="showMenu = !showMenu"
      class="flex items-center space-x-2 px-3 py-2 text-sm text-foreground hover:text-atv-orange"
    >
      <span class="hidden sm:inline">{{ currentLanguage?.flag }}</span>
    </button>
    
    <div
      v-if="showMenu"
      class="absolute right-0 mt-2 w-40 bg-background border border-border rounded-md shadow-lg z-50"
    >
      <button
        v-for="lang in languages"
        :key="lang.code"
        @click="handleLanguageChange(lang.code)"
        class="w-full flex items-center space-x-2 px-4 py-2 text-left hover:bg-muted cursor-pointer"
        :class="{ 'bg-muted': language === lang.code }"
      >
        <span>{{ lang.flag }}</span>
        <span>{{ lang.name }}</span>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useLanguage } from '../composables/useLanguage';

const { language, setLanguage } = useLanguage();
const showMenu = ref(false);

const languages = [
  { code: 'en', name: 'English', flag: '🇺🇸' },
  { code: 'ka', name: 'ქართული', flag: '🇬🇪' },
];

const currentLanguage = computed(() => {
  return languages.find(lang => lang.code === language.value);
});

const handleLanguageChange = (code) => {
  setLanguage(code);
  showMenu.value = false;
};

const handleClickOutside = (event) => {
  if (!event.target.closest('.relative')) {
    showMenu.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});
</script>

