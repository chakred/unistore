<template>
    <div class="card car-selector">
        <div class="card-body">
            <h2 class="car-selector__title">Подбор запчастей по автомобилю</h2>
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label" for="car-selector-mark">Марка</label>
                    <select
                        id="car-selector-mark"
                        v-model="selectedMarkId"
                        class="form-select"
                    >
                        <option value="" disabled>Выберите марку</option>
                        <option
                            v-for="mark in marksList"
                            :key="mark.id"
                            :value="mark.id"
                        >{{ mark.name }}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="car-selector-model">Модель</label>
                    <select
                        id="car-selector-model"
                        v-model="selectedModelId"
                        class="form-select"
                        :disabled="!selectedMarkId"
                    >
                        <option value="" disabled>Выберите модель</option>
                        <option
                            v-for="model in modelsForSelectedMark"
                            :key="model.id"
                            :value="model.id"
                        >{{ model.name }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label" for="car-selector-year">Год</label>
                    <select
                        id="car-selector-year"
                        v-model="selectedYear"
                        class="form-select"
                        :disabled="!yearOptions.length"
                    >
                        <option value="" disabled>Год</option>
                        <option
                            v-for="year in yearOptions"
                            :key="year"
                            :value="year"
                        >{{ year }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button
                        type="button"
                        class="btn btn-primary w-100"
                        :disabled="!canSubmit"
                        @click="goToCatalog"
                    >
                        Подобрать
                    </button>
                </div>
            </div>
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
}

.car-selector__title {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}
</style>
