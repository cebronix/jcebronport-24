<template>
  <div class="card yin-card">
    <h2>{{ props.card.title }}</h2>
    <h3>{{ props.card.subtitle }}</h3>
  </div>
</template>

<script setup>

import { defineProps, onMounted } from 'vue';

const props = defineProps({
  card: Object
})

onMounted(() => {
  // console.log(props.card);
})

</script>

<style scoped lang="scss">

</style>