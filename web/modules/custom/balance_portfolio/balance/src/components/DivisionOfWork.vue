<template>
  <!-- This is also boring. Animate the numbers? Change to a chart? -->
  <div class="divisions">
    <div v-for="div in props.dow" :key="div.id" class="division">
      <span class="percent">{{ div.percentage }}%</span>
      <h4>{{ div.category }}</h4>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  dow: Object
})

</script>

<style scoped lang="scss">
.division {
  display: flex;
  align-items: center;
  flex-direction: column;

  h4 {
    font-size: 1.25rem;
  }

  .percent {
    font-size: 2.5rem;
    font-weight: 500;
  }
}
</style>