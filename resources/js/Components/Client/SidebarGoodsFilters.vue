<template>
    <div class="card goods-filters">
        <div class="card-header">
            <span>Дополнительные фильтры:</span>
        </div>
        <div class="card-body">
            <div v-if="brands.length" class="goods-filters__group">
                <div class="goods-filters__title">Бренд</div>
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
                <div class="goods-filters__title">Страна-производитель</div>
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
                <div class="goods-filters__title">Оригинал / Аналог</div>
                <select v-model="original" class="form-select">
                    <option value="">Все</option>
                    <option value="original">Только оригинал</option>
                    <option value="analog">Только аналог</option>
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
                    <label class="form-check-label" for="in_stock">Только в наличии</label>
                </div>
                <div class="form-check">
                    <input
                        v-model="withDiscount"
                        id="with_discount"
                        class="form-check-input"
                        type="checkbox"
                    >
                    <label class="form-check-label" for="with_discount">Только со скидкой</label>
                </div>
            </div>

            <button
                type="button"
                class="btn btn-outline-dark w-100 mt-2"
                @click="applyFilter"
            >
                Применить фильтр
            </button>
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

        return {
            selectedBrands,
            selectedCountries,
            original,
            inStock,
            withDiscount,
            applyFilter,
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
</style>
