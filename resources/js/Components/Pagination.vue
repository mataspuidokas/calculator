<template>
    <nav class="flex justify-center my-4">
        <template v-for="link in pagination.links" :key="link.label">
            <Link preserve-scroll class="flex items-center justify-center px-3 py-2 text-sm rounded-xl"
                :class="{ 'bg-blue-400 text-white': link.active, 'hidden': !link.url }" :href="link.url ?? ''"
                v-html="link.label" />
        </template>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';
export default {
    props: {
        pagination: Object,
    },

    components: {
        Link
    },
}
</script>