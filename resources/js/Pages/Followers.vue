<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    followers: Object,
})

const user = usePage().props.auth.user;

const form = useForm({
    follower_id: user.id,
})

const unfollow = (following_id) => {

    form.delete(route('follower.destroy', { following_id }), {
        onSuccess: () => form.reset(),
        preserveScroll: true

    })
}
</script>

<template>
    <Head title="Home" />

    <AuthLayout>

        <div class="grid max-w-5xl grid-cols-3 p-4 mx-auto mt-10 text-white rounded-md gap-x-3 gap-y-3">
            <div v-for="follower in followers" class="flex-1 p-3 border rounded-md">
                <div class="flex flex-col justify-center">
                    <div class="flex items-center justify-center gap-x-3">
                        <img class="rounded-full h-[50px] " :src="follower.avatar" alt="">
                        <h2 class="font-bold text-md">{{ follower.name }}</h2>
                    </div>
                    <small class="mx-auto mt-3">{{ follower.email }}</small>
                    <button @click="unfollow(follower.id)"
                        class="px-3 py-2 mt-10 text-white bg-blue-600 rounded-md hover:bg-blue-700">Unfollow</button>
                </div>
            </div>

        </div>

    </AuthLayout>
</template>
