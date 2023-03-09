<template>
    <Head title="Dashboard" />
    <Nav />
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Nav from '@/Components/Admin/Nav.vue';

export default {
    /**
     * Name.
     */
    name: 'Dashboard',

    components: {
        Head,
        Nav
    }
}
</script>
