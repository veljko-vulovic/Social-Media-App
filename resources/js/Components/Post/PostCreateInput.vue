<script setup>
import { ref } from 'vue';
import PostCreateOverlay from '@/Components/Post/PostCreateOverlay.vue';


const showOverlay = ref(false);

</script>

<template>
    <div class="flex flex-col w-full px-5 py-6 bg-white rounded-md">

        <div class="flex items-center space-x-1 rounded-md dark:bg-white dark:text-gray-300">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            </svg>
            <button @click="showOverlay = true"
                class="text-black placeholder-gray-500 border-b-0 border-none rounded-md dark:bg-white focus:border-none focus:ring-transparent"
                ref="input">Write Something... </button>
        </div>

    </div>

    <PostCreateOverlay v-show="showOverlay" @closeOverlay="showOverlay = false" />
</template>

