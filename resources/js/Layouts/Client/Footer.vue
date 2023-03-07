<template>
    <!-- Footer -->
    <footer class="py-5 bg-dark" id="footer">
        <div class="container">
            <p class="m-0 text-center text-white">
                &copy;
                <strong>MOTRIO</strong>
                <br/>
               12.02.2023
            </p>
            @isset($viewNumbers)
            <p class="m-0 text-center text-white">
                <i class="fas fa-eye"></i>
                <span>{{$viewNumbers}}</span>
            </p>
            @endisset
        </div>
        <!-- /.container -->
    </footer>
</template>
