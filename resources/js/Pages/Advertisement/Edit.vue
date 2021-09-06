<template>
    <Head title="Edit advertisement" />

    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>
        <div class="mt-6">
            <div v-if="$page.props.flash.message" class="bg-blue-700 rounded p-1 text-white font-bold">
                ! {{ $page.props.flash.message }}
            </div>
            <slot />
        </div>
        <jet-validation-errors class="mb-4" />
        <h2 class="mb-12 rounded-md px-4 py-2">Advertisement № {{advertisement.id}} edition</h2>
        <form  @submit.prevent="submit">
            <div class="mb-6">
                <jet-label for="title" value="Title" />
                <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" maxlength="255" />
            </div>

            <div class="mb-12">
                <jet-label for="description" value="Description" />
                <jet-textarea id="description" type="textarea" class="mt-1 block w-full" v-model="form.description" maxlength="1023" rows="10" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Edit
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
import {Head} from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetFormSection from "@/Jetstream/FormSection";
import JetTextarea from "@/Jetstream/Textarea";

export default {
    components: {
        Head,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetCheckbox,
        JetValidationErrors,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetTextarea,
    },
    props: {
        advertisement: Object,
        queryData: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                id: this.advertisement.id,
                title: this.advertisement.title,
                description: this.advertisement.description,
                queryData: this.queryData,
            }),
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('update'))
        }
    }
}
</script>
