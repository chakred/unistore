<template>
<div class="accordion mt-4" id="accordionExample">
  <div 
    v-for="mark in marks.data"
    class="accordion-item"
  >
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        {{ mark.name }}
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <ul>
          <li
            v-for="model in mark.models"
          >
            <a href="#">{{ model.name }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

</div>
</template>

<script>
export default {
    /**
     * Name.
     */
    name: 'MarkAndModel',

    /**
     * Props
     */
    props: {
        marks: {
            type: Object,
            default: {}
        }
    }
}
</script>
