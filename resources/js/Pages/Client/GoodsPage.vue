<template>
    <Nav />
    <!-- Page Content -->
    <div class="container">
        <div class="row" style="margin-top: 100px">
            <div class="col-12">
                <Searcher />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 mb-3">
                <SidebarCategories
                    :categories="categories"
                />
                <br/>
                <SidebarPriceFilter
                    :price-range="priceRange"
                    :filters="filters"
                />
                <br/>
                <SidebarContacts />
                <br/>
                <SidebarWorkHours />
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                <MainSlider />
                <div v-if="heading" class="card head-block mb-3">
                    <div>
                        <p><span>{{ heading }}</span></p>
                    </div>
                </div>
                <GoodsSorter
                    :filters="filters"
                />
                <ContentGoods
                    :goods="goods"
                />
                <Pagination :items="goods"/>
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <Footer :viewNumbers="viewNumbers" />
</template>

<script>
import Nav from '@/Components/Client/Nav.vue';
import Searcher from '@/Components/Client/Searcher.vue';
import Footer from '@/Layouts/Client/Footer.vue';
import MainSlider from '@/Components/Client/MainSlider.vue';
import SidebarContacts from '@/Components/Client/SidebarContacts.vue';
import SidebarWorkHours from '@/Components/Client/SidebarWorkHours.vue';
import SidebarCategories from '@/Components/Client/SidebarCategories.vue';
import SidebarPriceFilter from '@/Components/Client/SidebarPriceFilter.vue';
import GoodsSorter from '@/Components/Client/GoodsSorter.vue';
import ContentGoods from '@/Components/Client/ContentGoods.vue';
import Pagination from '@/Components/Pagination.vue';

export default {
    /**
     * Name.
     */
    name: 'GoodsPage',

    /**
     * Components.
     */
    components: {
        SidebarWorkHours,
        SidebarContacts,
        MainSlider,
        Footer,
        Nav,
        Searcher,
        ContentGoods,
        SidebarCategories,
        SidebarPriceFilter,
        GoodsSorter,
        Pagination,
    },

    /**
     * Props.
     */
    props: {
        marks: {
            type: Object,
            default: {}
        },
        categories: {
            type: Object,
            default: {}
        },
        goods: {
            type: Object,
            default: {}
        },
        heading: {
            type: String,
            default: ''
        },
        viewNumbers: {
            type: Number,
            default: 0
        },
        priceRange: {
            type: Object,
            default: () => ({ min: 0, max: 0 })
        },
        filters: {
            type: Object,
            default: () => ({})
        },
    },
}
</script>
