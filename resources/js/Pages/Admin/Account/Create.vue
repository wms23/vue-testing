<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeTextArea from '@/Components/Textarea.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { onMounted } from "vue";
import { Datepicker, Input, initTE, Select } from "tw-elements";

onMounted(() => {
    initTE({ Datepicker, Input, Select });
});

const props = defineProps({
    account: Object,
    accountTypes: Object,
});
const form = useForm({
    account: '',
    accountType: ''
});
const submit = () => {
    form.post(route('account.store'));
};
</script>

<template>
    <Head title="Dashboard" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Account
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div className="flex items-center justify-between mb-6">
                            <Link className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                :href="route('account.index')">
                            Back
                            </Link>
                        </div>
                        <form name="createForm" @submit.prevent="submit">
                            <div className="flex flex-col">
                                <div class="relative mb-3">
                                    <input type="text"
                                        class="peer m-0 block h-[58px] w-full rounded border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-4 text-base font-normal leading-tight text-neutral-700 transition duration-200 ease-linear placeholder:text-transparent focus:border-primary focus:pb-[0.625rem] focus:pt-[1.625rem] focus:text-neutral-700 focus:shadow-te-primary focus:outline-none peer-focus:text-primary dark:border-neutral-600 dark:text-neutral-200 dark:focus:border-primary dark:peer-focus:text-primary [&:not(:placeholder-shown)]:pb-[0.625rem] [&:not(:placeholder-shown)]:pt-[1.625rem]"
                                        id="account" v-model="form.account" required placeholder="Account" />
                                    <label for="account"
                                        class="pointer-events-none absolute left-0 top-0 origin-[0_0] border border-solid border-transparent px-3 py-4 text-neutral-500 transition-[opacity,_transform] duration-200 ease-linear peer-focus:-translate-y-2 peer-focus:translate-x-[0.15rem] peer-focus:scale-[0.85] peer-focus:text-primary peer-[:not(:placeholder-shown)]:-translate-y-2 peer-[:not(:placeholder-shown)]:translate-x-[0.15rem] peer-[:not(:placeholder-shown)]:scale-[0.85] motion-reduce:transition-none dark:text-neutral-200 dark:peer-focus:text-primary">Account</label>
                                    <InputError class="mt-2" :message="form.errors.account" />
                                </div>
                                <!-- <div className="mb-4">
                                    <BreezeLabel for="name" value="Account" />

                                    <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                                        autofocus />
                                    <span className="text-red-600" v-if="form.errors.name">
                                        {{ form.errors.name }}
                                    </span>
                                </div> -->
                            </div>
                            <div className="flex flex-col">
                                <div className="relative mb-4">
                                    <select data-te-select-init data-te-select-filter="true" data-te-select-size="lg"
                                        v-model="form.accountType" name="accountType" id="accountType">
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
    </BreezeAuthenticatedLayout>
</template>