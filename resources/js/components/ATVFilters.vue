<template>
  <div class="rounded-lg border bg-card text-card-foreground shadow-sm p-6 sticky top-4">
    <button
      v-if="hasActiveFilters"
      @click="clearFilters"
      class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 h-9 rounded-md px-3 border border-input bg-background hover:bg-accent hover:text-accent-foreground text-muted-foreground hover:text-destructive mb-4"
    >
      <svg class="h-4 w-4 pointer-events-none shrink-0 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
      {{ t('filters.clearFilters') }}
    </button>

    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center gap-2">
        <svg class="h-5 w-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
        </svg>
        <h3 class="text-lg font-semibold">{{ t('filters.applyFilters') }}</h3>
      </div>
    </div>

    <div class="space-y-6">
      <!-- Make -->
      <div class="space-y-2">
        <label for="make" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.manufacturer') }}</label>
        <select
          id="make"
          v-model="filters.make"
          @change="handleFilterChange"
          class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        >
          <option value="">{{ t('filters.selectManufacturer') }}</option>
          <option v-for="brand in brands" :key="brand.id" :value="brand.id">
            {{ brand.title }}
          </option>
        </select>
      </div>

      <!-- Model -->
      <div class="space-y-2">
        <label for="model" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.model') }}</label>
        <input
          id="model"
          v-model="filters.model"
          @input="handleFilterChange"
          :placeholder="t('filters.modelName')"
          class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
        />
      </div>

      <!-- Price Range -->
      <div class="space-y-2">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.priceGEL') }}</label>
        <input
          type="range"
          v-model.number="priceRange[0]"
          @input="handlePriceChange"
          min="0"
          max="50000"
          step="200"
          class="w-full"
        />
        <input
          type="range"
          v-model.number="priceRange[1]"
          @input="handlePriceChange"
          min="0"
          max="50000"
          step="200"
          class="w-full"
        />
        <div class="flex justify-between text-sm text-muted-foreground">
          <span>₾{{ priceRange[0].toLocaleString() }}</span>
          <span>₾{{ priceRange[1].toLocaleString() }}</span>
        </div>
      </div>

      <!-- Year Range -->
      <div class="space-y-2">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.yearOfManufacture') }}</label>
        <input
          type="range"
          v-model.number="yearRange[0]"
          @input="handleYearChange"
          min="2000"
          max="2026"
          step="1"
          class="w-full"
        />
        <input
          type="range"
          v-model.number="yearRange[1]"
          @input="handleYearChange"
          min="2000"
          max="2026"
          step="1"
          class="w-full"
        />
        <div class="flex justify-between text-sm text-muted-foreground">
          <span>{{ yearRange[0] }}</span>
          <span>{{ yearRange[1] }}</span>
        </div>
      </div>

      <!-- Mileage Range -->
      <div class="space-y-2">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.mileageKm') }}</label>
        <input
          type="range"
          v-model.number="mileageRange[0]"
          @input="handleMileageChange"
          min="0"
          max="30000"
          step="100"
          class="w-full"
        />
        <input
          type="range"
          v-model.number="mileageRange[1]"
          @input="handleMileageChange"
          min="0"
          max="30000"
          step="100"
          class="w-full"
        />
        <div class="flex justify-between text-sm text-muted-foreground">
          <span>{{ mileageRange[0].toLocaleString() }} km</span>
          <span>{{ mileageRange[1].toLocaleString() }} km</span>
        </div>
      </div>

      <!-- Condition -->
      <div class="space-y-2">
        <label for="condition" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.condition') }}</label>
        <select
          id="condition"
          v-model="filters.condition"
          @change="handleFilterChange"
          class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        >
          <option value="">{{ t('filters.selectCondition') }}</option>
          <option value="new">{{ t('filters.new') }}</option>
          <option value="excellent">{{ t('filters.excellent') }}</option>
          <option value="good">{{ t('filters.good') }}</option>
          <option value="fair">{{ t('filters.fair') }}</option>
          <option value="needs-work">{{ t('filters.needsRepair') }}</option>
        </select>
      </div>

      <!-- Engine Size -->
      <div class="space-y-2">
        <label for="engineSize" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.engineSize') }}</label>
        <select
          id="engineSize"
          v-model="filters.engineSize"
          @change="handleFilterChange"
          class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        >
          <option value="">{{ t('filters.selectEngineSize') }}</option>
          <option value="50-125">50-125cc</option>
          <option value="126-250">126-250cc</option>
          <option value="251-400">251-400cc</option>
          <option value="401-600">401-600cc</option>
          <option value="601-800">601-800cc</option>
          <option value="800+">800cc+</option>
        </select>
      </div>

      <!-- Location -->
      <div class="space-y-2">
        <label for="location" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.location') }}</label>
        <select
          id="location"
          v-model="filters.location"
          @change="handleFilterChange"
          class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        >
          <option value="">{{ t('filters.selectCity') }}</option>
          <option v-for="city in cities" :key="city.id" :value="city.id">
            {{ city.title }}
          </option>
        </select>
      </div>

      <!-- Category -->
      <div class="space-y-2">
        <label for="category" class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">{{ t('filters.category') }}</label>
        <select
          id="category"
          v-model="filters.category"
          @change="handleFilterChange"
          class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
        >
          <option value="">{{ t('filters.selectCategory') }}</option>
          <option value="sport">{{ t('filters.sport') }}</option>
          <option value="utility">{{ t('filters.utility') }}</option>
          <option value="youth">{{ t('filters.youth') }}</option>
          <option value="touring">{{ t('filters.touring') }}</option>
          <option value="racing">{{ t('filters.racing') }}</option>
          <option value="recreational">{{ t('filters.recreational') }}</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useLanguage } from '../composables/useLanguage';
