<template>
  <div
    v-if="props.card.category == 'Work Experience'"
    class="sub-wrapper about-tile work-cat"
    data-aos="flip-up"
    data-aos-duration="350"
    data-aos-delay="300"
  >
    <h3>{{ props.card.main_title }}</h3>
    <h4>{{ props.card.work_experience.title }}</h4>
    <h5>{{ props.card.work_experience.duration }}</h5>
    <span v-html="props.card.work_experience.body"></span>
    <div>
      <DivisonOfWork :dow = props.card.work_experience.division_work />
    </div>
  </div>
  <div
    v-else-if="props.card.category == 'Plain Text'"
    class="sub-wrapper about-tile random-cat"
    data-aos="flip-up"
    data-aos-duration="350"
    data-aos-delay="300"
  >
    <h3>{{ props.card.main_title }}</h3>
    <span v-html="props.card.body"></span>
  </div>
  <div
    v-else-if="props.card.category == 'Education'"
    class="sub-wrapper about-tile edu-cat"
    data-aos="flip-up"
    data-aos-duration="350"
    data-aos-delay="300"
  >
    <h3>{{ props.card.main_title }}</h3>
    <span v-html="props.card.education"></span>
  </div>
  <div
    v-else-if="props.card.category == 'Certificates and Awards'"
    class="sub-wrapper about-tile certs-cat"
    data-aos="flip-up"
    data-aos-duration="350"
    data-aos-delay="300"
  >
    <h3>{{ props.card.main_title }}</h3>
    <ul>
      <li v-for="cert_award in props.card.certs_awards" v-html="cert_award.value" :key="cert_award.id"></li>
    </ul>
  </div>
  <div
    v-else-if="props.card.category == 'Leveled Data'"
    class="sub-wrapper about-tile leveled-cat"
    data-aos="flip-up"
    data-aos-duration="350"
    data-aos-delay="300"
  >
    <div class="row">
      <h3>{{ props.card.leveled_data.title }}</h3>
      <h4>{{ props.card.leveled_data.level }}</h4>
    </div>
    <div class="row">
      <!-- This is so boring. Animate the slider? Change to an illustration? Can I sort them?  -->
      <div class="level-bar">
        <div class="segment"></div>
        <div class="segment"></div>
        <div class="segment"></div>
      </div>
      <div class="level-indicator" :class=props.card.leveled_data.level.toLowerCase()></div>
    </div>
  </div>
</template>

<script setup>
import { defineProps, onMounted } from 'vue'
import DivisonOfWork from '@/components/DivisionOfWork.vue'

const props = defineProps({
  card: Object
})

onMounted(() => {
  // console.log(props.card)
})

</script>

<style lang="scss">
.about-tile {
  padding: 2rem;

  h3,
  h4,
  h5 {
    font-family: $secondary-font;
  }

  h3 {
    color: $green;
    font-size: 2rem;
    font-weight: 400;
  }

  h4 {
    font-size: 1.5rem;
    font-weight: 400;
    margin: 10px 0;
  }

  h5 {
    font-size: 1.25rem;
    font-weight: 400;
  }

  p,
  li {
    font-size: 1.2rem;
  }

  &.work-cat {
    display: flex;
    flex-direction: column;
    justify-content: space-between;

    h3 {
      color: $white;
      margin-bottom: 1rem;
    }

    h4 {
      color: $green;
      margin: 0;
    }

    h5 {
      margin-top: 1rem;
    }
  }

  .divisions {
    display: flex;
    justify-content: space-around;
    margin: 2rem 0;
  }

  &.leveled-cat {
    .row {
      align-items: flex-end;
    }

    h3,
    h4 {
      margin: 0.75rem 0 0;
    }
  }

  .level-bar {
    background-color: $black;
    border: 2px solid $gold;
    border-radius: 10px;
    display: flex;
    margin-top: 2rem;
    width: 100%;

    .segment {
      border-right: 2px solid $gold;
      height: 5px;
      width: 25%;
    }
  }

  .level-indicator {
    background-color: $green;
    border: 2px solid $black;
    border-radius: 50%;
    height: 1.2rem;
    width: 1.2rem;
    margin-top: -1rem;
    position: relative;
    transition: all 0.5s ease-in-out;
    z-index: 2;

    &.beginner {
      margin-left: 24%;
    }

    &.intermediate {
      margin-left: 49%;
    }

    &.proficient {
      margin-left: 74%;
    }

    &.expert {
      margin-left: 94.5%;
    }
  }
}
</style>