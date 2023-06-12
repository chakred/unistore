<template>
    <option 
        v-for="option in options"
        :key="option"
    >
    {{ option }}
    </option>
</template>

<script>
export default {

    /**
     * Name.
     */
    name: 'Option',

    /**
     * Props
     */
    props: {
        options: {
            type: Object,
            required: false,
        },
    },
}
</script>