<template>
    <div class="car-selector">
        <div class="car-selector__heading">
            <span class="car-selector__icon"><i class="fa-solid fa-car"></i></span>
            <div>
                <h2 class="car-selector__title">{{ $t('carSelector.title') }}</h2>
                <p class="car-selector__subtitle">{{ $t('carSelector.subtitle') }}</p>
            </div>
        </div>
        <div class="car-selector__fields">
            <div class="car-selector__field">
                <label class="car-selector__label" for="car-selector-mark">{{ $t('carSelector.mark') }}</label>
                <select
                    id="car-selector-mark"
                    v-model="selectedMarkId"
                    class="form-select car-selector__select"
                >
                    <option value="" disabled>{{ $t('carSelector.selectMark') }}</option>
                    <option
                        v-for="mark in marksList"
                        :key="mark.id"
                        :value="mark.id"
                    >{{ mark.name }}</option>
                </select>
            </div>
            <div class="car-selector__field">
                <label class="car-selector__label" for="car-selector-model">{{ $t('carSelector.model') }}</label>
                <select
                    id="car-selector-model"
                    v-model="selectedModelId"
                    class="form-select car-selector__select"
                    :disabled="!selectedMarkId"
                >
                    <option value="" disabled>{{ $t('carSelector.selectModel') }}</option>
                    <option
                        v-for="model in modelsForSelectedMark"
                        :key="model.id"
                        :value="model.id"
                    >{{ model.name }}</option>
                </select>
            </div>
            <div class="car-selector__field car-selector__field--year">
                <label class="car-selector__label" for="car-selector-year">{{ $t('carSelector.year') }}</label>
                <select
                    id="car-selector-year"
                    v-model="selectedYear"
                    class="form-select car-selector__select"
                    :disabled="!yearOptions.length"
                >
                    <option value="" disabled>{{ $t('carSelector.year') }}</option>
                    <option
                        v-for="year in yearOptions"
                        :key="year"
                        :value="year"
                    >{{ year }}</option>
                </select>
            </div>
            <button
                type="button"
                class="car-selector__submit"
                :disabled="!canSubmit"
                @click="goToCatalog"
            >
                {{ $t('carSelector.submit') }}
            </button>
        </div>
    </div>
</template>

<script>
import { computed, inject, ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';

export default {
    /**
     * Name.
     */
    name: 'CarSelectorWidget',

    /**
     * Props.
     */
    props: {
        marks: {
            type: Object,
            default: () => ({}),
        },
    },

    /**
     * Composition API.
     */
    setup(props) {
        const route = inject('route');

        const marksList = computed(
            () => (props.marks.data ?? []).filter((mark) => mark.active)
        );

        const selectedMarkId = ref('');
        const selectedModelId = ref('');
        const selectedYear = ref('');

        const selectedMark = computed(
            () => marksList.value.find((mark) => mark.id === selectedMarkId.value) ?? null
        );

        const modelsForSelectedMark = computed(
            () => (selectedMark.value?.models ?? []).filter((model) => model.active)
        );

        const selectedModel = computed(
            () => modelsForSelectedMark.value.find((model) => model.id === selectedModelId.value) ?? null
        );

        const yearOptions = computed(() => {
            const model = selectedModel.value;
            if (!model || !model.year_start) {
                return [];
            }

            const start = Number(model.year_start);
            const end = Number(model.year_end) || new Date().getFullYear();
            const years = [];
            for (let year = end; year >= start; year--) {
                years.push(year);
            }

            return years;
        });

        watch(selectedMarkId, () => {
            selectedModelId.value = '';
            selectedYear.value = '';
        });

        watch(selectedModelId, () => {
            selectedYear.value = '';
        });

        const canSubmit = computed(() => {
            if (!selectedMark.value || !selectedModel.value) {
                return false;
            }

            return yearOptions.value.length === 0 || Boolean(selectedYear.value);
        });

        const goToCatalog = () => {
            if (!canSubmit.value) {
                return;
            }

            const params = {
                mark: selectedMark.value.slug,
                model: selectedModel.value.slug,
            };

            if (selectedYear.value) {
                params.year = selectedYear.value;
            }

            router.visit(route('home.categories', params));
        };

        return {
            marksList,
            selectedMarkId,
            selectedModelId,
            selectedYear,
            modelsForSelectedMark,
            yearOptions,
            canSubmit,
            goToCatalog,
        };
    },
}
</script>

<style scoped>
.car-selector {
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    border-radius: 8px;
    background: linear-gradient(135deg, #212529 0%, #343a40 100%);
    box-shadow: 0 10px 24px rgba(0, 0, 0, .18);
}

.car-selector__heading {
    display: flex;
    align-items: center;
    gap: .9rem;
    margin-bottom: 1.25rem;
}

.car-selector__icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 2.75rem;
    height: 2.75rem;
    border-radius: 50%;
    background: rgba(255, 255, 255, .12);
    color: #fff;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.car-selector__title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: .2rem;
}

.car-selector__subtitle {
    font-size: .85rem;
    color: rgba(255, 255, 255, .65);
    margin-bottom: 0;
}

.car-selector__fields {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: .75rem;
    align-items: end;
}

@media (min-width: 768px) {
    .car-selector__fields {
        grid-template-columns: 1fr 1fr .6fr auto;
    }
}

.car-selector__field--year {
    grid-column: span 2;
}

@media (min-width: 768px) {
    .car-selector__field--year {
        grid-column: auto;
    }
}

.car-selector__label {
    display: block;
    font-size: .72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .03em;
    color: rgba(255, 255, 255, .6);
    margin-bottom: .3rem;
}

.car-selector__select {
    border: none;
    border-radius: 6px;
    padding-top: .55rem;
    padding-bottom: .55rem;
}

.car-selector__submit {
    grid-column: span 2;
    border: none;
    border-radius: 6px;
    padding: .55rem 1.5rem;
    font-weight: 700;
    color: #212529;
    background: #ffc107;
    transition: background-color .15s ease, transform .15s ease;
    white-space: nowrap;
}

@media (min-width: 768px) {
    .car-selector__submit {
        grid-column: auto;
    }
}

.car-selector__submit:hover:not(:disabled) {
    background: #ffca2c;
    transform: translateY(-1px);
}

.car-selector__submit:disabled {
    background: #6c757d;
    color: rgba(255, 255, 255, .7);
    cursor: not-allowed;
}
</style>
