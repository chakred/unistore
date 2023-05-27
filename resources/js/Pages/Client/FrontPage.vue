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
                <MarkAndModel />
                <br/>
                <SidebarContacts />
                <br/>
                <SidebarWorkHours />
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
                    <MainSlider />
<!--                @include('parts.content-models')-->
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
import MarkAndModel from '@/Components/Client/MarkAndModel.vue';
import SidebarContacts from '@/Components/Client/SidebarContacts.vue';
import SidebarWorkHours from '@/Components/Client/SidebarWorkHours.vue';

export default {
    /**
     * Name.
     */
    name: 'FrontPage',

    /**
     * Components.
     */
    components: {
        SidebarWorkHours,
        SidebarContacts,
        MarkAndModel,
        MainSlider,
        Footer,
        Nav,
        Searcher
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
        viewNumbers: {
            type: Number,
            default: 0
        },
    },
}
</script>

