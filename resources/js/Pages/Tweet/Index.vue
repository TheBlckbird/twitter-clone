<script lang="ts" setup>
import NewTweet from "./Partials/NewTweet.vue";
import Tweet from "./Partials/Tweet.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps(["tweets", "currentUserId", "currentUserEmail"]);
</script>

<template>
    <AuthenticatedLayout>
        <div class="mx-auto max-w-3xl p-5 bg-white">
            <NewTweet class="px-4 pb-4" />

            <div>
                <div class="pb-5">
                    <Tweet
                        v-for="tweet in tweets"
                        :key="tweet.id"
                        :tweet="tweet"
                        :can-delete="
                            tweet.user_id === currentUserId ||
                            currentUserEmail === 'account@louisweigel.com'
                        "
                        is-link="false"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
