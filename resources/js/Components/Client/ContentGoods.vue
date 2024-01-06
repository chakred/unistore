<template>
    <div
        class="row"
    >
        <div
            v-for="good in goods.data"
            class="col-lg-4 col-md-6 mb-4"
        >
            <div class="card h-100 cat-block">
                <a
                    href="#"
                >
                    <img
                        v-if="good.img_path"
                        :src="`${imgStoragePath + good.img_path}`"
                    />
                    <img
                        v-else
                        src="http://dummyimage.com/450x350/ffffff/545454&text=No+image"
                    />
                </a>
                <div class="card-body">
                    <h5 class="card-title">
                        <a
                            href="route('home.categories', { mark: mark.name, model:model.name })"
                        >{{good.name}}</a>
                    </h5>
                </div>
                <div class="card-footer">
                    <small class="text-muted">test</small>
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
    name: 'ContentGoods',

    /**
     * Props.
     */
    props: {
        goods: {
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
