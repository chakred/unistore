<template>
    <div
        v-for="mark in marks.data"
        class="row"
    >
        <div class="col-sm-12 mb-3">
            <div class="card head-block">
                <div>
                    <div>
                        <img
                            :src="`${imgStoragePath + mark.img_path}`"
                            width="50"
                        >
                    </div>
                    <p>{{ mark.name }}</p>
                    <p>- parts for models</p>
                </div>
            </div>
        </div>
        <div
            v-for="model in mark.models"
            class="col-lg-4 col-md-6 mb-4"
        >
            <div class="card h-100 cat-block">
                <a href="#">
                    <img
                        v-if="model.img_path"
                        :src="`${imgStoragePath + model.img_path}`"
                    />
                    <img
                        v-else
                        src="http://dummyimage.com/450x350/ffffff/545454&text=No+image"
                    />
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="#">{{mark.name+' '+model.name}}</a>
                    </h5>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Years: {{model.year_start+' - '+model.year_end }}</small>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { imgStoragePath } from '@/Mixins/General';

export default {
    /**
     * Name.
     */
    name: 'ContentMarks',

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
}
</script>
