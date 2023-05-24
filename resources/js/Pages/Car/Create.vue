<script setup>
import '@vuepic/vue-datepicker/dist/main.css';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CustomerForm from "@/Pages/Customer/partials/CustomerForm.vue";
import CarForm from "@/Pages/Car/partials/CarForm.vue";
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Criar Pessoa" />
        <template #header class="bg-gray-500">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nova Pessoa</h2>
            <Link class="btn btn-alert" :href="route('customers')" :active="route().current('customers.create')">
                Voltar
            </Link>
        </template>

        <CarForm />

    </AuthenticatedLayout>
</template>
