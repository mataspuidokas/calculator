<template>
    <Head title="Login" />
    <AppLayout>
        <form class="w-full mx-auto" @submit.prevent="form.post(route('login.store'))">
            <div class="relative z-0 w-full mb-5 group">
                <input v-model="form.email" type="email" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                    address</label>
                <div v-if="errors.email" class="text-red-600">
                    {{ errors.email }}
                </div>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input v-model="form.password" type="password" name="password" id="password"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " />
                <label for="password"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
            </div>
            <div class="flex items-start mb-5">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value=""
                        class="w-4 h-4 border border-gray-300 rounded bg-blue-50 focus:ring-3 focus:ring-blue-300" />
                </div>
                <label for="remember" class="ms-2 text-sm font-medium text-gray-500">Remember me</label>
            </div>
            <button type="submit" :disabled="form.processing"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">Submit</button>
        </form>

    </AppLayout>
</template>

<script>
import AppLayout from '../Layouts/App.vue';
import { Head, useForm } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Head
    },
    props: {
        errors: Object
    },
    setup() {
        const form = useForm({
            email: '',
            password: '',
            remember: false
        })

        return { form };
    }
}
</script>