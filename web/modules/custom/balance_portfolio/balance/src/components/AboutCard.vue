<template>
  <div v-if="props.card.category == 'Work Experience'">
    <h2>{{ props.card.main_title }}</h2>
    <h3>{{ props.card.work_experience.title }}</h3>
    <h4>{{ props.card.work_experience.duration }}</h4>
    <span v-html="props.card.work_experience.body"></span>
    <div>
      <!-- division of work here -->
    </div>
  </div>
  <div v-else-if="props.card.category == 'Education'">
    <h2>{{ props.card.main_title }}</h2>
    <span v-html="props.card.education"></span>
  </div>
  <div v-else-if="props.card.category == 'Certificates and Awards'">
    <h2>{{ props.card.main_title }}</h2>
    <span v-for="cert_award in props.card.certs_awards" v-html="'- ' + cert_award.value" :key="cert_award.id"></span>
  </div>
  <div v-else-if="props.card.category == 'Plain Text'">
    <h2>{{ props.card.main_title }}</h2>
    <span v-html="props.card.body"></span>
  </div>
  <div v-else-if="props.card.category == 'Leveled Data'">
    <h2>{{ props.card.leveled_data.title }}</h2>
    <!-- How to represent the level? -->
    <div class="level-img" :class=props.card.leveled_data.level.toLowerCase() ></div>
    <h3>{{ props.card.leveled_data.level }}</h3>
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
.level-img {
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  height: 90%;
  width: auto;
}
</style>