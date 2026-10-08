<template>
    <a :href="href" class="image-tile">
        <div
            class="image-tile__media"
            :class="{ 'image-tile__media--no-image': !imgSrc }"
        >
            <img
                :src="imgSrc || placeholder"
                :class="{ 'image-tile__media-placeholder': !imgSrc }"
                :alt="title"
            />
            <div v-if="icon" class="image-tile__icon">
                <i :class="icon"></i>
            </div>
            <div class="image-tile__overlay">
                <span class="image-tile__name">{{ title }}</span>
                <span
                    v-if="subtitle"
                    class="image-tile__subtitle"
                >{{ subtitle }}</span>
            </div>
        </div>
    </a>
</template>

<script>
import placeholder from '../../../images/Client/mechanical_parts_gray_vector.svg';

export default {
    /**
     * Name.
     */
    name: 'ImageTile',

    /**
     * Props.
     */
    props: {
        href: {
            type: String,
            required: true,
        },
        imgSrc: {
            type: String,
            default: '',
        },
        title: {
            type: String,
            required: true,
        },
        subtitle: {
            type: String,
            default: '',
        },
        icon: {
            type: String,
            default: '',
        },
    },

    /**
     * Composition API.
     */
    setup() {
        return {
            placeholder,
        };
    },
}
</script>

<style scoped>
.image-tile {
    display: block;
    border-radius: 8px;
    overflow: hidden;
    text-decoration: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, .08);
    transition: transform .2s ease, box-shadow .2s ease;
}

.image-tile:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, .15);
}

.image-tile__media {
    position: relative;
    width: 100%;
    aspect-ratio: 4 / 3;
    overflow: hidden;
    background: #f1f1f1;
}

.image-tile__media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s ease;
}

.image-tile__media--no-image {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
}

.image-tile__media .image-tile__media-placeholder {
    width: 130px;
    height: 130px;
    object-fit: contain;
}

.image-tile:hover .image-tile__media img {
    transform: scale(1.06);
}

.image-tile__icon {
    position: absolute;
    top: .6rem;
    left: .6rem;
    width: 2.25rem;
    height: 2.25rem;
    border-radius: 50%;
    background: rgba(255, 255, 255, .92);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 6px rgba(0, 0, 0, .15);
    font-size: 1.05rem;
    color: #212529;
}

.image-tile__overlay {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    padding: .75rem .9rem;
    display: flex;
    flex-direction: column;
    gap: .15rem;
    background: linear-gradient(to top, rgba(0, 0, 0, .75) 0%, rgba(0, 0, 0, 0) 100%);
    color: #fff;
}

.image-tile__name {
    font-weight: 700;
    font-size: .95rem;
    text-transform: uppercase;
    line-height: 1.2;
}

.image-tile__subtitle {
    font-size: .78rem;
    opacity: .85;
}
</style>
