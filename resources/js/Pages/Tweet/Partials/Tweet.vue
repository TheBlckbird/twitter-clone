<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps(["tweet", "isLink", "canDelete"]);
</script>

<template>
    <component
        :is="isLink ? Link : 'div'"
        :href="'/tweets/' + tweet.id"
        class="no-underline border-t last:border-b p-4 flex justify-between"
        :class="{
            'hover:bg-gray-50 transition duration-150 ease-in-out': isLink,
        }"
    >
        <div>
            <h3 class="font-bold text-xl">{{ tweet.user.name }}</h3>
            <p class="text-lg whitespace-pre-line">{{ tweet.body }}</p>
            <div class="text-gray-400 pt-2">
                {{
                    new Date(tweet.created_at).toLocaleDateString([], {
                        dateStyle: "medium",
                    })
                }},
                {{
                    new Date(tweet.created_at).toLocaleTimeString([], {
                        hour: "2-digit",
                        minute: "2-digit",
                    })
                }}
            </div>
        </div>

        <Link
            :href="'/tweets/' + tweet.id"
            method="delete"
            as="button"
            type="button"
            preserve-scroll
            v-if="canDelete"
        >
            <img src="/img/trash.svg" alt="Trash icon" />
        </Link>
    </component>
</template>
