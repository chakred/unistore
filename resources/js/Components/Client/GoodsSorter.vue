<template>
    <div class="card sorter-block mb-3 border-0 bg-transparent">
        <div class="card-body d-flex justify-content-end align-items-center">
            <label for="sort" class="me-2 mb-0">{{ $t('sidebar.sorter.label') }}</label>
            <select
                id="sort"
                v-model="sort"
                class="form-select w-auto"
                @change="applySort"
            >
                <option value="">{{ $t('sidebar.sorter.default') }}</option>
                <option value="price_desc">{{ $t('sidebar.sorter.priceDesc') }}</option>
                <option value="price_asc">{{ $t('sidebar.sorter.priceAsc') }}</option>
                <option value="availability">{{ $t('sidebar.sorter.availability') }}</option>
                <option value="discount">{{ $t('sidebar.sorter.discount') }}</option>
                <option value="new">{{ $t('sidebar.sorter.new') }}</option>
            </select>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

export default {
    /**
     * Name.
     */
    name: 'GoodsSorter',

    /**
     * Props.
     */
    props: {
        filters: {
            type: Object,
            default: () => ({}),
        },
    },

    /**
     * Composition API.
     */
    setup(props) {
        const sort = ref(props.filters.sort ?? '');

        const applySort = () => {
            router.get(window.location.pathname, {
                ...props.filters,
                sort: sort.value,
            }, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        };

        return {
            sort,
            applySort,
        };
    },
}
</script>
