<template>
    <!-- Footer -->
    <footer class="py-5 bg-dark" id="footer">
        <div class="container">
            <p class="m-0 text-center text-white">
                &copy;
                <strong>MOTRIO</strong>
                <br/>
                {{ currentYear }}
            </p>
            <p
                v-if="viewNumbers"
                class="m-0 text-center text-white"
            >
                <i class="fas fa-eye"></i>
                <span class="ms-1">{{ viewNumbers }}</span>
            </p>
        </div>
        <!-- /.container -->
    </footer>
</template>

<script>
export default {
    /**
     * Name.
     */
    name: 'Footer',

    /**
     * Props.
     */
    props: {
        viewNumbers: {
            type: Number,
            default: 0
        },
    },

    /**
     * Composition API
     */
    setup() {
        return {
            currentYear: new Date().getFullYear(),
        };
    },
}
</script>
