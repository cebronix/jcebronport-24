<template>
  <div class="collection-mode" ref="collection_mode">
    <div class="row controls-top">
      <div class="left">???</div>
      <div class="right">MODE</div>
    </div>
    <div v-for="category in categories" :key="category.id" class="collection-cards">
      <div v-for="card in gameDeck" :key="card.pid" class="card-wrapper">
        <YangCard :card="card" class="card collection-card" v-if="category == card.category[0].name"/>
        <div class="facedown" v-if="category == card.category[0].name"></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import YangCard from '@/components/YangCard'

const gameDeck = ref(window.drupalSettings.gameDeck)
const collection_mode = ref(null)
const categories = ref([])

const getCategories = function() {
  gameDeck.value.forEach((card) => {
    if (!categories.value.includes(card.category[0].name)) {
      categories.value.push(card.category[0].name)
    }
  })
}

const dealCards = function() {
  setTimeout(() => {
    ref(collection_mode).value.classList.add('dealt')
    const collectionCards = ref(collection_mode).value.querySelectorAll('.card-wrapper')
    collectionCards.forEach((card) => {
      card.style.transform = 'rotate(' + rotateRandom(25) + 'deg)'
    })
  }, 1500)
}

const rotateRandom = function(max) {
  var min = -max
  var adjustment = Math.floor(Math.random() * 25)
  var degree = Math.floor(Math.random() * (max - min + adjustment)) + min
  return degree
}

onMounted(() => {
  getCategories()
  dealCards()
  console.log(gameDeck.value)
})

</script>

<style scoped lang="scss">
.collection-mode {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 6rem;
  margin-top: 4rem;
  transition: all 0.75s ease-in-out;

  .row {
    display: flex;
    flex-basis: 100%;
  }

  .controls {
    &-top {
      justify-content: space-between;
      padding: 1rem 2rem 0;
      position: absolute;
      top: 60px;
      width: 94%;
    }
  }

  &.dealt {
    display: flex;
    transition: all 0.75s ease-in-out;

    .collection-cards {
      display: flex;
      margin-left: unset;
      margin-top: 1rem;
    }

    .card-wrapper:not(:first-of-type) {
      margin-left: -100px;
    }
  }
}

.collection-cards {
  display: inline-flex;
  flex-wrap: wrap;
  flex: 0 1 45%;
  justify-content: center;
  margin-left: -155px;
  transition: all 0.75s ease-in-out;
}

.card-wrapper {
  cursor: pointer;
  height: 310px;
  width: 196px;
  position: relative;
  transform-style: preserve-3d;
  transition: all 0.75s ease-in-out;

  &:empty {
    display: none;
  }

  &:hover {
    transform: perspective(400px) rotateY(180deg) !important;
    z-index: 1;
  }

  &:not(:first-of-type) {
    margin-left: -155px;
  }

  .collection-card,
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

  .collection-card {
    background: url('../assets/yang-card-bg.jpg') no-repeat center center;
    background-size: contain;
    font-family: 'Oswald', sans-serif;
    line-height: 1.4;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    overflow: hidden;
    transform: rotateY(180deg);

    h2 {
      margin-block-start: 0;
    }
  }

  .facedown {
    background: url('../assets/card-back.jpg') no-repeat center center;
    background-size: contain;
  }
}

</style>
