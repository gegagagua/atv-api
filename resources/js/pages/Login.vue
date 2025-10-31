<template>
  <Layout>
    <main class="py-16">
      <div class="max-w-md mx-auto px-4">
        <div class="bg-white border border-border rounded-lg shadow-sm">
          <div class="p-6 text-center border-b border-border">
            <h1 class="text-2xl font-bold">{{ t('login.title') }}</h1>
            <p class="text-muted-foreground mt-2">{{ t('login.title') }}</p>
          </div>
          <div class="p-6">
            <form @submit.prevent="handleSubmit" class="space-y-4">
              <div>
                <label for="email" class="block text-sm font-medium mb-2">{{ t('login.email') }}</label>
                <input
                  id="email"
                  v-model="email"
                  type="email"
                  :placeholder="t('login.email')"
                  required
                  class="w-full px-3 py-2 border border-border rounded-md"
                />
              </div>
              <div>
                <label for="password" class="block text-sm font-medium mb-2">{{ t('login.password') }}</label>
                <input
                  id="password"
                  v-model="password"
                  type="password"
                  :placeholder="t('login.password')"
                  required
                  class="w-full px-3 py-2 border border-border rounded-md"
                />
              </div>
              <button
                type="submit"
                class="w-full bg-atv-orange hover:bg-atv-orange-dark text-white py-3 rounded-md"
              >
                {{ t('login.button') }}
              </button>
            </form>

            <div class="mt-6 text-center space-y-2">
              <router-link to="/forgot-password" class="text-sm text-atv-orange hover:underline block">
                {{ t('login.forgotPassword') }}
              </router-link>
              <div class="text-sm text-muted-foreground">
                {{ t('login.noAccount') }}
                <router-link to="/signup" class="text-atv-orange hover:underline ml-1">
                  {{ t('login.signUp') }}
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </Layout>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useLanguage } from '../composables/useLanguage';
import { useAuthStore } from '../stores/auth';
import { signIn } from '../services/user';
import Layout from '../components/Layout.vue';

const { t } = useLanguage();
const router = useRouter();
const authStore = useAuthStore();

const email = ref('');
const password = ref('');

const handleSubmit = async () => {
  if (!email.value || !password.value) {
    return;
  }
  try {
    const res = await signIn(email.value, password.value);
    if (res?.user) {
      authStore.setUser(res.user);
      router.push('/');
    }
  } catch (error) {
    console.error('Login error:', error);
  }
};
</script>

