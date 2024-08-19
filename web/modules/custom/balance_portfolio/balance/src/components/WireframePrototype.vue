<template>
  <div class="row two-col__one-three">
    <div class="wfpt-info stacked-col">
      <h4>{{ props.wfpt.title }}</h4>
      <span class="wfpt-intro" v-html="props.wfpt.intro"></span>
      <span v-if="props.wfpt.highlights" class="wfpt-highlights" v-html="props.wfpt.highlights"></span>
      <a v-if="props.wfpt.link_uri" :href="props.wfpt.link_uri">{{ props.wfpt.link_text }}</a>
    </div>
    <div v-if="props.wfpt.images" class="previews">
      <img v-for="preview in props.wfpt.images" :src="'/sites/default/files/' + preview" :key="preview.id" alt="" />
    </div>
  </div>
</template>

<script setup>
import { defineProps, onMounted } from 'vue'

const props = defineProps({
  wfpt: Object
})

onMounted(() => {
  // console.log(props.wfpt)
})

</script>

<style lang="scss">

.previews {
  margin-top: 1rem;
}

</style>