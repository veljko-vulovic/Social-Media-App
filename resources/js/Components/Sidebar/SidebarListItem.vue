<script setup>
import { Link } from '@inertiajs/vue3';

defineProps(['href'])

</script>

<template>
    <Link :href="href">
    <div class="flex items-center space-x-1">
        <slot />
    </div>
    </Link>
</template>
