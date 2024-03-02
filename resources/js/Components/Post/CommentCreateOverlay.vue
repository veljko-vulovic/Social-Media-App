<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import InputError from '../InputError.vue';


const props = defineProps({
    post: Object,
});

const emit = defineEmits(['closeOption'])
const form = useForm({
    comment: '',
    post_id: props.post.id,
});

const deleteForm = useForm({
    post_id: props.post.id,
});

const submit = () => {
    form.post(route('comment.store'), {
        onSuccess: () => form.reset(),
        onFinish: () => {
            // emit('closeOverlay');
        },
    });
};

const deleteComment = (comment_id) => {

    // console.log(comment_id);
    deleteForm.delete(route('comment.destroy', {id:comment_id}), {
        onSuccess: () => form.reset(),
    });
};
const user = usePage().props.auth.user;

</script>

<template>
    <div id="OverlaySection"
        class="flex justify-center items-center fixed z-50 top-0 left-0 w-full h-screen bg-[#000000] bg-opacity-60 !m-0">

        <div class="relative block mx-auto bg-white rounded-md w-main h-90">

            <div class="flex justify-between px-3 py-6 border-b item-center border-b-gray-300">

                <div class="flex items-center justify-center">
                    <h1>Create Comment</h1>
                </div>

                <button class="" @click="$emit('closeOverlay')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex items-center border-b border-b-gray-300">
                <div class="px-6 py-6">
                    <img class="mb-5 rounded-md" v-show="post.image" :src="post.image" alt="">

                    {{ props.post.content }}
                </div>
            </div>

            <div v-show="post.comments.length > 0" class="flex flex-col gap-3 px-3 py-6">
                <div v-for="comment in post.comments" class="flex items-center justify-between ">
                    <div class="flex items-center gap-2">
                        <img class="rounded-full h-[42px] w-[42px] object-cover" :src="comment.user.avatar" alt="user avatar">
                        <div class="flex flex-col">
                            <span class="font-semibold">{{ comment.user.name }}</span>
                            <p class="text-md">{{ comment.content }}</p>
                        </div>
                    </div>
                    <button v-show="comment.user.id == user.id" @click="deleteComment(comment.id)">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            class="w-6 h-6 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

            </div>

            <div class="flex flex-col justify-between max-h-[250px] h-full ">
                <form @submit.prevent="submit">
                    <div class="my-6">
                        <div class="flex items-center mb-5 rounded-md justify-evenly dark:bg-white dark:text-gray-300">
                            <textarea @keypress.enter.prevent="handleEnter" id="comment" v-model="form.comment"
                                name="comment" rows="1" placeholder="Write Comment..."
                                class="w-3/4 h-10 text-black placeholder-gray-700 border-b-0 border-none rounded-md resize-none dark:bg-gray-300 focus:border-none focus:ring-transparent">
                            </textarea>

                            <button
                                class="flex items-center flex-shrink-0 px-4 py-3 mx-4 text-blue-600 rounded-lg hover:text-white hover:bg-blue-600">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 ">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                </svg>

                            </button>
                        </div>
                        <InputError class="mt-2" :message="form.errors.content" />
                    </div>

                </form>

            </div>

        </div>

    </div>
</template>
