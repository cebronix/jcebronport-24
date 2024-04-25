<template>
  <div class="card splash-card">
    <h3>{{ props.card.content }}</h3>
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