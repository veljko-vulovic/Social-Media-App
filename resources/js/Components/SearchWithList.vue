<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import { debounce } from 'lodash';
import { ref, watch } from 'vue';

const search = ref('');
const results = ref([]);

const onSearch = () => {
    if (search.value.length > 3) {
        axios.post('/search', { search: search.value }).then((response) => {
            results.value = response.data
        })
    }
}

watch(search, debounce(function () {
    onSearch();
}, 500))

</script>

<template>
    <div
        class="relative flex items-center text-white border rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2 mr-1">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>

        <input v-model="search"
            class="border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 focus:border-none focus:ring-transparent"
            placeholder="Search people..." ref="input" />


        <div v-show="results"
            class="absolute left-0 w-full space-y-2 bg-gray-700 border-gray-700 rounded-md top-11 z-[99]">

            <div v-for="(result, index) in results" :key="index" class="p-3 rounded-md hover:bg-gray-800">
                <Link :href="route('user.show', result.id)">{{ result.name }}</Link>
            </div>

        </div>
    </div>
</template>
