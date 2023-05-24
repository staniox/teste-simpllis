<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    car: {
        type: Array
    },
});
const car = props.car || []
const form = useForm({
    id: car?.id || '',
    name: car?.name || '',
    brand_id: car?.brand_id || '',
    customer_id: car?.customer_id || '',
});

const submit = () => {
    if (car.id) {
        form.put(route('cars.update'), {
            onSuccess: () => form.reset(),
        });
    } else {
        form.post(route('cars.store'), {
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

                <div class="flex items-center justify-end mt-4 gap-6">
                    <button class="btn-form btn-primary" :disabled="form.processing">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
