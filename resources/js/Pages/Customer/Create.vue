<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { Head, Link, useForm } from '@inertiajs/vue3';
const form = useForm({
    name: '',
    email: '',
    gender: '',
    birthdate: '',
});

const submit = () => {
    form.post(route('customers.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <FormLayout>
        <Head title="Criar Pessoa" />

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
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="gender" value="Sexo" />

                <input type="radio" id="masculino" value="Masculino" v-model="form.gender">
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" id="feminino" value="Feminino" v-model="form.gender">
                <label for="feminino">Feminino</label>
                <br>

                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div class="mt-4">
                <InputLabel for="birthdate" value="Data de Aniversário" />

                <Datepicker v-model="form.birthdate" :enable-time-picker="false" />

                <InputError class="mt-2" :message="form.errors.birthdate" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Criar
                </PrimaryButton>
            </div>
        </form>
    </FormLayout>
</template>
