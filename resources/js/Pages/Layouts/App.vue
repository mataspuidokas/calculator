<template>
    <Header />
    <div class="container mx-auto px-3 md:px-0 min-h-screen flex justify-center items-center">
        <slot />
    </div>
</template>

<script>
import Header from '../../Components/Header.vue'

export default {
    components: {
        Header
    },
}
</script>