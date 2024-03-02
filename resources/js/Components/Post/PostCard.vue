<script setup>
import PostHeader from '@/Components/Post/PostHeader.vue';
import PostFooter from '@/Components/Post/PostFooter.vue';
import { defineProps } from 'vue';


defineProps({
    post: Object,
});
</script>

<template>
    <div class="flex flex-col w-full py-6 space-y-5 bg-white rounded-md">

        <PostHeader :post="post" />
        <div class="px-6">
            <img class="mb-5 rounded-md" v-if="post.image" :src="post.image" alt="">
            {{ post.content }}
        </div>
        <PostFooter :post="post" />
    </div>
</template>
