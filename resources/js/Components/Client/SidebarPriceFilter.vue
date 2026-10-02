<template>
    <div class="card price-filter">
        <div class="card-header">
            <span>{{ $t('sidebar.priceFilter.title') }}</span>
        </div>
        <div class="card-body">
            <div class="price-filter__values">
                <span>{{ $t('sidebar.priceFilter.from') }} {{ minValue }}</span>
                <span>{{ $t('sidebar.priceFilter.to') }} {{ maxValue }}</span>
            </div>
            <div class="price-filter__slider">
                <input
                    v-model.number="minValue"
                    type="range"
                    class="form-range price-filter__range"
                    :min="bounds.min"
                    :max="bounds.max"
                    @input="onMinInput"
                >
                <input
                    v-model.number="maxValue"
                    type="range"
                    class="form-range price-filter__range"
                    :min="bounds.min"
                    :max="bounds.max"
                    @input="onMaxInput"
                >
            </div>
            <div class="price-filter__actions">
                <button
                    type="button"
                    class="price-filter__reset"
                    @click="resetFilter"
                >
                    <i class="fa-solid fa-rotate-left"></i> {{ $t('actions.reset') }}
                </button>
                <button
                    type="button"
                    class="btn btn-dark btn-sm price-filter__apply"
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
    name: 'SidebarPriceFilter',

    /**
     * Props.
     */
    props: {
        priceRange: {
            type: Object,
            default: () => ({ min: 0, max: 0 }),
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
        const bounds = {
            min: Math.floor(props.priceRange.min ?? 0),
            max: Math.ceil(props.priceRange.max ?? 0),
        };

        const minValue = ref(
            props.filters.price_min !== undefined && props.filters.price_min !== null
                ? Number(props.filters.price_min)
                : bounds.min
        );
        const maxValue = ref(
            props.filters.price_max !== undefined && props.filters.price_max !== null
                ? Number(props.filters.price_max)
                : bounds.max
        );

        const onMinInput = () => {
            if (minValue.value > maxValue.value) {
                minValue.value = maxValue.value;
            }
        };

        const onMaxInput = () => {
            if (maxValue.value < minValue.value) {
                maxValue.value = minValue.value;
            }
        };

        const applyFilter = () => {
            router.get(window.location.pathname, {
                ...props.filters,
                price_min: minValue.value,
                price_max: maxValue.value,
            }, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        };

        const resetFilter = () => {
            minValue.value = bounds.min;
            maxValue.value = bounds.max;

            const { price_min, price_max, ...rest } = props.filters;

            router.get(window.location.pathname, rest, {
                preserveScroll: true,
                preserveState: true,
                replace: true,
            });
        };

        return {
            bounds,
            minValue,
            maxValue,
            onMinInput,
            onMaxInput,
            applyFilter,
            resetFilter,
        };
    },
}
</script>

<style scoped>
.price-filter__values {
    display: flex;
    justify-content: space-between;
    font-weight: 600;
    margin-bottom: .25rem;
}

.price-filter__slider {
    position: relative;
    height: 1.4rem;
}

.price-filter__range {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    background: none;
    pointer-events: none;
}

.price-filter__range::-webkit-slider-thumb {
    pointer-events: auto;
}

.price-filter__range::-moz-range-thumb {
    pointer-events: auto;
}

.price-filter__actions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: .75rem;
}

.price-filter__reset {
    background: none;
    border: none;
    padding: 0;
    font-size: .8rem;
    color: #6c757d;
    text-decoration: underline;
    cursor: pointer;
}

.price-filter__reset:hover {
    color: #212529;
}

.price-filter__apply {
    padding: .3rem 1rem;
    font-size: .8rem;
}
</style>
