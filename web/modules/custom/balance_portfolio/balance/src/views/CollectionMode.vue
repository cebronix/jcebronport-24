<template>
  <div v-for="card in gameDeck" :key="card.id">
    <YinCard :card="card" />
    <YangCard :card="card" />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import YinCard from '@/components/YinCard'
import YangCard from '@/components/YangCard'

const gameDeck = ref(window.drupalSettings.gameDeck)

onMounted(() => {
  console.log(gameDeck.value)
})

</script>

<style scoped lang="scss">

</style>
