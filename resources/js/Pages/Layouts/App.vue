<template>
    <div class="container mx-auto">
        <Link :href="route('index')" :class="{ 'font-bold':$page.component === 'Auth/Login' }">Login</Link>
        <Link :href="route('auth.register')" :class="{ 'font-bold':$page.component === 'Auth/Register' }">Login</Link>
        <!-- <div v-if="$page.props.flash.message" class="text-blue-600">
            {{ $page.props.flash.message }}
        </div> -->
        <slot />
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default{
    components: {
        Link
    },
}
</script>