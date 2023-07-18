<script lang="ts" setup>
import { useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

let page = usePage();
const errors = computed(() => page.props.errors);

const newTweetForm = useForm({
    body: "",
});
</script>

<template>
    <div>
        <form
            @submit.prevent="
                newTweetForm.post('/tweets', {
                    preserveState: true,
                    onSuccess: () => newTweetForm.reset('body'),
                })
            "
        >
            <div class="flex justify-center items-center">
                <textarea
                    v-model="newTweetForm.body"
                    cols="75"
                    rows="5"
                ></textarea>

                <!-- submit -->
                <button
                    class="pl-2 py-7"
                    type="submit"
                    :disabled="newTweetForm.processing"
                >
                    Upload
                </button>
            </div>

            <div v-if="errors.body">
                {{ errors.body }}
            </div>
        </form>
    </div>
</template>
