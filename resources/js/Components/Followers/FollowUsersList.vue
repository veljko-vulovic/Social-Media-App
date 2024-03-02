<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';

const randomUsers = usePage().props.randomUsers
const authuser = usePage().props.auth.user;

const form = useForm({
    follower_id: authuser.id,
})

const addFollower = (following_id, event) => {
    form.post(route('follower.store', { following_id }), {
        onSuccess: () => form.reset(),
        onFinish: (event) => {
        }
    });

    const button = event.target

    const userRow = button.parentElement

    userRow.style.display = 'none'


}
</script>

<template>
    <div class="flex flex-col justify-between p-6 space-y-3 bg-white rounded-md">

        <div>
            <h3 class="font-bold">People you may know</h3>
        </div>

        <div class="space-y-3">
            <div :ref="user.id" class="flex flex-row items-center justify-between w-full" v-if="randomUsers"
                v-for="user in randomUsers" :key="user.id">
                <div class="flex items-center space-x-2">
                    <img class="rounded-full h-[42px] " :src="user.avatar" alt="">
                    <div class="flex">
                        <Link :href="route('user.show', user.id)">
                            <h2 class="text-xs font-bold">
                                {{ user.name }}({{ user.id }})
                            </h2>
                        </Link>
                    </div>
                </div>
                <button @click="addFollower(user.id, $event)"
                    class="flex items-center h-8 p-2 text-xs font-extrabold text-blue-600 bg-blue-400 rounded-md">
                    Follow</button>
            </div>
        </div>
    </div>
</template>
