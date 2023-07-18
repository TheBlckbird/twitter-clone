<script lang="ts" setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Tweet from "./Partials/Tweet.vue";
import NewComment from "./Partials/NewComment.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps([
    "tweet",
    "comments",
    "currentUserId",
    "currentUserEmail",
]);
</script>

<template>
    <AuthenticatedLayout>
        <div class="mx-auto max-w-3xl p-5 bg-white">
            <Link href="/tweets" class="text-xl font-bold block p-2"
                >&lt;- Back</Link
            >

            <div class="pb-5">
                <Tweet
                    :tweet="tweet"
                    :can-delete="
                        tweet.user_id === currentUserId ||
                        currentUserEmail === 'account@louisweigel.com'
                    "
                />
            </div>

            <div class="px-4">
                <h1>Comments</h1>

                <NewComment :tweet-id="tweet.id" />

                <div class="pb-5">
                    <div
                        v-for="comment in comments"
                        :key="comment.id"
                        class="border-b last:border-b-0 p-2 flex justify-between"
                    >
                        <div>
                            <div class="username mt-2 font-bold">
                                {{ comment.user.name }}
                            </div>
                            <div class="body break-all">
                                {{ comment.body }}
                            </div>
                            <div class="text-gray-400 pt-2">
                                {{
                                    new Date(
                                        comment.created_at
                                    ).toLocaleDateString([], {
                                        dateStyle: "medium",
                                    })
                                }},
                                {{
                                    new Date(
                                        comment.created_at
                                    ).toLocaleTimeString([], {
                                        hour: "2-digit",
                                        minute: "2-digit",
                                    })
                                }}
                            </div>
                        </div>

                        <Link
                            :href="
                                '/tweets/' +
                                tweet.id +
                                '/comments/' +
                                comment.id
                            "
                            preserve-scroll
                            method="delete"
                            as="button"
                            type="button"
                            v-if="
                                comment.user_id === currentUserId ||
                                currentUserEmail === 'account@louisweigel.com'
                            "
                        >
                            <img src="/img/trash.svg" alt="Trash icon" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
