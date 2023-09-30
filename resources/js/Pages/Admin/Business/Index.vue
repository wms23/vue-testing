<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import paginator from '@/Components/Paginator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Search from "@/Components/Search.vue";

const props = defineProps({
    businesses: {
        type: Object,
        default: () => ({}),
    },
    can: {
        type: Object,
        default: () => ({}),
    },
})

const form = useForm({
    id: null,
})
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('business.destroy', id));
    }
}

</script>

<template>
    <Head title="Business" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Business
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Search :can="can" :create="route('business.create')" :index="route('business.index')" :search-method="search"></Search>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6">Name</th>
                                <th v-if="can.edit || can.delete" scope="col" class="py-3 px-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="business in businesses.data" :key="business.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td data-label="Name" class="py-4 px-6">
                                    {{ business.name }}
                                </td>
                                <td v-if="can.edit || can.delete" class="py-4 px-6 w-48">
                                    <Link tabIndex="1"
                                        className="ml-4 bg-green-500 px-2 py-1 rounded text-white cursor-pointer"
                                        :href="route('business.edit', business.id)">
                                    Edit
                                    </Link>
                                    <button @click="destroy(business.id)" tabIndex="-1" type="button"
                                        className="ml-4 bg-red-500 px-2 py-1 rounded text-white cursor-pointer">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <paginator :paginator="businesses"></paginator>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    data(){
        return {
            search_param: "",
        }
    },
    methods: {
        search(param) {
            this.$inertia.replace(route('business.index', {'search': param}))
        },
    }
}
</script>