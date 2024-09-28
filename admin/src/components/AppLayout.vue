<template>
  <div v-if="currentUser.id" class="min-h-full bg-gray-200 flex">

    <Sidebar :class="{ '-ml-[12rem]': !sidebarOpened }" />
    <div class="flex-1">
      <Navbar @toggle-sidebar="toggleSidebar" />

      <main class="p-6">
        <router-view></router-view>
      </main>
    </div>
  </div>

  <div v-else class="min-h-full bg-gray-200 flex items-center justify-center">
    <Spinner />
  </div>
</template>


<script setup>
import Sidebar from './Sidebar.vue';
import Navbar from './Navbar.vue';
import { computed, ref } from 'vue';
import { onMounted, onUnmounted } from 'vue';
import store from '../store';
import Spinner from './core/Spinner.vue';

const sidebarOpened = ref(true);

const currentUser = computed(() => store.state.user.data);

function toggleSidebar() {
  sidebarOpened.value = !sidebarOpened.value
}

function updateSidebarState() {
  sidebarOpened.value = window.outerWidth > 768;
}

onMounted(() => {
  store.dispatch("getUser");
  updateSidebarState();
  window.addEventListener('resize', updateSidebarState)
})

onUnmounted(() => {
  window.removeEventListener('resize', updateSidebarState)
})


</script>