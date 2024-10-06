<template>
  <div class="card-wrapper">
    <div class="splash-card">
      <div class="splash-img" :class=props.card.image ></div>
      <h3>{{ props.card.content }}</h3>
    </div>
    <div class="facedown">
      <!-- <div class="splash-count">{{ props.card.id }}</div> -->
    </div>
  </div>
</template>

<script setup>

import { defineProps, onMounted } from 'vue'

const props = defineProps({
  card: Object,
  index: Number
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
      color: $white;
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
      font-family: $secondary-font;
      line-height: 1.4;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      transform: rotateY(180deg);
    }

    .facedown {
      display: flex;
      justify-content: center;
      align-items: center;
      background: radial-gradient(circle, rgba(146,184,101,1) 0%, rgba(43,144,174,1) 75%);
      position: relative;

      &::after {
        background-image: url('../assets/cardback-pattern-only.png');
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 92%;
        content: '';
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
      }

      .splash-count {
        color: white;
        font-family: $primary-font;
        font-size: 6rem;
        position: relative;
        z-index: 1;
      }
    }

    .splash-img {
      background-size: contain;
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

      &.crash {
        background-image: url('../assets/crash.png');
      }

      &.wtf {
        background-image: url('../assets/wtf.png');
      }
    }
  }
</style>