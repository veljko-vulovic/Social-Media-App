<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import PostHeaderOption from '@/Components/Post/PostHeaderOption.vue';
import { ref, defineProps } from 'vue';


const props = defineProps({
    post: Object,
});
const authUser = usePage().props.auth.user;

const postOptionShow = ref(false);
</script>

<template >
    <div class="flex items-center justify-between px-5">
        <div class="flex items-center space-x-2">
            <img class="rounded-full h-[42px] w-[42px] object-cover" :src="post.user.avatar" alt="">
            <div class="flex">
                <h2 class="text-xs font-bold">
                    <Link :href="route('user.show', post.user.id)" >{{ post.user.name }}</Link>

                </h2>
            </div>
        </div>

        <div class="relative" v-show="post.user.id == authUser.id">
            <button @click="postOptionShow = true">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                </svg>
            </button>
            <PostHeaderOption v-show="postOptionShow" :id="props.post.id" @closeOption="postOptionShow = false"
                :key="props.post.id" />
        </div>
    </div>
</template>
