<template>
  <Layout>
    <main class="py-16">
      <div class="max-w-md mx-auto px-4">
        <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
          <div class="flex flex-col space-y-1.5 p-6 text-center border-b border-border">
            <h1 class="text-2xl font-semibold leading-none tracking-tight">{{ t('login.title') }}</h1>
            <p class="text-sm text-muted-foreground">{{ t('login.title') }}</p>
          </div>
          <div class="p-6 pt-0">
            <form @submit.prevent="handleSubmit" class="space-y-4">
              <div>
                <label for="email" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-2 block">{{ t('login.email') }}</label>
                <input
                  id="email"
                  v-model="email"
                  type="email"
                  :placeholder="t('login.email')"
                  required
                  class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                />
              </div>
              <div>
                <label for="password" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-2 block">{{ t('login.password') }}</label>
                <input
                  id="password"
                  v-model="password"
                  type="password"
                  :placeholder="t('login.password')"
                  required
                  class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                />
              </div>
              <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 w-full h-10 px-4 py-2 bg-atv-orange hover:bg-atv-orange-dark text-white"
              >
                {{ t('login.button') }}
              </button>
            </form>

            <div class="mt-6 text-center space-y-2">
              <router-link to="/forgot-password" class="text-sm text-atv-orange hover:underline underline-offset-4 block">
                {{ t('login.forgotPassword') }}
              </router-link>
              <div class="text-sm text-muted-foreground">
                {{ t('login.noAccount') }}
                <router-link to="/signup" class="text-atv-orange hover:underline underline-offset-4 ml-1">
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

