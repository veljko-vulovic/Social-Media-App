<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '../InputError.vue';
import { ref } from 'vue';


let imageUrl = ref('');
const form = useForm({
    content: '',
    image: null,
});

const handleFileChange = (event) => {
    imageUrl = URL.createObjectURL(event.target.files[0]);
    console.log(imageUrl.value);
    form.image = event.target.files[0];
};

const unsetImage = () => {
    imageUrl = null;
    form.image = null;
};

const emit = defineEmits(['closeOverlay'])


const submit = () => {
    form.post(route('post.store'), {
        onSuccess: () => form.reset(),
        onFinish: () => {
            emit('closeOverlay');
        },
    });
};
const handleEnter = (event) => {

    if (event.key === "Enter" && !event.shiftKey) {
        submit();
        emit('closeOverlay');
    } else {
        form.content += '\n';
    }

};
</script>

<template>
    <div id="OverlaySection"
        class="flex justify-center fixed z-50 top-0 left-0 w-full h-screen bg-[#000000] bg-opacity-60 !m-0">

        <div class="relative flex flex-col mx-auto mt-20 bg-white rounded-md h-fit w-main">

            <div class="flex items-center justify-between px-3 py-6 border-b border-b-gray-300">

                <div class="flex items-center justify-center">
                    <h1>Create Post</h1>
                </div>

                <button class="" @click="$emit('closeOverlay')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6 text-black">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>


            <!-- Preview uploaded image -->

            <div class="flex place-self-center">
                <img v-if="form.image" class="my-5 rounded-md object-contain h-[450px]"
                    :src="imageUrl" alt="">
                <button v-if="form.image" class="flex-1 ml-5 place-self-start" @click="unsetImage()">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-6 h-6 text-red-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex flex-col justify-between max-h-[250px] h-full ">

                <form @submit.prevent="submit">
                    <div class="my-6">
                        <div class="flex items-center mb-5 rounded-md justify-evenly dark:bg-white dark:text-gray-300">
                            <textarea @keypress.enter.prevent="handleEnter" id="content" v-model="form.content"
                                name="content" rows="3" placeholder="Write Something..."
                                class="w-3/4 h-32 text-black placeholder-gray-700 border-b-0 border-none rounded-md resize-none dark:bg-gray-300 focus:border-none focus:ring-transparent">
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


                    <div
                        class="flex items-center justify-between w-full px-3 py-6 bg-white border-t border-gray-200 rounded-b-md">
                        <button class="relative flex">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            Photo
                            <input @input="handleFileChange" type="file" name="photo" class="absolute inset-0 opacity-0">
                        </button>

                        <button disabled class="flex disabled:text-gray-300">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                            Video
                        </button>

                        <button disabled class="flex disabled:text-gray-300">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            Event
                        </button>

                        <button disabled class="flex disabled:text-gray-300">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            Location
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </div>
</template>
