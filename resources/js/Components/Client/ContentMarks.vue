<template>
    <section
        v-for="mark in marks.data"
        :key="mark.id"
        class="mark-section"
    >
        <div class="card head-block mb-3">
            <div>
                <div>
                    <img
                        v-if="mark.img_path"
                        :src="`${imgStoragePath + mark.img_path}`"
                        width="50"
                    >
                </div>
                <p>{{ mark.name }}</p>
                <p>- parts for models</p>
            </div>
        </div>
        <div class="tile-grid">
            <ImageTile
                v-for="model in mark.models"
                :key="model.id"
                :href="route('home.categories', { mark: mark.slug, model: model.slug })"
                :img-src="model.img_path ? (imgStoragePath + model.img_path) : ''"
                :title="`${mark.name} ${model.name}`"
                :subtitle="yearsLabel(model)"
            />
        </div>
    </section>
</template>

<script>
import { imgStoragePath } from '@/Mixins/General';
import ImageTile from '@/Components/Client/ImageTile.vue';

export default {
    /**
     * Name.
     */
    name: 'ContentMarks',

    /**
     * Components.
     */
    components: {
        ImageTile,
    },

    /**
     * Props.
     */
    props: {
        marks: {
            type: Object,
            default: {},
        },
    },

    /**
     * Composition API
     */
    setup() {
        return {
            imgStoragePath,
        };
    },

    /**
     * Methods.
     */
    methods: {
        yearsLabel(model) {
            if (!model.year_start) {
                return '';
            }

            return `${model.year_start}–${model.year_end || 'н.в.'}`;
        },
    },
}
</script>

<style scoped>
.mark-section {
    margin-bottom: 1.5rem;
}

.tile-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

@media (min-width: 576px) {
    .tile-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (min-width: 992px) {
    .tile-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}
</style>
