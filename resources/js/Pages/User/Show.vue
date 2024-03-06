<script setup>
import PostCard from '@/Components/Post/PostCard.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const prop = defineProps({
    user: Object,
    posts: Object,
    isFollowed: Boolean
});

const authuser = usePage().props.auth.user


const form = useForm({
    follower_id: authuser.id
})

const unfollow = (following_id) => {

    form.delete(route('follower.destroy', { following_id }), {
        onSuccess: () => form.reset(),
    })
}

const follow = (following_id) => {

    form.post(route('follower.store', { following_id }), {
        onSuccess: () => form.reset(),

    });
}
</script>

<template>

    <Head title="Group" />

    <AuthLayout>

        <div class="grid max-w-5xl p-4 mx-auto mt-10 text-white rounded-md gap-x-3 gap-y-3">
            <!-- {{ user }} -->

            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img class="h-[50px] w-[50px] object-cover rounded-full" :src="user.data.avatar" alt="Logo">

                    <h3 class="my-10 text-xl font-bold">{{ user.data.name }} </h3>

                </div>

                <div class="space-x-3" v-show="authuser.id != user.data.id">

                    <button v-if="isFollowed" @click="unfollow(user.data.id)"
                        class="px-3 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Unfollow</button>
                    <button v-else @click="follow(user.data.id)"
                        class="px-3 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">Follow</button>
                </div>

            </div>

            <div class="flex">
                <h3 class="my-10 text-xl font-bold">{{ user.data.name }} Posts :</h3>
            </div>

            <div class="space-y-4 text-black rounded-md w-main">
                <PostCard v-for="post in posts.data" :post="post" :key="post.id" :alt="`${post.user.name} avatar`" />
            </div>
        </div>


    </AuthLayout>
</template>
