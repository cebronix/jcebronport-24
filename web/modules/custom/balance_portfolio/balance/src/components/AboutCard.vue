<template>
  <div class="card about-card">
    <h2>{{ props.card.category }}</h2>
  </div>
</template>

<script setup>

import { defineProps, onMounted } from 'vue'

const props = defineProps({
  card: Object
})

onMounted(() => {
  // console.log(props.card);
})

</script>

<style scoped lang="scss">

</style>