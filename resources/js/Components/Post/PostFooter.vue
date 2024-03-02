<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { defineProps } from 'vue';
import CommentCreateOverlay from '@/Components/Post/CommentCreateOverlay.vue';
import { ref } from 'vue';

const props = defineProps({
    post: Object,
});

const form = useForm({
    post_id: props.post.id,
});

const user = usePage().props.auth.user;

const likePost = () => {
    form.post(route('like.store'), {
        onFinish: () => {
            console.log('Post Liked');

        },
        preserveScroll: true

    });
};
const dislikePost = () => {
    form.delete(route('like.destroy'), {
        onFinish: () => {
            console.log('Post Disliked');

        },
        preserveScroll: true

    });

}
const showOverlay = ref(false);
const authUserLikedPost = computed(() => {
    return props.post.likes.includes(user.id);
})

</script>

<template>
    <div class="flex items-center justify-between w-full px-5">
        <div class="flex items-center space-x-2">
            <div class="flex items-center space-x-1">
                <button v-if="!authUserLikedPost" @click="likePost()">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </button>
                <button v-else @click="dislikePost()">
                    <svg fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6 text-red-600 hover:text-black">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </button>

                <span>
                    {{ props.post.likes.length > 0 ? props.post.likes.length : "" }}
                </span>
            </div>

            <div class="flex items-center space-x-1">
                <button @click="showOverlay = true">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                    </svg>
                </button>
                <span>
                    {{ props.post.comments.length > 0 ? props.post.comments.length : "" }}
                </span>
            </div>

        </div>

        <!-- <div>
            <button>
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>
            </button>
        </div> -->
        <CommentCreateOverlay :post="post" v-show="showOverlay" @closeOverlay="showOverlay = false" />
    </div>
</template>
