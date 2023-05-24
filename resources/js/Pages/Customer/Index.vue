<script setup>
import '@vuepic/vue-datepicker/dist/main.css';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import dayjs from 'dayjs';
import {ref} from "vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { TrashIcon, PencilSquareIcon } from '@heroicons/vue/24/solid'
import { router } from '@inertiajs/vue3'

const searchField = ['name', 'id', 'email', 'gender'];
const searchValue = ref("");
defineProps({
    saved: {
        type: Boolean,
        default: false,
    },
    updated: {
        type: Boolean,
        default: false,
    },
    items: {
        type: Array
    },
    headers: {
        type: Array
    },
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Pessoas" />
        <template #header class="bg-gray-500">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pessoas</h2>
            <Link class="bg-green-500 text-white font-semibold py-2 px-4 rounded-md" :href="route('customers.create')" :active="route().current('customers.create')">
                Novo
            </Link>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="sm:max-w-sm pb-3">
                <InputLabel for="search" value="Pesquisar:" />
                <TextInput
                    id="search"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="searchValue"
                    required
                    autocomplete="off"
                    placeholder="Ex: Id, Nome ..."
                />
                </div>
                <EasyDataTable
                    buttons-pagination
                    :headers="headers"
                    :items="items"
                    :search-field="searchField"
                    :search-value="searchValue"
                    table-class-name="customize-table"
                >
                    <template #item-birthdate="item">
                       {{dayjs(item.birthdate).format('DD/MM/YYYY')}}
                    </template>
                    <template #item-created_at="item">
                        {{dayjs(item.created_at).format('DD/MM/YYYY')}}
                    </template>
                    <template #item-operation="item">
                        <div class="inline-flex">
                            <Link :href="route('customers.edit',item.id)">
                                <PencilSquareIcon class="h-6 w-6 text-green-500 hover:text-green-600" />
                            </Link>
                            <Link @click="deleteItem(item.id)">
                                <TrashIcon class="h-6 w-6 text-red-500 hover:text-red-600" />
                            </Link>
                        </div>
                    </template>
                </EasyDataTable>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>
import {router} from "@inertiajs/vue3";

export default {
    props: [
        'customers'
    ],
    beforeCreate() {
        router.replace('customers');
    },

    mounted() {
        if (this.saved) {
            this.$swal('Pessoa salva com sucesso', '', 'success');
        } else if (this.updated) {
            this.$swal('Pessoa Atualizada com sucesso', '', 'success');
        }
    },
    methods: {
        deleteItem(id) {
            this.$swal.fire({
                title: 'Tem certeza que deseja excluir?',
                text: "Você não será capaz de reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não',
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(`customers/${id}`);
                    this.$swal.fire(
                        'Excluído!',
                        'Registro excluído com sucesso.',
                        'success'
                    )
                }
            })
        }
    }
}
</script>
