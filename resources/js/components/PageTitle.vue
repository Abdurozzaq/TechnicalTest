<template>
  <div class="mx-10 mb-2 mt-5">
    <h4 class="font-weight-bold sansSerif text-title-color">{{ title }}</h4>
    <h5 class="sansSerif text-title-color">{{ subtitle }}</h5>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    subtitle: String
  }
}
</script>

<style scoped>
  .sansSerif {
    font-family: sans-serif;
  }
  .text-title-color {
    color: #7C7E81;
  }
</style>