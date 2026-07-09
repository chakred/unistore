<template>
    <th scope="col" class="sortable-th">
        <span class="sortable-th__inner">
            <span class="sortable-th__label">{{ label }}</span>
            <span class="sortable-th__arrows">
                <i
                    class="fa-solid fa-caret-up"
                    :class="{ 'sortable-th__arrow--active': isActive('asc') }"
                    @click="sort('asc')"
                ></i>
                <i
                    class="fa-solid fa-caret-down"
                    :class="{ 'sortable-th__arrow--active': isActive('desc') }"
                    @click="sort('desc')"
                ></i>
            </span>
        </span>
    </th>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {
    /**
     * Name.
     */
    name: 'SortableTh',

    /**
     * Props.
     */
    props: {
        label: {
            type: String,
            required: true,
        },
        field: {
            type: String,
            required: true,
        },
        currentSort: {
            type: Object,
            default: () => ({ by: '', dir: '' }),
        },
        query: {
            type: Object,
            default: () => ({}),
        },
    },

    /**
     * Methods.
     */
    methods: {
        isActive(dir) {
            return this.currentSort.by === this.field && this.currentSort.dir === dir;
        },
        sort(dir) {
            router.get(window.location.pathname, {
                ...this.query,
                sort_by: this.field,
                sort_dir: dir,
            }, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        },
    },
}
</script>

<style scoped>
.sortable-th {
    white-space: nowrap;
}

.sortable-th__inner {
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.sortable-th__label {
    vertical-align: middle;
}

.sortable-th__arrows {
    display: inline-flex;
    flex-direction: column;
    flex-shrink: 0;
    margin-left: 4px;
    line-height: .6;
    vertical-align: middle;
}

.sortable-th__arrows i {
    font-size: .65rem;
    color: #adb5bd;
    cursor: pointer;
}

.sortable-th__arrows i:hover {
    color: #495057;
}

.sortable-th__arrow--active {
    color: #212529 !important;
}
</style>
