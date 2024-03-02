<script setup lang="ts">
import { Link } from '@inertiajs/vue3';


</script>

<template>
    <div class="flex flex-col justify-between p-6 space-y-3 bg-white rounded-md">

        <div>
            <h3 class="font-bold">Join discussion</h3>
        </div>

        <div class="space-y-3">
            <div class="flex flex-col items-center justify-between w-full space-y-3">
                <div class="flex items-center justify-between w-full">
                    <div class="flex flex-col justify-start">
                        <Link :href="route('dashboard')" class="flex items-center text-sm font-semibold">#freeinternet</Link>
                        <h2 class="text-xs font-bold text-gray-400"><span>100,200</span> posts</h2>
                    </div>
                    <div class="flex flex-row">
                        <img class="rounded-full border border-white h-[25px] translate-x-full z-10"
                            src="https://i.pravatar.cc/150?img=1" alt="">
                        <img class="rounded-full border border-white h-[25px] translate-x-1/2"
                            src="https://i.pravatar.cc/150?img=2" alt="">
                        <img class="rounded-full border border-white h-[25px]" src="https://i.pravatar.cc/150?img=3" alt="">

                    </div>
                </div>

                <div class="flex items-center justify-between w-full">
                    <div class="flex flex-col justify-start">
                        <Link :href="route('dashboard')" class="flex items-center text-sm font-semibold">#freeinternet</Link>
                        <h2 class="text-xs font-bold text-gray-400"><span>100,200</span> posts</h2>
                    </div>
                    <div class="flex flex-row">
                        <img class="rounded-full border border-white h-[25px] translate-x-full z-10"
                            src="https://i.pravatar.cc/150?img=1" alt="">
                        <img class="rounded-full border border-white h-[25px] translate-x-1/2"
                            src="https://i.pravatar.cc/150?img=4" alt="">
                        <img class="rounded-full border border-white h-[25px]" src="https://i.pravatar.cc/150?img=5" alt="">

                    </div>
                </div>

                <div class="flex items-center justify-between w-full">
                    <div class="flex flex-col justify-start">
                        <Link :href="route('dashboard')" class="flex items-center text-sm font-semibold">#freeinternet</Link>
                        <h2 class="text-xs font-bold text-gray-400"><span>100,200</span> posts</h2>
                    </div>
                    <div class="flex flex-row">
                        <img class="rounded-full border border-white h-[25px] translate-x-full z-10"
                            src="https://i.pravatar.cc/150?img=6" alt="">
                        <img class="rounded-full border border-white h-[25px] translate-x-1/2"
                            src="https://i.pravatar.cc/150?img=2" alt="">
                        <img class="rounded-full border border-white h-[25px]" src="https://i.pravatar.cc/150?img=7" alt="">

                    </div>
                </div>

            </div>

        </div>
    </div>
</template>

<style lang="css"></style>
