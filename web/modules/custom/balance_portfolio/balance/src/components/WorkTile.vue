<template>
  <div class="tile-details">
    <h3>{{ props.card.title }}</h3>
    <h4>{{ props.card.subtitle }}</h4>
    <span v-html="trimText(props.card.problem)" class="tile-problem"></span>
    <button @click="loadCaseStudy(props.card.pid)">Details</button>
  </div>
  <img :src="`/sites/default/files/${props.card.preview_image}`" />
</template>

<script setup>

import { defineProps, onMounted } from 'vue'
import { useRouter } from 'vue-router'
const router = useRouter();

const props = defineProps({
  card: Object
})

const trimText = (text) => {
  if (text.length <= 225) return text

  return text.substring(0, 225) + '..'
}

const loadCaseStudy = (pid) => {
  router.push({ name: 'case-study', params: { pid: pid } })
  if (router.currentRoute.value.name === 'case-study') {
    setTimeout(() => {
      router.go(0)
    }, 10)
  }
}

onMounted(() => {
  // console.log(props.card)
})

</script>

<style lang="scss">
.tile-details {
  position: absolute;
  top: 75%;
  right: 0;
  left: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.75);
  padding: 2rem;
  transition: all 0.5s ease-in-out;

  p {
    max-width: unset !important;
  }

  h3 {
    font-family: 'Rubik', sans-serif;
    font-size: 1.75rem;
    font-weight: 400;
    margin: 0;
  }

  h4 {
    font-family: 'Oswald', sans-serif;
    font-size: 1.25rem;
    font-weight: 400;
    margin: 4px 0 5rem;
  }

  img {
    height: auto;
    width: 100%;
  }
}

button {
  background-color: #2B90AE;
  border: 0;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  float: right;
  font-family: 'Oswald', sans-serif !important;
  margin: 1rem 0 0 !important;
  padding: 0.5rem 1.5rem;
  text-transform: uppercase !important;

  &:hover {
    background-color: #2E4F72;
  }
}
</style>