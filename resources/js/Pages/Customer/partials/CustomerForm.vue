<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    customer: {
        type: Array
    },
});
const customer = props.customer || []
const form = useForm({
    id: customer?.id || '',
    name: customer?.name || '',
    email: customer?.email || '',
    gender: customer?.gender || '',
    birthdate: new Date(Date.parse(customer.birthdate + ' 00:00:00')) || '',
});

const submit = () => {
    if (customer.id) {
        form.put(route('customers.update'), {
            onSuccess: () => form.reset(),
        });
    } else {
        form.post(route('customers.store'), {
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Nome" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="off"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mt-4">
                    <InputLabel for="gender" value="Sexo" />

                    <input type="radio" id="masculino" value="Masculino" v-model="form.gender">
                    <label class="mx-2" for="masculino">Masculino</label>
                    <br>
                    <input type="radio" id="feminino" value="Feminino" v-model="form.gender">
                    <label class="mx-2" for="feminino">Feminino</label>
                    <br>

                    <InputError class="mt-2" :message="form.errors.gender" />
                </div>

                <div class="mt-4">
                    <InputLabel for="birthdate" value="Data de Nascimento" />

                    <Datepicker v-model="form.birthdate" :enable-time-picker="false" format="dd/MM/yyyy" language="pt-br" />

                    <InputError class="mt-2" :message="form.errors.birthdate" />
                </div>

                <div class="flex items-center justify-end mt-4 gap-6">
                    <button class="btn-form btn-primary" :disabled="form.processing">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
