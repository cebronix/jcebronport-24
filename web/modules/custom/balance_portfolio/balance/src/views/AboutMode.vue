<template>
  <div class="about-mode" ref="about_mode">
    <!-- <h2>50th Anniversary of existence</h2>  -->
    <div v-for="category in aboutDeck" :key="category.id" class="about-cards">
      <!-- <h3>{{ betterCategory(category[0].category) }}</h3> -->
      <div v-for="card in category"
        :key="card.id"
        class="card-wrapper"
      >
        <AboutCard :card="card" class="card about-card" />
        <div class="facedown"></div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AboutCard from '@/components/AboutCard'

const about_mode = ref(null)
const aboutDeck = ref(window.drupalSettings.aboutDeck)

const dealCards = function() {
  setTimeout(() => {
    ref(about_mode).value.classList.add('dealt')
    // const aboutCards = ref(about_mode).value.querySelectorAll('.card-wrapper')
    // aboutCards.forEach((card) => {
    //   card.style.transform = 'rotate(' + rotateRandom(35) + 'deg)'
    // })
  }, 1500)
}

// const rotateRandom = function(max) {
//   var min = -max
//   var adjustment = Math.floor(Math.random() * 25)
//   var degree = Math.floor(Math.random() * (max - min + adjustment)) + min
//   return degree
// }

onMounted(() => {
  // console.log(aboutDeck.value)
  dealCards()
})

</script>

<style scoped lang="scss">
.about-mode {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 6rem;
  margin-top: 100px;
  transition: all 0.75s ease-in-out;

  &.dealt {
    display: flex;
    transition: all 0.75s ease-in-out;

    .about-cards {
      display: flex;
      margin-left: 0;
    }

    .card-wrapper:not(:first-of-type) {
      margin-left: 0;
    }
  }
}

.about-cards {
  display: inline-flex;
  flex-wrap: wrap;
  flex: 0 1 45%;
  justify-content: center;
  margin-left: -155px;
  transition: all 0.75s ease-in-out;

  &:last-of-type {
    flex: 0 1 90%;
  }
}

.card-wrapper {
  height: 265px;
  width: 165px;
  position: relative;
  transform-style: preserve-3d;
  transition: all 0.75s ease-in-out;

  &:hover {
    transform: perspective(400px) rotateY(180deg) !important;
    z-index: 1;
  }

  &:not(:first-of-type) {
    margin-left: -155px;
  }

  .about-card,
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

  .about-card {
    background: url('../assets/yin-card-bg.jpg') no-repeat center center;
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
