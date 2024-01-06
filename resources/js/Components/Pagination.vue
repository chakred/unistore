<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
<!--            <li class="page-item">-->
<!--                <a-->
<!--                    :href="items.first_page_url"-->
<!--                    class="page-link"-->
<!--                    aria-label="Previous"-->
<!--                >-->
<!--                    <span aria-hidden="true">&laquo;</span>-->
<!--                </a>-->
<!--            </li>-->
            <li
                v-for="link in items.links"
                :class="link.active ? 'active': ''"
                class="page-item"
            >
                <a
                    :href="link.url"
                    class="page-link"
                >
                    <span>
                        {{link.label}}
                    </span>
                </a>
            </li>
<!--            <li class="page-item">-->
<!--                <a-->
<!--                    :href="items.last_page_url"-->
<!--                    class="page-link"-->
<!--                    aria-label="Next"-->
<!--                >-->
<!--                    <span aria-hidden="true">&raquo;</span>-->
<!--                </a>-->
<!--            </li>-->
        </ul>
    </nav>
</template>

<script>

export default {
    /**
     * Name.
     */
    name: 'Pagination',

    /**
     * Props.
     */
    props: {
        items: {
            type: Object,
            default: {},
        },
    },
}
</script>
