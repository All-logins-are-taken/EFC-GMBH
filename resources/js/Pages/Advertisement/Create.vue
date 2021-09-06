<template>
    <Head title="Create advertisement" />

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

        <form  @submit.prevent="submit" enctype="multipart/form-data">
            <div class="mb-6">
                <jet-label for="title" value="Title" />
                <jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" maxlength="255" />
                <jet-input-error :message="form.errors.title" class="mt-2" />
            </div>

            <div class="mb-12">
                <jet-label for="description" value="Description" />
                <jet-textarea id="description" type="textarea" class="mt-1 block w-full" v-model="form.description" autocomplete="description" />
                <jet-input-error :message="form.errors.description" class="mt-2" />
            </div>

            <div>
                <UploadImages :max="3" maxError="Max files exceed" uploadMsg="upload advertisement images" fileError="images files only accepted" clearAll="remove all images" ref="files" maxlength="1023" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Create
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import {Head, Link} from "@inertiajs/inertia-vue3";
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
    import UploadImages from "vue-upload-drop-images";
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
            Link,
            UploadImages
        },

        data() {
            return {
                form: this.$inertia.form({
                    _method: 'PUT',
                    title: '',
                    description: '',
                    files: [],
                }),
            }
        },
        methods: {
            submit() {
                const config = { headers: { "Content-Type": "multipart/form-data" } };

                let formData = new FormData();

                for( let i = 0; i < this.$refs.files.files.length; i++ ){
                    let file = this.$refs.files.files[i];
                    formData.append('files[' + i + ']', file);
                }
                formData.append('title', this.form.title);
                formData.append('description', this.form.description);

                axios.post('store', formData, config)
                .then(function (result) {
                    window.location.href = '/advertisement';
                }, function (error) {
                    return error;
                });

                //this.form.get(this.route('advertisement'), {})
            },
        }
    }
</script>
