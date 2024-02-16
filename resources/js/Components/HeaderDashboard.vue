<template>
    <nav class="shadow-md">
        <div class="container mx-auto flex justify-between gap-3 py-2.5 px-3 md:px-0">
            <div>{{ $page.props.user }}</div>
            <Link :href="route('login.logout')" method="post" as="button">Log out</Link>
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