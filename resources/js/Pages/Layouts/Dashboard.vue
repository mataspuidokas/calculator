<template>
    <HeaderDashboard />
    <div class="container mx-auto px-3 md:px-0 min-h-screen flex justify-center items-center">
        <slot />
    </div>
</template>

<script>
import HeaderDashboard from '../../Components/HeaderDashboard.vue';

export default {
    components: {
        HeaderDashboard
    },
}
</script>