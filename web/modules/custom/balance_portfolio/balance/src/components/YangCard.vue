<template>
  <div class="card yang-card">
    <div class="card-header">
      <div class="value">
        {{ cardValue() }}
      </div>
      <h3>{{ props.card.title }}</h3>
    </div>
    <div class="type">
      X
    </div>
    <div class="content">
      <img :src="`/sites/default/files/${props.card.preview_image}`" />
    </div>
    <div class="card-footer">
      <div class="subtitle">
        <span v-html="props.card.subtitle"></span>
      </div>
      <div class="pid">
        {{ props.card.pid }}
      </div>
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

onMounted(() => {
  // console.log(props.card)
})

</script>

<style scoped lang="scss">
  .yang-card {
    background: url('../assets/yang-card-bg.jpg') no-repeat center center;
    background-size: cover;
    color: #fff;
    font-family: 'Oswald', sans-serif;
    padding: 12px;
    flex-direction: column;
    justify-content: space-between;

    .card-header {
      display: flex;
      width: 100%;

      .value {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #92B865;
        border: solid 4px #fff;
        border-radius: 50%;
        color: #2E4F72;
        font-family: 'Rubik', sans-serif;
        font-size: 2rem;
        font-weight: 700;
        height: 50px;
        width: 50px;
        margin-bottom: 5px;
      }

      h3 {
        flex-basis: 60%;
        font-size: 1.2rem;
        margin: 10px 0;
        padding-left: 1rem;
      }
    }

    .type {
      display: flex;
      justify-content: center;
      align-items: center;
      background: #2E4F72;
      border: solid 2px #fff;
      border-radius: 50%;
      height: 25px;
      width: 25px;
      position: relative;
      z-index: 1;
    }

    .content {
      margin-top: -20px;
      padding: 8px;

      img {
        width: 100%;
        height: auto;
      }
    }

    .card-footer {
      display: flex;
      justify-content: flex-end;
      width: 100%;

      .subtitle {
        flex-basis: 60%;
        margin-right: 1rem;
        text-align: right;
      }

      .pid {
        display: flex;
        justify-content: center;
        align-items: center;
        background: #2B90AE;
        border: solid 4px #fff;
        border-radius: 50%;
        font-family: 'Rubik', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
        height: 50px;
        width: 50px;
      }
    }
  }
</style>