<template>
    <div class="form-group mb-3">
        <label 
        :for="id" 
        class="form-label"
    >
    {{ label }}
    </label>
    <select
            :value="inputValue"
            :type="type"
            :id="id"
            class="form-control"
            @input="$emit('update:inputValue', $event.target.value)" 
    >
        <Option :options="options" />
    </select>
    </div>
</template>

<script>
import Option from '@/Components/Fields/Option.vue'

export default {
    /**
     * Name.
     */
    name: 'Select',

    /**
     * Components.
     */
     components: {
        Option,
    },

    /**
     * Props
     */
    props: {
        inputValue: {
            type: String,
            required: true,
        },
        options: {
            type: Object,
            required: false,
        },
        type: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            required: true,
        }
    },

    /**
     * Data.
     */
    data () {
        return {
            id: null
        }
    }, 

    /**
     * Hooks.
     */
    mounted () {
        this.id = this._uid
    },
}
</script>