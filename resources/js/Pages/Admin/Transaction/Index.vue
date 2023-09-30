<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreezeTextarea from '@/Components/Textarea.vue';
import paginator from '@/Components/Paginator.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Search from "@/Components/Search.vue";
import { onMounted } from "vue";
import { Datepicker, Input, initTE, Select } from "tw-elements";

onMounted(() => {
    const myAccountType = new Select(
        document.getElementById("account-type")

    );
   
    const myAccount = new Select(
        document.getElementById("account")

    );
    const myBusiness = new Select(
        document.getElementById("business")

    );
    const myTransactionType = new Select(
        document.getElementById("transaction-type")

    );
    initTE({ Datepicker, Input, Select });
    userForm
    
});

const getInitialFormData = () => ({ business: '',
    accountType: '',
    account: '',
    transactionType: '',
    amount: '',
    description: '' });

const userForm = reactive(getInitialFormData());

const resetUserForm = () => Object.assign(userForm, getInitialFormData());

const props = defineProps({
    businesses: Object,
    accounts: Object,
    accountTypes: Object,
    transactions: Object,
    can: {
        type: Object,
        default: () => ({}),
    },
})

const form = useForm({
    business: '',
    accountType: '',
    account: '',
    transactionType: '',
    amount: '',
    description: ''
});

const submit = () => {
    form.post(route('transaction.store'));
};
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('transaction.destroy', id));
    }
}

</script>

<template>
    <Head title="Transaction" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Transaction
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                :href="route('business.index')">
                            Back
                            </Link>
                        </div>
                        <form name="createForm" @submit.prevent="submit">
                            <div className="flex flex-col">
                                <div className="relative mb-4">
                                    <select id="account-type" data-te-select-init data-te-select-filter="true"
                                        data-te-select-size="lg" v-model="form.accountType" name="accountType">
                                        <option value=""></option>
                                        <option v-for="accountType in accountTypes" v-bind:value="accountType.id"
                                            v-bind:key="accountType.id">
                                            {{ accountType.name }}</option>
                                    </select>
                                    <label data-te-select-label-ref>Account Type</label>
                                    <span className="text-red-600" v-if="form.errors.accountType">
                                        {{ form.errors.accountType }}
                                    </span>
                                </div>
                            </div>
                            <div className="flex flex-col">
                                <div className="relative mb-4">
                                    <select id="account" data-te-select-init data-te-select-filter="true"
                                        data-te-select-size="lg" v-model="form.account" name="Account">
                                        <option value=""></option>
                                        <option v-for="account in accounts" v-bind:value="account.id"
                                            v-bind:key="account.id">
                                            {{ account.name }}</option>
                                    </select>
                                    <label data-te-select-label-ref>Account</label>
                                    <span className="text-red-600" v-if="form.errors.account">
                                        {{ form.errors.account }}
                                    </span>
                                </div>
                            </div>
                            <div className="flex flex-col">
                                <div className="relative mb-4">
                                    <select id="business" data-te-select-init data-te-select-filter="true"
                                        data-te-select-size="lg" v-model="form.business" name="business">
                                        <option value=""></option>
                                        <option v-for="business in businesses" v-bind:value="business.id"
                                            v-bind:key="business.id">
                                            {{ business.name }}</option>
                                    </select>
                                    <label data-te-select-label-ref>Account Type</label>
                                    <span className="text-red-600" v-if="form.errors.business">
                                        {{ form.errors.business }}
                                    </span>
                                </div>
                            </div>
                            <div className="flex flex-col">
                                <div className="relative mb-4">
                                    <select id="transaction-type" data-te-select-init data-te-select-filter="true"
                                        data-te-select-size="lg" v-model="form.transactionType" name="transactionType">
                                        <option value=""></option>
                                        <option value="Cash In">
                                            Cash In</option>
                                        <option value="Cash In">
                                            Cash Out</option>
                                    </select>
                                    <label data-te-select-label-ref>Transaction Type</label>
                                    <span className="text-red-600" v-if="form.errors.business">
                                        {{ form.errors.business }}
                                    </span>
                                </div>
                            </div>
                            <div class="relative mb-3">
                                <input type="text"
                                    class="peer m-0 block h-[58px] w-full rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-4 text-base font-normal leading-tight text-neutral-700 transition duration-200 ease-linear placeholder:text-transparent focus:border-primary focus:pb-[0.625rem] focus:pt-[1.625rem] focus:text-neutral-700 focus:shadow-te-primary focus:outline-none peer-focus:text-primary dark:border-neutral-600 dark:text-neutral-200 dark:focus:border-primary dark:peer-focus:text-primary [&:not(:placeholder-shown)]:pb-[0.625rem] [&:not(:placeholder-shown)]:pt-[1.625rem]"
                                    id="amount" v-model="form.amount" required placeholder="0" />
                                <label for="amount"
                                    class="pointer-events-none absolute left-0 top-0 origin-[0_0] border border-solid border-transparent px-3 py-4 text-neutral-500 transition-[opacity,_transform] duration-200 ease-linear peer-focus:-translate-y-2 peer-focus:translate-x-[0.15rem] peer-focus:scale-[0.85] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-translate-y-2 peer-[:not(:placeholder-shown)]:translate-x-[0.15rem] peer-[:not(:placeholder-shown)]:scale-[0.85] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Amount</label>
                                <InputError class="mt-2" :message="form.errors.amount" />
                            </div>

                            <div className="flex flex-col">
                                <div className="mb-4">
                                    <BreezeLabel for="description" value="Description" />

                                    <BreezeTextarea id="description" type="text" class="mt-1 block w-full"
                                        v-model="form.description" autofocus />
                                    <span className="text-red-600" v-if="form.errors.description">
                                        {{ form.errors.description }}
                                    </span>
                                </div>
                            </div>

                            <div className="mt-4">
                                <button type="submit" className="px-6 py-2 font-bold text-white bg-green-500 rounded">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Search :can="can" :create="route('transaction.create')" :index="route('transaction.index')"
                        :search-method="search"></Search>
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
                            <tr v-for="transaction in transactions.data" :key="transaction.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td data-label="Name" class="py-4 px-6">
                                    {{ transaction.amount }}
                                </td>
                                <td v-if="can.edit || can.delete" class="py-4 px-6 w-48">
                                    <Link tabIndex="1"
                                        className="ml-4 bg-green-500 px-2 py-1 rounded text-white cursor-pointer"
                                        :href="route('transaction.edit', transaction.id)">
                                    Edit
                                    </Link>
                                    <button @click="destroy(transaction.id)" tabIndex="-1" type="button"
                                        className="ml-4 bg-red-500 px-2 py-1 rounded text-white cursor-pointer">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <paginator :paginator="transactions"></paginator>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
export default {
    data() {
        return {
            search_param: "",
            formData: this.getInitialFormData(),
        }
    },
    mounted() {
        this.resetForm();
    },
    methods: {
        getInitialFormData() {
            alert('aaa')
            return {
                business: null,
                accountType: null,
                account: null,
                transactionType: null,
                amount: null,
                description: null
            };
        },
        search(param) {
            this.$inertia.replace(route('transaction.index', { 'search': param }))
        },
        resetForm() {
            
            // Reset the form data to its initial state
            this.formData = this.getInitialFormData();
        },
    }
}
</script>

