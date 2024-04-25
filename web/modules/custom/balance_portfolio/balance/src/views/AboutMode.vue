<template>
  <!-- <h2>50th Anniversary of existence</h2>  -->
  <!-- GROUP some of them together?? Like Work Exp -->
  <div v-for="card in aboutDeck" :key="card.id">
    <AboutCard :card="card" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AboutCard from '@/components/AboutCard'

const aboutDeck = ref(window.drupalSettings.aboutDeck)

onMounted(() => {
  console.log(aboutDeck.value)
})

</script>

<style scoped lang="scss">

</style>
