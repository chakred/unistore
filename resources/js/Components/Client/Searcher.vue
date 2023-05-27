<template>
    <div class="search-for-goods">
        <form action="#" method="POST" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="searchForGoods"
                       placeholder="Поиск товара"> <span class="input-group-btn">
            <button type="submit" class="btn btn-dark">
                <i class="fas fa-search"></i>
            </button>
        </span>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    /**
     * Name.
     */
    name: 'Searcher',

}
</script>
