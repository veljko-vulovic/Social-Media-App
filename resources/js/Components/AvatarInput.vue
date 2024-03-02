<script setup>
import { ref, defineModel, defineEmits } from 'vue';

let model = defineModel({
    type: Object,
})
const emit = defineEmits(['update:modelValue'])

let imageUrl = ref('');

function showPreview(event) {
    if (event.target.files[0]) {
        model = URL.createObjectURL(event.target.files[0]);
        emit('update:modelValue', event.target.files[0]);
    }
}
</script>

<template>

    <div class="flex items-center my-4">
        <div class="flex items-center justify-between w-full mt-2">
            <img :src="`${model}`" alt="" class="object-contain w-16 h-16 rounded-md">
            <div>
                <button type="button"
                    class="flex items-center relative rounded-md bg-white px-2.5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                    Upload Picture
                    <input  @input="showPreview" type="file" name="avatar" class="absolute inset-0 opacity-0">
                </button>
            </div>
        </div>
    </div>
</template>
