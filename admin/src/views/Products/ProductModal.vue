<template>
    <div class="fixed inset-0 flex items-center justify-center -z-10">

    </div>
    <TransitionRoot appear :show="show" as="template">
        <Dialog as="div" @close="closeModal" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                            <Spinner v-if="loading" />
                            <header class="p-3 flex justify-between items-center">
                                <div class="flex items-center justify-between mb-3">
                                    <h1 v-if="!loading" class="text-3xl font-semibold">
                                        {{ product.id ? `Update product: "${props.product.title}"` : 'Create new Product' }}
                                    </h1>
                                </div>
                            </header>

                            <form @submit.prevent="onSubmit">
                                <div class="p-4 pb-5 bg-white">
                                    <CustomInput class="mb-2" v-model="product.title" label="Product Title" />
                                    <CustomInput type="file" class="mb-2" v-model="product.image" label="Image" />

                                    <CustomInput type="richtext" class="mb-2" v-model="product.description"
                                        label="Description" />
                                    <CustomInput type="number" class="mb-2" v-model="product.price" label="Price"
                                        prepend="$" />

                                </div>

                                <footer class="bg-gray-50 p-4 sm:flex-row-reverse">
                                    <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                        Save
                                    </button>
                                    <button type="button" @click="onSubmit($event, true)" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm
                          text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
                                        Save & Close
                                    </button>
                                </footer>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { computed, onUpdated, ref } from 'vue';
import CustomInput from '../../components/core/CustomInput.vue';
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'
import Spinner from '../../components/core/Spinner.vue';
import store from '../../store';

const emit = defineEmits(["update:modelValue", close]);

const show = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value)
});

const props = defineProps({
    modelValue: Boolean,
    product: {
        require: true,
        type: Object
    }
})

function closeModal() {
    show.value = false
    emit("close")
}

const loading = ref(false)

const product = ref({
    id: props.product.id,
    title: props.product.title,
    image: props.product.image,
    description: props.product.description,
    price: props.product.price,
})

onUpdated(() => {
    product.value = {
        id: props.product.id,
        title: props.product.title,
        image: props.product.image,
        description: props.product.description,
        price: props.product.price,
    }
})

function onSubmit() {
    loading.value = true;
    if (product.value.id) {
        store.dispatch("updateProduct", product.value)
            .then(response => {
                loading.value = false
                if (response.status == 200) {
                    store.dispatch("getProducts");
                    closeModal();
                }
            })
    }
    else {
        store.dispatch("createProduct", product.value)
            .then(response => {
                if (response.status == 201) {
                    store.dispatch("getProducts");
                    closeModal();
                }
            })
    }
}

</script>