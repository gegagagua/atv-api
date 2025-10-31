<template>
  <Layout>
    <main class="py-16">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <h1 class="text-4xl font-bold text-foreground mb-4">{{ t('contact.title') }}</h1>
          <p class="text-xl text-muted-foreground">
            Get in touch with our team for any questions or support
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
          <!-- Contact Form -->
          <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
            <div class="p-6 border-b">
              <h2 class="text-2xl font-semibold">Send us a message</h2>
              <p class="text-sm text-muted-foreground mt-1">
                Fill out the form below and we'll get back to you as soon as possible
              </p>
            </div>
            <div class="p-6">
              <form @submit.prevent="handleSubmit" class="space-y-4">
                <div>
                  <label for="name" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-2 block">Name</label>
                  <input
                    id="name"
                    v-model="formData.name"
                    type="text"
                    placeholder="Your full name"
                    required
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                  />
                </div>
                <div>
                  <label for="email" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-2 block">Email</label>
                  <input
                    id="email"
                    v-model="formData.email"
                    type="email"
                    placeholder="Your email address"
                    required
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                  />
                </div>
                <div>
                  <label for="subject" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-2 block">Subject</label>
                  <input
                    id="subject"
                    v-model="formData.subject"
                    type="text"
                    placeholder="What is this about?"
                    required
                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                  />
                </div>
                <div>
                  <label for="message" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 mb-2 block">Message</label>
                  <textarea
                    id="message"
                    v-model="formData.message"
                    placeholder="Tell us more details..."
                    rows="5"
                    required
                    class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                  ></textarea>
                </div>
                <div v-if="submitStatus" :class="submitStatus === 'success' ? 'text-green-600' : 'text-red-600'" class="text-sm">
                  {{ submitMessage }}
                </div>
                <button
                  type="submit"
                  :disabled="submitting"
                  class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 w-full h-10 px-4 py-2 bg-atv-orange hover:bg-atv-orange-dark text-white"
                >
                  {{ submitting ? 'Sending...' : 'Send Message' }}
                </button>
              </form>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="space-y-8">
            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
              <div class="p-6 border-b">
                <h2 class="text-2xl font-semibold">Get in touch</h2>
                <p class="text-sm text-muted-foreground mt-1">
                  Reach out to us through any of these channels
                </p>
              </div>
              <div class="p-6 space-y-6">
                <div class="flex items-center space-x-4">
                  <div class="flex items-center justify-center w-12 h-12 bg-atv-orange/10 rounded-lg">
                    <svg class="h-6 w-6 text-atv-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                  </div>
                  <div>
                    <h3 class="font-semibold">Email</h3>
                    <p class="text-sm text-muted-foreground">support@atvtrader.com</p>
                  </div>
                </div>
                
                <div class="flex items-center space-x-4">
                  <div class="flex items-center justify-center w-12 h-12 bg-atv-orange/10 rounded-lg">
                    <svg class="h-6 w-6 text-atv-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                  </div>
                  <div>
                    <h3 class="font-semibold">Phone</h3>
                    <p class="text-sm text-muted-foreground">1-800-ATV-TRADE</p>
                  </div>
                </div>
                
                <div class="flex items-center space-x-4">
                  <div class="flex items-center justify-center w-12 h-12 bg-atv-orange/10 rounded-lg">
                    <svg class="h-6 w-6 text-atv-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                  </div>
                  <div>
                    <h3 class="font-semibold">Address</h3>
                    <p class="text-sm text-muted-foreground">
                      123 ATV Street<br />
                      Motorsport City, MC 12345
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="rounded-lg border bg-card text-card-foreground shadow-sm">
              <div class="p-6 border-b">
                <h2 class="text-2xl font-semibold">Business Hours</h2>
              </div>
              <div class="p-6">
                <div class="space-y-2">
                  <div class="flex justify-between">
                    <span>Monday - Friday</span>
                    <span>9:00 AM - 6:00 PM</span>
                  </div>
                  <div class="flex justify-between">
                    <span>Saturday</span>
                    <span>10:00 AM - 4:00 PM</span>
                  </div>
                  <div class="flex justify-between">
                    <span>Sunday</span>
                    <span>Closed</span>
                  </div>
                </div>
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
import { useLanguage } from '../composables/useLanguage';
import { submitContact } from '../services/contact';
import Layout from '../components/Layout.vue';

const { t } = useLanguage();

const formData = ref({
  name: '',
  email: '',
  subject: '',
  message: '',
});

const submitting = ref(false);
const submitStatus = ref(null);
const submitMessage = ref('');

const handleSubmit = async () => {
  submitting.value = true;
  submitStatus.value = null;
  submitMessage.value = '';

  try {
    const res = await submitContact(formData.value);
    submitStatus.value = 'success';
    submitMessage.value = 'Thank you! Your message has been sent successfully.';
    formData.value = { name: '', email: '', subject: '', message: '' };
  } catch (error) {
    submitStatus.value = 'error';
    submitMessage.value = error.response?.data?.message || 'Failed to send message. Please try again.';
  } finally {
    submitting.value = false;
  }
};
</script>
