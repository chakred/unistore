<template>
    <label
        class="image-upload"
        :class="{ 'image-upload--has-image': imgUrl, 'is-invalid': error }"
    >
        <input
            type="file"
            accept="image/*"
            class="image-upload__input"
            v-bind="$attrs"
        >
        <template v-if="imgUrl">
            <img :src="imgUrl" alt="preview" class="image-upload__img" />
            <div class="image-upload__overlay">
                <span>{{ hoverLabel }}</span>
            </div>
        </template>
        <div v-else class="image-upload__placeholder">
            <i class="fas fa-cloud-upload-alt"></i>
            <span>{{ placeholder }}</span>
        </div>
    </label>
    <div v-if="error" class="text-danger small mt-1">{{ error }}</div>
</template>

<script>
export default {
    /**
     * Name.
     */
    name: 'ImageUploadBox',

    /**
     * Disable automatic attribute inheritance so that
     * listeners/attrs are bound explicitly to the file input.
     */
    inheritAttrs: false,

    /**
     * Props.
     */
    props: {
        imgUrl: {
            type: String,
            default: null,
        },
        error: {
            type: String,
            default: null,
        },
        placeholder: {
            type: String,
            default: 'Загрузите картинку',
        },
        hoverLabel: {
            type: String,
            default: 'Заменить картинку',
        },
    },
}
</script>

<style scoped>
.image-upload {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 220px;
    border: 2px dashed #ced4da;
    border-radius: .375rem;
    background: #f8f9fa;
    cursor: pointer;
    overflow: hidden;
    margin-bottom: 0;
    transition: border-color .2s ease;
}

.image-upload:hover {
    border-color: #6c757d;
}

.image-upload.is-invalid {
    border-color: #dc3545;
}

.image-upload--has-image {
    border-style: solid;
}

.image-upload__input {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

.image-upload__placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .5rem;
    color: #6c757d;
    font-size: .9rem;
    text-align: center;
    padding: 0 1rem;
    pointer-events: none;
}

.image-upload__placeholder i {
    font-size: 1.75rem;
}

.image-upload__img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-upload__overlay {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, .55);
    color: #fff;
    font-weight: 600;
    text-align: center;
    padding: 0 1rem;
    opacity: 0;
    pointer-events: none;
    transition: opacity .2s ease;
}

.image-upload:hover .image-upload__overlay {
    opacity: 1;
}
</style>
