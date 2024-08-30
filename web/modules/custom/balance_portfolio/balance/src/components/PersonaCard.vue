<template>
  <div class="row two-col__one-three">
    <div class="row">
      <img v-if="props.persona.photo" :src="'/sites/default/files/' + props.persona.photo" :alt="props.persona.name + ' photo'" class="persona-photo">
      <h4>{{ props.persona.name }}</h4>
    </div>
    <div class="row">
      <div v-if="props.persona.quote" class="quote">{{ props.persona.quote }}</div>
      <div class="row two-col__even">
        <div v-if="props.persona.goals">
          <h4>Goals</h4>
          <div v-html="props.persona.goals"></div>
        </div>
        <div v-if="props.persona.frustrations">
          <h4>Frustrations</h4>
          <div v-html="props.persona.frustrations"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row two-col__one-three">
    <div class="row dir-col">
      <div class="row inline" v-if="props.persona.education">
        <h4>Education:</h4>
        <div class="education">{{ props.persona.education }}</div>
      </div>
      <div class="row inline" v-if="props.persona.hometown">
        <h4>Hometown:</h4>
        <div class="hometown">{{ props.persona.hometown }}</div>
      </div>
      <div class="row inline" v-if="props.persona.family">
        <h4>Family:</h4>
        <div class="family">{{ props.persona.family }}</div>
      </div>
      <div class="row inline" v-if="props.persona.age">
        <h4>Age:</h4>
        <div class="age">{{ props.persona.age }}</div>
      </div>
      <div class="row inline" v-if="props.persona.job">
        <h4>Job:</h4>
        <div class="job">{{ props.persona.job }}</div>
      </div>
    </div>
    <div class="description">
      <div v-if="props.persona.description" v-html="props.persona.description"></div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  persona: Object
})

</script>

<style lang="scss">
.personas-wrapper {
  padding: 0 2rem !important;
}
.persona {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  border-bottom: solid 1px $lt-blue;
  margin: 4rem 0 2rem;

  &:first-of-type {
    margin-top: 1rem;
  }

  &:last-of-type {
    border-bottom: 0;
  }

  img {
    height: min-content;
    width: 100%;
  }

  .row {
    margin-bottom: 1rem;
  }

  .description {
    p {
      margin: 0 0 1rem;
    }
  }

  .quote {
    font-family: 'Oswald', sans-serif;
    font-size: 1.5rem;
    font-style: italic;
    line-height: 1;
    margin: 0 auto;
    text-align: center;

    &::before {
      content: '"';
      font-size: 2.5rem;
      margin-right: 5px;
      vertical-align: text-top;
    }

    &::after {
      content: '"';
      font-size: 2.5rem;
      vertical-align: text-top;
    }

    @media screen and (min-width: 768px) {
      font-size: 2rem;
    }
  }
}

</style>