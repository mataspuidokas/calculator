<template>
    <nav class="shadow-md">
        <div class="container mx-auto flex justify-between gap-3 py-2.5 px-3 md:px-0">
            <Link :href="route('login')" :class="{ 'text-blue-700': $page.component === 'Auth/Login' }">Login</Link>
            <Link :href="route('register.index')" :class="{ 'text-blue-700': $page.component === 'Auth/Register' }">Register
            </Link>
        </div>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    components: {
        Link
    },
}
</script>