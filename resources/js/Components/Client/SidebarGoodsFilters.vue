<template>
    <div class="card goods-filters">
        <div class="card-header">
            <span>{{ $t('sidebar.goodsFilters.title') }}</span>
        </div>
        <div class="card-body">
            <div v-if="brands.length" class="goods-filters__group">
                <div class="goods-filters__title">{{ $t('sidebar.goodsFilters.brand') }}</div>
                <div
                    v-for="brand in brands"
                    :key="brand"
                    class="form-check"
                >
                    <input
                        v-model="selectedBrands"
                        :id="`brand-${brand}`"
                        class="form-check-input"
                        type="checkbox"
                        :value="brand"
                    >
                    <label class="form-check-label" :for="`brand-${brand}`">{{ brand }}</label>
                </div>
            </div>

            <div v-if="countries.length" class="goods-filters__group">
                <div class="goods-filters__title">{{ $t('sidebar.goodsFilters.country') }}</div>
                <div
                    v-for="country in countries"
                    :key="country"
                    class="form-check"
                >
                    <input
                        v-model="selectedCountries"
                        :id="`country-${country}`"
                        class="form-check-input"
                        type="checkbox"
                        :value="country"
                    >
                    <label class="form-check-label" :for="`country-${country}`">{{ country }}</label>
                </div>
            </div>

            <div class="goods-filters__group">
                <div class="goods-filters__title">{{ $t('sidebar.goodsFilters.originalAnalog') }}</div>
                <select v-model="original" class="form-select">
                    <option value="">{{ $t('sidebar.goodsFilters.all') }}</option>
                    <option value="original">{{ $t('sidebar.goodsFilters.onlyOriginal') }}</option>
                    <option value="analog">{{ $t('sidebar.goodsFilters.onlyAnalog') }}</option>
                </select>
            </div>

            <div class="goods-filters__group">
                <div class="form-check">
                    <input
                        v-model="inStock"
                        id="in_stock"
                        class="form-check-input"
                        type="checkbox"
                    >
                    <label class="form-check-label" for="in_stock">{{ $t('sidebar.goodsFilters.inStock') }}</label>
                </div>
                <div class="form-check">
                    <input
                        v-model="withDiscount"
                        id="with_discount"
                        class="form-check-input"
                        type="checkbox"
                    >
                    <label class="form-check-label" for="with_discount">{{ $t('sidebar.goodsFilters.withDiscount') }}</label>
                </div>
            </div>

            <div class="goods-filters__actions">
                <button
                    type="button"
                    class="goods-filters__reset"
                    @click="resetFilter"
                >
                    <i class="fa-solid fa-rotate-left"></i> {{ $t('actions.reset') }}
                </button>
                <button
                    type="button"
                    class="btn btn-dark btn-sm goods-filters__apply"
                    @click="applyFilter"
                >
                    {{ $t('actions.apply') }}
                </button>
            </div>
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
    name: 'SidebarGoodsFilters',

    /**
     * Props.
     */
    props: {
        brands: {
            type: Array,
            default: () => [],
        },
        countries: {
            type: Array,
            default: () => [],
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
    },

    /**
     * Composition API.
     */
    setup(props) {
        const selectedBrands = ref([...(props.filters.brand ?? [])]);
        const selectedCountries = ref([...(props.filters.country ?? [])]);
        const original = ref(props.filters.original ?? '');
        const inStock = ref(Boolean(props.filters.in_stock));
        const withDiscount = ref(Boolean(props.filters.with_discount));

        const applyFilter = () => {
            router.get(window.location.pathname, {
                ...props.filters,
                brand: selectedBrands.value,
                country: selectedCountries.value,
                original: original.value,
                in_stock: inStock.value ? 1 : 0,
                with_discount: withDiscount.value ? 1 : 0,
            }, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        };

        const resetFilter = () => {
            selectedBrands.value = [];
            selectedCountries.value = [];
            original.value = '';
            inStock.value = false;
            withDiscount.value = false;

            const {
                brand, country, original: originalFilter, in_stock, with_discount, ...rest
            } = props.filters;

            router.get(window.location.pathname, rest, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        };

        return {
            selectedBrands,
            selectedCountries,
            original,
            inStock,
            withDiscount,
            applyFilter,
            resetFilter,
        };
    },
}
</script>

<style scoped>
.goods-filters__group {
    margin-bottom: 1rem;
}

.goods-filters__group:last-of-type {
    margin-bottom: 0;
}

.goods-filters__title {
    font-weight: 600;
    margin-bottom: .5rem;
}

.goods-filters__actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: .75rem;
}

.goods-filters__reset {
    background: none;
    border: none;
    padding: 0;
    font-size: .8rem;
    color: #6c757d;
    text-decoration: underline;
    cursor: pointer;
}

.goods-filters__reset:hover {
    color: #212529;
}

.goods-filters__apply {
    padding: .3rem 1rem;
    font-size: .8rem;
}
</style>
