<template>
    <div class="flex items-center">
        <span class="whitespace-nowrap mr-3">Per Page</span>
        <select
            v-model="localPerPage"
            @change="$emit('update-perpage', localPerPage)"
            class="appearance-none relative block w-24 px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
        >
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="ml-3">Found {{ count }} {{ text }}</span>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";

const { count, text, modelValue } = defineProps({
    count: String,
    text: String,
    modelValue: Number,
});

const localPerPage = ref(modelValue);

watch(
    () => modelValue, // Watch the getter
    (newVal) => {
        localPerPage.value = newVal;
    }
);

const emit = defineEmits(["update-perpage"]);
</script>
