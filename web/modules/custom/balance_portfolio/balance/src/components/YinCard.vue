<template>
  <div class="card yin-card">
    <div class="card-header">
      <div class="value">
        {{ cardValue() }}
      </div>
      <h3>PROBLEM</h3>
    </div>
    <div class="type">
      X
    </div>
    <div class="content">
      <span v-html="props.card.problem.slice(0, 200) + contentLength()"></span>
    </div>
    <div class="hidden pid">
      {{ props.card.pid }}
    </div>
  </div>
</template>

<script setup>

import { defineProps, onMounted } from 'vue';

const props = defineProps({
  card: Object
})

const cardValue = () => {
  const min = 5
  const max = 20
  const cardValue = Math.floor(Math.random() * (max - min + 1)) + min

  return cardValue
}

const contentLength = () => {
  if (props.card.problem.length > 200) {
    return '...'
  } else {
    return ''
  }
}

onMounted(() => {
  // console.log(props.card)
})

</script>

<style scoped lang="scss">
  .yin-card {
    background: url('../assets/yin-card-bg.jpg') no-repeat center center;
    background-size: cover;
    color: $white;
    font-family: $secondary-font;
    padding: 12px;
    flex-direction: column;
    justify-content: space-between;

    .card-header {
      background-color: $white;
      border: solid 2px $gold;
      border-radius: 5px;
      display: flex;
      position: relative;
      width: 100%;

      .value {
        display: flex;
        justify-content: center;
        align-items: center;
        background: $green;
        border: solid 4px $white;
        border-radius: 50%;
        color: $blue;
        font-family: $primary-font;
        font-size: 1.3rem;
        font-weight: 700;
        height: 30px;
        margin-bottom: 5px;
        position: absolute;
        top: 2px;
        left: -5px;
        width: 30px;
      }

      h3 {
        color: $blue;
        flex-basis: 100%;
        font-size: 1.2rem;
        margin: 4px 0;
        padding-left: 8px;
        text-align: center;
      }
    }

    .type {
      display: flex;
      justify-content: center;
      align-items: center;
      background: $blue;
      border: solid 2px $white;
      border-radius: 50%;
      float: right;
      height: 20px;
      width: 20px;
      margin-top: -12px;
      position: relative;
      z-index: 1;
    }

    .content {
      font-size: 0.85rem;
      line-height: 1.1rem;
      padding: 4px 8px;
    }
  }

</style>