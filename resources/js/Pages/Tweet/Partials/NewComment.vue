<script lang="ts" setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const newCommentForm = useForm({
    body: "",
});

const props = defineProps(["tweetId"]);

let page = usePage();
const errors = computed(() => page.props.errors);
</script>

<template>
    <form
        @submit.prevent="
            newCommentForm.post(`/tweets/${tweetId}/comments`, {
                preserveState: false,
            })
        "
    >
        <div class="flex justify-center items-center">
            <textarea
                v-model="newCommentForm.body"
                cols="75"
                rows="5"
            ></textarea>

            <!-- submit -->
            <button
                class="pl-2 py-7"
                type="submit"
                :disabled="newCommentForm.processing"
            >
                Upload
            </button>
        </div>

        <div v-if="errors.body">
            {{ errors.body }}
        </div>
    </form>
</template>
