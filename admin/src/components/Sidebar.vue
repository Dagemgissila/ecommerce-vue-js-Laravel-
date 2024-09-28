<template>
    <div class="min-w-[12rem] w-[12rem]  transition-all bg-indigo-700 text-white py-4 px-2">
        <div class="flex items-center justify-center my-2">
            <span class="font-bold text-2xl">Ecommerce</span>
        </div>
        <router-link :to="{ name: 'app.dashboard' }"
            class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <HomeIcon class="w-5" />
            </span>
            <span class="text-xs">
                Dashboard
            </span>
        </router-link>
        <router-link to="/" class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <ListBulletIcon class="w-5" />
            </span>
            <span class="text-xs">
                Categories
            </span>
        </router-link>
        <router-link :to="{name:'app.products'}" class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <ListBulletIcon class="w-5" />
            </span>
            <span class="text-xs">
                Products
            </span>
        </router-link>
        <router-link to="/" class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <ListBulletIcon class="w-5" />
            </span>
            <span class="text-xs">
                Orders
            </span>
        </router-link>
        <router-link to="/" class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <UsersIcon class="w-5" />
            </span>
            <span class="text-xs">
                Users
            </span>
        </router-link>
        <router-link to="/" class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <UserGroupIcon class="w-5" />
            </span>
            <span class="text-xs">
                Customers
            </span>
        </router-link>
        <router-link to="/" class="flex items-center p-2 rounded transition-colors hover:bg-black/30">
            <span class="mr-2 text-gray-300">
                <ChartBarIcon class="w-5" />
            </span>
            <span class="text-xs">
                Reports
            </span>
        </router-link>
    </div>
</template>

<script setup>
import { HomeIcon, UserGroupIcon, UsersIcon, ListBulletIcon, ChartBarIcon } from '@heroicons/vue/24/outline'
</script>

<style scoped></style>