<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li
                v-for="(item, index) in items"
                :key="index"
                class="breadcrumb-item"
                :class="{ active: index === items.length - 1 }"
                :aria-current="index === items.length - 1 ? 'page' : null"
            >
                <Link v-if="item.href && index !== items.length - 1" :href="item.href">
                    {{ item.label }}
                </Link>
                <span v-else>{{ item.label }}</span>
            </li>
        </ol>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
    /**
     * Name.
     */
    name: 'Breadcrumbs',

    /**
     * Components.
     */
    components: {
        Link,
    },

    /**
     * Props.
     */
    props: {
        items: {
            type: Array,
            required: true,
        },
    },
}
</script>
