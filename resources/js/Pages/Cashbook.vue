<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <section class="master__list__create font-poppins my-5 mr-[20px] 2xl:ml-[320px] ml-[20px]">
                <h1 class="text-center font-semibold mt-10 mb-20 text-xl">Choose the list to add new</h1>
                <div class="flex items-center justify-center gap-20">
                    <div
                        class="bg-[#F8F8F8] mb-6 animate__animated animate__zoomIn  w-full md:w-[200px]  shadow-primary shadow-sm relative rounded-[20px]  pb-8 pt-10">
                        <Link :href="route('business.index')">
                            <h1 class="text-primary font-semibold text-center text-lg">Business</h1>
                        </Link>
                        <div
                            class="w-12 h-12 absolute -top-6 left-[38%] bg-primary text-white rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-briefcase text-lg"></i>
                        </div>
                    </div>
                    <div
                        class="bg-[#F8F8F8] mb-6 animate__animated animate__zoomIn  w-full md:w-[200px]  shadow-primary shadow-sm relative rounded-[20px]  pb-8 pt-10">
                        <Link :href="route('account-type.index')">
                            <h1 class="text-primary font-semibold text-center text-lg">Account Type</h1>
                        </Link>
                        <div
                            class="w-12 h-12 absolute -top-6 left-[38%] bg-primary text-white rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-dollar-sign text-lg"></i>
                        </div>
                    </div>
                    <div
                        class="bg-[#F8F8F8] mb-6 animate__animated animate__zoomIn  w-full md:w-[200px]  shadow-primary shadow-sm relative rounded-[20px]  pb-8 pt-10">
                        <Link :href="route('account.index')">
                            <h1 class="text-primary font-semibold text-center text-lg">Account name</h1>
                        </Link>
                        <div
                            class="w-12 h-12 absolute -top-6 left-[38%] bg-primary text-white rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-dollar-sign text-lg"></i>
                        </div>
                    </div>



                </div>
        </section>
    </div>
</AuthenticatedLayout></template>
