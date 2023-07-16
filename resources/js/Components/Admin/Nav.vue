<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <strong style="letter-spacing: 3px;">MOTRIO</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Dark offcanvas</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Mark/Model
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <Link :href="route('mark.index')" class="dropdown-item">Mark</Link>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <Link :href="route('model.index')" class="dropdown-item">Model</Link>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('category.index')" class="nav-link">Categories</Link>
                        </li>
                        <li class="nav-item">
                            <Link :href="route('category.index')" class="nav-link">Goods</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="pt-5 nav-second">
        <div class="container pt-4">
            <div class="row gx-5 pb-3">
                <div class="col-10">
                    {{ pageName }}
                </div>
                <div
                    v-if="createButtonAction"
                    class="col"
                >
                    <button
                        type="button"
                        data-bs-toggle="modal"
                        :data-bs-target="createButtonAction"
                    >
                        <i class="fa-solid fa-circle-plus fa-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Nav from '@/Components/Client/Nav.vue';

export default {
    /**
     * Name.
     */
    name: 'Nav',

    /**
     * Parent component.
     */
    extends: Nav,

    computed: {
        currentRouteName() {
            return this.$route.name;
        }
    },

    /**
     * props.
     */
    props: {
        pageName: {
            type: String,
            default: 'Page name',
        },
        createButtonAction: {
            type: String,
            default: null,
        }
    }
}
</script>
