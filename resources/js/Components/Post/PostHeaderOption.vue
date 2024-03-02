<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';


const props = defineProps({
    id: Number,
});

const form = useForm({
    id: props.id,
});

const emit = defineEmits(['closeOption'])

const deletePost = () => {
    form.delete(route('post.destroy'), {
        preserveScroll: true
    });
};

</script>

<template>
    <div class="absolute top-0 left-4 inset-1">
        <div
            class="flex flex-col justify-between w-32 px-3 py-6 space-y-3 text-lg bg-white rounded-md shadow boorder items-cente">
            <button @click="deletePost()" class="text-red-600 hover:bg-gray-300">Delete</button>
            <button class="hover:bg-gray-300" @click="emit('closeOption')">Close</button>
        </div>
    </div>
</template>
