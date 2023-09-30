<script setup>
import BreezeLabel from '@/Components/Label.vue';
import BreezeInput from '@/Components/Input.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex bg-gray-800 justify-between items=center p-5">
        <div class="flex space-x-2 items-center text-white">
            <BreezeLabel for="search" value="Search" class="ml-2 py-1" />
            <BreezeInput id="search" type="text" class="ml-2 py-1 text-sm rounded border text-black" v-model="search_param"
                @keyup="search" autofocus />
        </div>
        <div class="flex space-x-2 items-center">
            <Link class="px-4 py-2 bg-green-500 uppercase text-white rounded focus:outline-none flex items-center" type="button" as="button" :href="create" v-if="can.create" >
            <button type="button">
                Create
            </button>
            </Link>
        </div>
    </div>
</template>

<script>
export default {
    name: "CardHeader",
    props: {
        create: String,
        searchMethod: Function,
        can: {
            type: Object,
            default: []
        }
    },

    data() {
        return {
            search_param: "",
        };
    },
    methods: {
        search() {
            this.searchMethod(this.search_param);
        },
    },
};
</script>
