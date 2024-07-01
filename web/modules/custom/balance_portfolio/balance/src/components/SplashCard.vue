<template>
  <div class="card-wrapper">
    <div class="splash-card">
      <div class="splash-img" :class=props.card.image ></div>
      <h3>{{ props.card.content }}</h3>
    </div>
    <div class="facedown"></div>
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
  .card-wrapper {
    height: 265px;
    width: 165px;
    position: relative;
    transform-style: preserve-3d;
    transition: all 0.75s ease;

    &:hover {
      transform: perspective(400px) rotateY(180deg) !important;
      z-index: 1;
    }

    .splash-card,
    .facedown {
      backface-visibility: hidden;
      border-radius: 8px;
      box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.5);
      color: #fff;
      padding: 1rem;
      position: absolute;
      height: 100%;
      width: 100%;

      h3 {
        font-size: 1.1rem;
        margin: 0;
        text-align: center;
      }
    }

    .splash-card {
      background: url('../assets/yin-card-bg.jpg') no-repeat center center;
      background-size: contain;
      font-family: 'Oswald', sans-serif;
      line-height: 1.4;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      transform: rotateY(180deg);
    }

    .facedown {
      background: url('../assets/card-back.jpg') no-repeat center center;
      background-size: contain;
    }

    .splash-img {
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
      height: 90%;
      width: auto;

      &.strut {
        background-image: url('../assets/strut.png');
      }

      &.run {
        background-image: url('../assets/run.png');
      }

      &.trip {
        background-image: url('../assets/trip.png');
      }

      &.flip {
        background-image: url('../assets/flip.png');
      }

      &.wtf {
        background-image: url('../assets/wtf.png');
      }
    }
  }
</style>