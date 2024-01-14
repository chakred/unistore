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
                <SidebarContacts />
                <br/>
                <SidebarWorkHours />
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                    <MainSlider />
                <br/>
                <Sorting />
                <br/>
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
    <Footer />
</template>

<script>
import Nav from '@/Components/Client/Nav.vue';
import Searcher from '@/Components/Client/Searcher.vue';
import Footer from '@/Layouts/Client/Footer.vue';
import MainSlider from '@/Components/Client/MainSlider.vue';
import SidebarContacts from '@/Components/Client/SidebarContacts.vue';
import SidebarWorkHours from '@/Components/Client/SidebarWorkHours.vue';
import SidebarCategories from '@/Components/Client/SidebarCategories.vue';
import ContentMarks from '@/Components/Client/ContentMarks.vue';
import ContentGoods from '@/Components/Client/ContentGoods.vue';
import Pagination from '@/Components/Pagination.vue';
import Sorting from '@/Components/Sorting.vue';

export default {
    /**
     * Name.
     */
    name: 'SearchResultPage',

    /**
     * Components.
     */
    components: {
        Sorting,
        SidebarWorkHours,
        SidebarContacts,
        MainSlider,
        Footer,
        Nav,
        Searcher,
        ContentMarks,
        ContentGoods,
        SidebarCategories,
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
        models: {
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
        viewNumbers: {
            type: Number,
            default: 0
        },
    },
}
</script>

