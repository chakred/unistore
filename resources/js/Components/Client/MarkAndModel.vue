<template>
    <div class="accordion mt-4" id="accordionExample">
        <div class="card">
            <div class="card-header" id="heading1">
                <h5 class="mb-0">
                    <div style="    display: inline-block;
    width: 50px;
    height: 50px;
    text-align: center;
    overflow: hidden;
    vertical-align: middle;"><img height="50"  style="object-fit: cover;
    width: 100%;" src="#"></div>
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        mark name
                    </button>
                </h5>
            </div>

            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#accordionExample">
                <div class="card-body">
                    <ul>
                        <li>Нет моделей данной марки</li>
                    </ul>
                </div>
            </div>
        </div>

<!--        <div class="card">-->
<!--            <div class="card-header" id="headingOne">-->
<!--                <h5 class="mb-0">-->
<!--                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">-->
<!--                        No marks in databese-->
<!--                    </button>-->
<!--                </h5>-->
<!--            </div>-->

<!--            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">-->
<!--                <div class="card-body">-->
<!--                    <ul>-->
<!--                        <li> No models related</li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

    </div>
</template>

<script>
export default {
    /**
     * Name.
     */
    name: 'MarkAndModel',
}
</script>
