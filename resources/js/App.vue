<template>
    <div id="app" class="min-h-screen">
        <nav class="bg-white dark:bg-[#161615] shadow-sm border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <router-link to="/" class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">
                                ATV API
                            </router-link>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <router-link
                                to="/"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors"
                                active-class="border-b-2 border-[#f53003] dark:border-[#FF4433]"
                            >
                                Home
                            </router-link>
                            <router-link
                                to="/about"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors"
                                active-class="border-b-2 border-[#f53003] dark:border-[#FF4433]"
                            >
                                About
                            </router-link>
                            <router-link
                                to="/dashboard"
                                class="inline-flex items-center px-1 pt-1 text-sm font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#f53003] dark:hover:text-[#FF4433] transition-colors"
                                active-class="border-b-2 border-[#f53003] dark:border-[#FF4433]"
                            >
                                Dashboard
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <router-view />
        </main>
    </div>
</template>

<script setup>
// Vue Router is automatically handling the navigation
</script>

<style scoped>
/* Add any component-specific styles here */
</style>

