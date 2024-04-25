<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import PostCreateInput from '@/Components/Post/PostCreateInput.vue';
import PostCard from '@/Components/Post/PostCard.vue';
import SidebarList from '@/Components/Sidebar/SidebarList.vue';
import SidebarListItem from '@/Components/Sidebar/SidebarListItem.vue';
import FollowUsersList from '@/Components/Followers/FollowUsersList.vue'
import GroupList from '@/Components/Group/GroupList.vue';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import { BsBookmarkPlus } from "@kalimahapps/vue-icons";
import { BxCommentAdd } from "@kalimahapps/vue-icons";
import { AnOutlinedLike } from "@kalimahapps/vue-icons";
import { HiPencilSquare } from "@kalimahapps/vue-icons";
import { HiUserGroup } from "@kalimahapps/vue-icons";

const props = defineProps({
    posts: Object,
    userGroups: Object,
})

const user = usePage().props.auth.user;
</script>


<template>

    <Head title="Home" />

    <AuthLayout>

        <div class="flex justify-center py-5 mx-auto space-x-4">


            <!-- Left Side Bar -->
            <div class="space-y-4 rounded-md w-sidebar">

                <div class="flex p-6 space-x-3 bg-white rounded-md">
                    <img class="h-[50px] w-[50px] object-cover rounded-full" :src="user.avatar" alt="Logo">
                    <div class="flex items-center">
                        <h2 class="font-bold">

                            <div class="flex items-center">
                                <!-- Settings Dropdown -->
                                <div class="relative">
                                    <Dropdown align="left" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <div type="button"
                                                    class="inline-flex items-center text-sm font-medium leading-4 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">

                                                    {{ $page.props.auth.user.name }}

                                                    <svg class="w-4 h-4 ms-2 -me-0.5" viewBox="0 0 20 20"
                                                        fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                        </h2>
                    </div>
                </div>

                <SidebarList>
                    <div class="flex items-center space-x-1">
                        <HiUserGroup class="text-2xl" />
                        <div>My Groups</div>
                    </div>

                    <SidebarListItem :href="route('group.show', group.id)" class="ml-3" v-for="group in userGroups">
                        <HiUserGroup class="text-2xl" />
                        <div>
                            {{ group.name }}
                        </div>
                    </SidebarListItem>
                </SidebarList>

                <SidebarList>
                    <SidebarListItem :href="route('user.posts', user.id)">
                        <HiPencilSquare class="text-2xl" />
                        <span>Posts</span>
                    </SidebarListItem>
                    <SidebarListItem :href="route('user.likes', user.id)">
                        <AnOutlinedLike class="text-2xl" />
                        <span>Likes</span>
                    </SidebarListItem>
                    <SidebarListItem :href="route('user.comments', user.id)">
                        <BxCommentAdd class="text-2xl" />
                        <span>Comments</span>
                    </SidebarListItem>

                    <!-- <SidebarListItem :href="route('dashboard')">
                        <BsBookmarkPlus class="text-2xl" />
                        <span>Bookmarks</span>
                    </SidebarListItem> -->
                    <SidebarListItem :href="route('group.index')">
                        <HiUserGroup class="text-2xl" />
                        <span>Groups</span>
                    </SidebarListItem>
                </SidebarList>

            </div>


            <!-- Main -->

            <div class="space-y-4 rounded-md w-main">
                <PostCreateInput />
                <PostCard v-for="post in posts.data" :post="post" :key="post.id" :alt="`${post.user.name} avatar`" />
            </div>

            <!-- Right Side Bar -->
            <div class="space-y-4 rounded-md w-sidebar">

                <FollowUsersList />

                <GroupList />

            </div>


        </div>
    </AuthLayout>
</template>
