<template>
  <div class="intro">
    <span class="inline">Hi! My name is </span><h1>Joseph Cook.</h1>
    <span class="inline"> I'm a </span><h2>Full-ish Stack Developer</h2><span class="inline"> and </span><h2> UX Designer.</h2> 
    <span class="inline"> I like both. </span>
    <h3> Great Divide be Damned.</h3><br/><br/>
    <span class="inline"> Here's how that happened:</span>
  </div>
  <div class="splash-deck">
    <SplashCard v-for="card in splashDeck" :card = "card" :key="card.id"/>
  </div>
</template>

<script setup>
import SplashCard from '@/components/SplashCard'

const splashDeck = [
  // Rewrite ALL of these. Add images.
  {
    id: 1,
    content: 'Web-focused graphic designer - Everything Adobe, HTML & a whole lotta tables'
  },
  {
    id: 2,
    content: 'Interaction designer - Flash. So much Flash.'
  },
  {
    id: 3,
    content: 'Sign designer with a splash of web-guy'
  },
  {
    id: 4,
    content: 'Web Devloper - PHP, WordPress, CSS, JavaScript, jQuery'
  },
  {
    id: 5,
    content: 'Full-stack(?) Software Engineer - Git, Docker, Drupal, Laravel, Vue, SCSS, XD, Figma, Agile, Jira'
  },
  // {
  //   id: 6,
  //   content: 'What\'s next? - UX Engineer? Full Stack Developer?'
  // }

]
</script>

<style scoped lang="scss">
.splash-deck {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  margin: 0 auto;
  width: 80%;
}

</style>
