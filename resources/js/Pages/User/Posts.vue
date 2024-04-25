<script setup>
import PostCard from '@/Components/Post/PostCard.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';


const prop = defineProps({
    user: Object,
    posts: Object,
    isFollowed: Boolean

});
</script>

<template>

    <Head title="Group" />

    <AuthLayout>

        <div class="grid max-w-5xl grid-cols-3 p-4 mx-auto mt-10 text-white rounded-md gap-x-3 gap-y-3">
            <div class="space-y-4 text-black rounded-md w-main">
                <PostCard v-for="post in posts.data" :post="post" :key="post.id" :alt="`${post.user.name} avatar`" />
            </div>
        </div>
    </AuthLayout>
</template>
