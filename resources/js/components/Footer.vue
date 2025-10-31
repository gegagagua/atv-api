<template>
  <footer class="bg-muted border-t border-border">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Top Makes -->
        <div>
          <h3 class="text-lg font-semibold text-foreground mb-4">
            {{ t('footer.makes') }}
          </h3>
          <ul class="space-y-2">
            <li v-for="make in makes" :key="make.name">
              <a
                href="#"
                class="text-sm text-muted-foreground hover:text-atv-orange"
              >
                {{ make.name }} ({{ make.count }})
              </a>
            </li>
          </ul>
        </div>

        <!-- Top Models -->
        <div>
          <h3 class="text-lg font-semibold text-foreground mb-4">
            {{ t('footer.models') }}
          </h3>
          <ul class="space-y-2">
            <li v-for="model in models" :key="model.name">
              <a
                href="#"
                class="text-sm text-muted-foreground hover:text-atv-orange"
              >
                {{ model.name }} ({{ model.count }})
              </a>
            </li>
          </ul>
        </div>

        <!-- Top Types -->
        <div>
          <h3 class="text-lg font-semibold text-foreground mb-4">
            {{ t('footer.types') }}
          </h3>
          <ul class="space-y-2">
            <li v-for="type in types" :key="type.name">
              <a
                href="#"
                class="text-sm text-muted-foreground hover:text-atv-orange"
              >
                {{ type.name }} ({{ type.count }})
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-12 pt-8 border-t border-border text-center">
        <p class="text-sm text-muted-foreground">
          {{ t('footer.copyright') }}
        </p>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { useLanguage } from '../composables/useLanguage';

const { t } = useLanguage();

const makes = [
  { name: 'Polaris', count: '26,657' },
  { name: 'Can-Am', count: '17,308' },
  { name: 'Honda', count: '15,584' },
  { name: 'Kawasaki', count: '13,741' },
];

const models = [
  { name: 'DEFENDER', count: '5,877' },
  { name: 'PIONEER', count: '4,739' },
  { name: 'CFORCE', count: '3,725' },
  { name: 'UFORCE', count: '3,210' },
];

const types = [
  { name: 'Side by Side', count: '55,301' },
  { name: 'ATV Four Wheeler', count: '41,154' },
  { name: 'Trailer', count: '3,512' },
  { name: 'Golf Carts', count: '2,349' },
];
</script>

