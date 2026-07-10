<template>
    <tr>
        <td>
            <img
                v-if="item.image"
                :src="`${imgStoragePath}/${item.image}`"
                width="60"
            />
            <img
                v-else
                width="60"
                src="http://dummyimage.com/60x60/ffffff/545454&text=No+image"
            />
        </td>
        <td>
            {{ item.name }}
            <div v-if="item.brand" class="text-muted small">TM: {{ item.brand }}</div>
        </td>
        <td>{{ item.price }} {{ item.currency }}</td>
        <td>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-outline-secondary" @click="$emit('decrease', item.id)">-</button>
                <span class="mx-2">{{ item.quantity }}</span>
                <button type="button" class="btn btn-sm btn-outline-secondary" @click="$emit('increase', item.id)">+</button>
            </div>
        </td>
        <td>{{ item.subtotal }} {{ item.currency }}</td>
        <td>
            <button type="button" class="btn btn-sm btn-outline-danger" @click="$emit('remove', item.id)">
                &times;
            </button>
        </td>
    </tr>
</template>

<script>
import { imgStoragePath } from '@/Mixins/General';

export default {
    /**
     * Name.
     */
    name: 'CartItem',

    /**
     * Props.
     */
    props: {
        item: {
            type: Object,
            required: true,
        },
    },

    /**
     * Emits.
     */
    emits: ['increase', 'decrease', 'remove'],

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
