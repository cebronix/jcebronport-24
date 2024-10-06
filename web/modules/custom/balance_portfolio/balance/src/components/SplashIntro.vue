<template>
  <div class="intro">
    <div class="row">Hi! My name is <h1> Joseph Cook.</h1> </div>
    <div class="row"> I'm a <h2> Software Engineer</h2> and <h2> UX Designer???</h2></div>
    <!-- <div class="row">
      <h3>I like both.</h3>
    </div> -->
    <!-- <div class="row">
      <h3> Great Divide be Damned.</h3>
    </div> -->
    <div class="row">
      <h4> Here's how that happened:</h4>
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
  // {
  //   id: 6,
  //   content: 'What\'s next? - UX Engineer? Full Stack Developer?',
  //   image: 'yin-card-bg.jpg'
  // }
  {
    id: 5,
    content: 'Software Engineer & UX Designer - Drupal, Laravel, Vue, SCSS, XD, Figma',
    image: 'wtf'
  },
  {
    id: 4,
    content: 'Web Designer & Devloper - PHP, CSS, WordPress, JavaScript, jQuery',
    image: 'crash'
  },
  {
    id: 3,
    content: 'Sign designer, sales & production with a splash of software & web-guy',
    image: 'trip'
  },
  {
    id: 2,
    content: 'Interaction designer - Sites, Flash animations & games. So much Flash.',
    image: 'run'
  },
  {
    id: 1,
    content: 'Web-focused graphic designer - Everything Adobe, HTML, CSS & a whole lotta tables',
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
    padding: 4rem 0 2rem;
    width: 85%;

    @media screen and (min-width: 768px) {
      margin-top: 4rem;
    }

    .row {
      align-items: center;
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin: 0 auto;
      max-width: 900px;
      width: 100%;

      &:first-of-type {
        justify-content: center;
      }

      &:nth-child(even) {
        padding-left: 3rem;
      }

      &:nth-child(3) {
        justify-content: flex-end;
        padding-right: 4rem;
      }

      &:last-of-type {
        justify-content: center;
      }
    }
  }

  h1,
  h2,
  h3,
  h4 {
    color: $lt-blue;
    font-family: $primary-font;
    font-weight: 400;
    margin: 0;
  }

  h1 {
    font-size: 4rem;
  }

  h2 {
    font-size: 3rem;
  }

  h3 {
    color: $green;
    font-family: $secondary-font;
    font-size: 2.5rem;
    text-transform: uppercase;
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
    background-color: $lt-blue;
    border: 0;
    border-radius: 5px;
    color: $white;
    cursor: pointer;
    font-family: $secondary-font;
    font-weight: 400;
    text-decoration: none;
    text-transform: uppercase;
    margin: 1rem 0 0;
    padding: 0.5rem 1rem;

    &:hover {
      background-color: $blue;
    }
  }

</style>
