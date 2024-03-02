<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';

defineProps({
    groups: Object,
    userGroupsIds: Object,
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

        <div class="grid max-w-5xl grid-cols-3 p-4 mx-auto mt-10 text-white rounded-md gap-x-3 gap-y-3">
            <div v-for="group in groups" class="p-3 border rounded-md">
                <div class="flex flex-col justify-between h-full">
                    <div class="flex items-center justify-center gap-x-3">
                        <h2 class="font-bold text-md">
                            <Link :href="route('group.show', group.id)">{{ group.name }}</Link>
                        </h2>
                    </div>
                    <small class="line-clamp-3">{{ group.description }}</small>
                    <div class="mt-3">
                        <div class="flex flex-row h-[40px]">
                            <img v-for="guser in group.users.slice(0, 6)"
                                class="rounded-full mx-1 border border-white h-[40px]" :src="guser.avatar"
                                :alt="guser.name">
                        </div>
                    </div>

                    <button v-if="userGroupsIds.includes(group.id.toString())" @click="leaveGroup(group.id)"
                        class="px-3 py-2 mt-3 text-white bg-blue-600 rounded-md hover:bg-blue-700"> Leave Group</button>
                    <button v-else @click="joinGroup(group.id)"
                        class="px-3 py-2 mt-3 text-white bg-blue-600 rounded-md hover:bg-blue-700"> Join Group</button>

                </div>
            </div>

        </div>

    </AuthLayout>
</template>
