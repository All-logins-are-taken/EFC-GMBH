<template>

    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Advertisement List
            </h2>
        </template>

        <div class="mx-auto w-11/12">

            <div v-if="!advertisements" class="text-center">No advertisement found</div>
            <div>
                <div v-if="$page.props.flash.message" class="bg-blue-700 rounded p-5 text-white font-bold">
                    ! {{ $page.props.flash.message }}
                </div>
                <slot />
            </div>
            <div v-if="advertisements" class="container mt-4 mx-auto">
                <table class="table w-full">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>
                            <div>
                                Title
                                <Link href="advertisement" method="get" :data="{ page: $page.props.flash.page ?? '1', sort: 'title', direction: 'asc' }">&#8595;</Link> |
                                <Link href="advertisement"  method="get" :data="{ page: $page.props.flash.page ?? '1', sort: 'title', direction: 'desc' }">&#8593;</Link>
                            </div>
                        </th>
                        <th>Description</th>
                        <th>Images</th>
                        <th>
                            <div>
                                Posting date
                                <Link href="advertisement" method="get" :data="{ page: $page.props.flash.page ?? '1', sort: 'posting_date', direction: 'asc' }">&#8595;</Link> |
                                <Link href="advertisement"  method="get" :data="{ page: $page.props.flash.page ?? '1', sort: 'posting_date', direction: 'desc' }">&#8593;</Link>
                            </div>
                        </th>
                        <th>User actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in advertisements.data" :key="item.id">
                        <td>{{ item.id }}</td>
                        <td>{{ item.title }}</td>
                        <td>{{ item.description }}</td>
                        <td>
                            <div v-if="!item.images || !item.images.length">No advertisement image found</div>
                            <div v-if="item.images && item.images.length">
                                <div v-for="image in item.images"  :key="image.id" class="images ml-4">
                                    <img width="50" :src=image.url+image.image_path :alt=image.image_name>
                                </div>
                            </div>
                        </td>
                        <td>{{ date(item.posting_date) }}</td>
                        <td>
                            <div v-if="$page.props.user.id === item.user_id">
                                <jet-button type="button" class="ml-4 mb-4" @click.prevent="edit(item.id)">
                                    Edit
                                </jet-button>
                                <jet-button type="button" class="ml-4 bg-red-400 hover:bg-red-700" @click.prevent="remove(item.id)">
                                    Delete
                                </jet-button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <pagination class="mt-6" :links="advertisements.links" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import Pagination from '@/Components/Pagination'
    import {Head, Link} from "@inertiajs/inertia-vue3";
    import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
    import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
    import JetButton from "@/Jetstream/Button";
    import JetInput from "@/Jetstream/Input";
    import JetCheckbox from "@/Jetstream/Checkbox";
    import JetLabel from "@/Jetstream/Label";
    import JetValidationErrors from "@/Jetstream/ValidationErrors";
    import AppLayout from "@/Layouts/AppLayout";

    export default {
        components: {
            Head,
            AppLayout,
            Pagination,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },
        props: {
            advertisements: Object,
            page: String,
            sort: String,
            direction: String,
        },
        data() {
            return {
                params: {
                    page: this.page,
                    sort: this.sort,
                    direction: this.direction,
                },
            };
        },
        methods: {
            edit(advertisement) {
                this.$inertia.get(this.route('edit', {id: advertisement}));
            },
            remove(advertisement) {
                this.$inertia.post(this.route('destroy'), {advertisement: advertisement});
            },
            date(datetime){
               return  new Date(datetime).toJSON().slice(0,10).replace(/-/g,'/');
            },
        },
    }
</script>

<style>
    .images.ml-4{
        display: inline-block;
    }

    table th{
        border: 1px solid rgb(31, 41, 55);
        background-color: rgba(219, 234, 254, 1);
        color: rgba(29, 78, 216, 1);
    }

    table td{
        border-bottom: 1px solid rgb(31, 41, 55);
        padding: 10px 0 10px 5px;
        max-width: 15%;
        min-width: 15%;
    }

    table tbody tr:nth-child(odd){
        background-color: rgba(29, 78, 216, .1);
    }
</style>
