<script setup>
import ToastListItem from '@/Components/ToastListItem.vue';
import { onUnmounted, ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3'
import toast from "@/Stores/toast"

const remove = (index) => {
    toast.remove(index)
}

const page = usePage();
let removeFinishEventListener = router.on('finish', () => {

    if (page.props.flash.message) {
        toast.add({
            message: page.props.flash.message
        });
    }
});
onUnmounted(() => removeFinishEventListener());

</script>

<template>
    <TransitionGroup tag="div" enter-from-class="translate-x-full opacity-0" enter-active-class="duration-500 "
        leave-active-class="duration-500 " leave-to-class="translate-x-full opacity-0"
        class="fixed space-y-4 z-[999] bottom-5 right-5">
        <ToastListItem v-for="(item, index) in toast.items " :message="item.message" :key="item.key"
            @remove="remove(index)" />
    </TransitionGroup>

</template>
