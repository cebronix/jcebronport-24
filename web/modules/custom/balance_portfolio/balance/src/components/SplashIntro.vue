<template>
  <div class="intro">
    <div class="row">Hi! My name is <h1> Joseph Cook.</h1> </div>
    <div class="row">I'm a <h2> Software Developer</h2> and <h2> UX Engineer</h2></div>
    <!-- <div class="row">
      <h3>Occassionaly I draw things.</h3>
    </div> -->
    <div class="row">
      <h4>Here's the hand I've been playing</h4>
    </div>
  </div>
  <div class="splash-deck" ref="splash_deck">
    <SplashCard v-for="(card, index) in splashDeck" :card = "card" :index = "index" :key="card.id"/>
  </div>
  <div class="learn-more">
    <router-link :to="{ name: 'about' }" class="button">Learn More</router-link>
    <router-link :to="{ name: 'work' }" class="button">My Work</router-link>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import SplashCard from '@/components/SplashCard'

const splash_deck = ref(null)

const dealCards = function() {
  setTimeout(() => {
    ref(splash_deck).value.classList.add('dealt')
    const splashCards = ref(splash_deck).value.querySelectorAll('.card-wrapper')
    splashCards.forEach((card) => {
      card.style.transform = 'rotate(' + rotateRandom(20) + 'deg)'
    })
  }, 1500)
}

const rotateRandom = function(max) {
  var min = -max
  var adjustment = Math.floor(Math.random() * 20)
  var degree = Math.floor(Math.random() * (max - min + adjustment)) + min
  return degree
}

// Move these to a config page.
const splashDeck = [
  {
    id: 5,
    content: 'Dev & UX, Drupal, Laravel, Vue, React, SCSS, XD, Figma',
    image: 'wtf'
  },
  {
    id: 4,
    content: 'Dev & design, Affinity Suite, PHP, CSS, WordPress, JavaScript, jQuery',
    image: 'crash'
  },
  {
    id: 3,
    content: 'Sign design, sales & production with a splash of web dev',
    image: 'trip'
  },
  {
    id: 2,
    content: 'Interactive websites, Flash animations & games',
    image: 'run'
  },
  {
    id: 1,
    content: 'Web & Graphic design, Adobe Creative Suite, HTML & CSS',
    image: 'strut'
  }
]

onMounted(() => {
  dealCards()
})

</script>

<style scoped lang="scss">
  .spalsh-intro {
    overflow: hidden;
  }

  .intro {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-family: $secondary-font;
    font-size: 2rem;
    margin: 1rem auto 0;
    padding: 4rem 0 2rem 3rem;
    width: 85%;

    @media screen and (min-width: 768px) {
      margin-top: 4rem;
    }

    .row {
      align-items: center;
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      justify-content: center;
      margin: 0 auto;
      max-width: 900px;
      width: 100%;
    }
  }

  h1,
  h2,
  h3,
  h4 {
    color: $gold;
    font-family: $primary-font;
    font-weight: 400;
    margin: 0;
  }

  h1 {
    font-size: 4rem;
  }

  h2 {
    color: $green;
    font-size: 3rem;
  }

  h3 {
    color: $gold;
    font-family: $primary-font;
    font-size: 2.5rem;
  }

  h4 {
    color: $white;
    font-family: $secondary-font;
    font-size: 2rem;
  }

  .splash-deck {
    display: flex;
    flex-direction: row-reverse;
    flex-wrap: wrap;
    justify-content: center;
    margin: 1rem auto;
    transition: all 0.1s ease-in-out;
    width: 95%;

    .card-wrapper {
      pointer-events: none;
      &:not(:last-of-type) {
        margin-left: -160px;
      }
    }

    &.dealt {
      transition: all 0.75s ease-in-out;
      width: 65%;

      @media screen and (min-width: 768px) {
        width: 95%;
      }

      .card-wrapper {
        margin-left: -10%;
        pointer-events: all;

        @media screen and (min-width: 768px) {
          margin-left: -5%;
        }

        @media screen and (min-width: 1084px) {
          margin-left: unset;
        }
      }
    }
  }

  .learn-more {
    margin: 4rem auto;
    display: flex;
    width: 85%;
    justify-content: center;
    gap: 2rem;
    padding-left: 2rem;
  }

  .button {
    background-color: $green;
    border: 0;
    border-radius: 5px;
    color: $black;
    cursor: pointer;
    font-family: $secondary-font;
    font-weight: 400;
    text-decoration: none;
    text-transform: uppercase;
    margin: 1rem 0 0;
    padding: 0.5rem 1rem;

    &:hover {
      background-color: $gold;
    }
  }

</style>
