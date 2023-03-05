<template>
    <Nav />
    {{marks}}
</template>

<script>
import Nav from '@/Components/Client/Nav.vue';

export default {
    /**
     * Name.
     */
    name: 'FrontPage',

    /**
     * Components.
     */
    components: {
        Nav
    },

    /**
     * Props.
     */
    props: {
        marks: {
            type: Object,
            default: {}
        },
        models: {
            type: Object,
            default: {}
        },
        viewNumbers: {
            type: Number,
            default: 0
        },
    },
}
</script>

