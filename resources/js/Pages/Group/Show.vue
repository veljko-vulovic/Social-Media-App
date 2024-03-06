<script setup>
import PostCard from '@/Components/Post/PostCard.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const prop = defineProps({
    group: Object,
    userGroupsIds: Object,
    posts: Object

});

const user = usePage().props.auth.user
const form = useForm({
    user_id: user.id
})
const joinGroup = (groupId) => {

    form.post(route('group.store', { group_id: groupId }), {
        onSuccess: () => {
            console.log('User added to group');
        }
    })
}

const leaveGroup = (groupId) => {

    form.delete(route('group.destroy', { group_id: groupId }), {
        onSuccess: () => {
            console.log('User left to group');
        }
    })
}

</script>

<template>
    <Head title="Group" />

    <AuthLayout>

        <div class="grid max-w-5xl p-4 mx-auto mt-10 text-white rounded-md gap-x-3 gap-y-3">
            <div class="flex items-center">
                <div class="flex items-center justify-between w-full my-6">
                    <h2 class="text-2xl">{{ group.name }}</h2>

                    <button v-if="userGroupsIds.includes(group.id)" @click="leaveGroup(group.id)"
                        class="px-3 py-2 mt-3 text-white bg-blue-600 rounded-md hover:bg-blue-700"> Leave Group</button>
                    <button v-else @click="joinGroup(group.id)"
                        class="px-3 py-2 mt-3 text-white bg-blue-600 rounded-md hover:bg-blue-700"> Join Group</button>

                </div>
            </div>
            <div class="flex items-start w-1/2">
                {{ group.description }}
            </div>

            <div class="flex flex-col">

                <h3 class="text-xl font-bold">Members</h3>

                <div class="grid grid-cols-6 gap-3 mt-5">
                    <div v-for="user in group.users.slice(0, 6)"
                        class="flex flex-col items-center justify-center space-y-3 ">
                        <img class="rounded-full h-[60px] " :src="user.avatar" alt="">
                        <Link :href="route('user.show', user.id)">
                            <small>{{ user.name }}</small>
                        </Link>
                    </div>
                </div>
            </div>

            <div class="flex">
                <h3 class="my-10 text-xl font-bold">Members Posts</h3>
            </div>

            <div class="mx-auto space-y-4 text-black rounded-md w-main">
                <PostCard v-for="post in posts.data" :post="post" :key="post.id" :alt="`${post.user.name} avatar`" />
            </div>
        </div>


    </AuthLayout>
</template>