import { getBrands, getCities } from '../services/atv';

const emit = defineEmits(['filters-change']);

const props = defineProps({
  onFiltersChange: {
    type: Function,
    default: null,
  },
});

const { t } = useLanguage();

const priceRange = ref([0, 50000]);
const yearRange = ref([2000, 2026]);
const mileageRange = ref([0, 30000]);
const filters = ref({
  make: '',
  model: '',
  condition: '',
  engineSize: '',
  location: '',
  category: '',
});
const brands = ref([]);
const cities = ref([]);

const hasActiveFilters = computed(() => {
  return (
    Object.values(filters.value).some((v) => v !== '') ||
    priceRange.value[0] !== 0 ||
    priceRange.value[1] !== 50000 ||
    yearRange.value[0] !== 2000 ||
    yearRange.value[1] !== 2026 ||
    mileageRange.value[0] !== 0 ||
    mileageRange.value[1] !== 30000
  );
});

const emitFilters = () => {
  const filterData = {};
  
  // Map filters to API parameters
  if (filters.value.make) {
    filterData.brand_id = filters.value.make;
  }
  if (filters.value.model) {
    // Note: API might need name parameter for model search
    filterData.name = filters.value.model;
  }
  if (filters.value.location) {
    filterData.location_id = filters.value.location;
  }
  if (filters.value.condition) {
    // Map condition to API format if needed
    // For now, we can use condition directly or map it
    filterData.condition = filters.value.condition;
  }
  if (filters.value.engineSize) {
    // Parse engine size range - API expects engine_from and engine_to
    const parts = filters.value.engineSize.split('-');
    if (parts.length === 2 && !parts[1].includes('+')) {
      const min = parseInt(parts[0].replace('cc', ''));
      const max = parseInt(parts[1].replace('cc', ''));
      filterData.engine_from = min;
      filterData.engine_to = max;
    } else if (parts[0].includes('+')) {
      // For "800+" format
      const min = parseInt(parts[0].replace('cc', '').replace('+', ''));
      filterData.engine_from = min;
    }
  }
  
  // Price range
  if (priceRange.value[0] > 0 || priceRange.value[1] < 50000) {
    filterData.price_from = priceRange.value[0];
    filterData.price_to = priceRange.value[1];
  }
  
  // Year range
  if (yearRange.value[0] > 2000 || yearRange.value[1] < 2026) {
    filterData.year_from = yearRange.value[0];
    filterData.year_to = yearRange.value[1];
  }
  
  // Mileage range
  if (mileageRange.value[0] > 0 || mileageRange.value[1] < 30000) {
    filterData.mileage_from = mileageRange.value[0];
    filterData.mileage_to = mileageRange.value[1];
  }
  
  emit('filters-change', filterData);
  if (props.onFiltersChange) {
    props.onFiltersChange(filterData);
  }
};

const handleFilterChange = () => {
  emitFilters();
};

const handlePriceChange = () => {
  emitFilters();
};

const handleYearChange = () => {
  emitFilters();
};

const handleMileageChange = () => {
  emitFilters();
};

const clearFilters = () => {
  filters.value = {
    make: '',
    model: '',
    condition: '',
    engineSize: '',
    location: '',
    category: '',
  };
  priceRange.value = [0, 50000];
  yearRange.value = [2000, 2026];
  mileageRange.value = [0, 30000];
  emit('filters-change', {});
  if (props.onFiltersChange) {
    props.onFiltersChange({});
  }
};

onMounted(async () => {
  try {
    const brandsRes = await getBrands();
    brands.value = brandsRes.data || [];
    const citiesRes = await getCities();
    cities.value = citiesRes.data?.data || [];
  } catch (error) {
    console.error('Error loading filters:', error);
  }
});
</script>

