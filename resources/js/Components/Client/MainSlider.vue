<template>
    <!-- <div id="carouselExampleSlidesOnly" class="carousel slide my-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../../../images/Client/Banners/banner1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../../../images/Client/Banners/banner2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../../../images/Client/Banners/banner3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div> -->
    <div id="carouselExampleAutoplaying" class="carousel slide my-4" data-bs-ride="carousel">
        <div class="carousel-inner" style="max-height: 232px;">
            <div class="carousel-item active">
            <img src="../../../images/Client/Banners/banner1.jpg" class="d-block w-100 img-fluid" alt="...">
            </div>
            <div class="carousel-item">
            <img src="../../../images/Client/Banners/banner2.jpg" class="d-block w-100 img-fluid" alt="...">
            </div>
            <div class="carousel-item">
            <img src="../../../images/Client/Banners/banner3.jpg" class="d-block w-100 img-fluid" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</template>

<script>
export default {
    /**
     * Name.
     */
    name: 'MainSlider',
}
</script>
