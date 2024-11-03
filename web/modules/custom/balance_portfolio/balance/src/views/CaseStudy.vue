<template>
  <div class="case-study">
    <vue-particles
      id="tsparticles"
      :options="{
        background: {
          color: {
            value: 'transparent'
          }
        },
        particles: {
          color: {
            value: '#ffffff'
          },
          move: {
            direction: 'bottom',
            enable: true,
            outModes: 'out',
            speed: 2
          },
          number: {
            density: {
              enable: true,
              area: 800
            },
            value: 400
          },
          opacity: {
            value: 0.25
          },
          shape: {
            type: 'circle'
          },
          size: {
            value: { min: 1, max: 4 }
          },
          wobble: {
            enable: true,
            distance: 10,
            speed: 10
          },
          zIndex: {
            value: { min: 0, max: 100 }
          }
        },
      }"
    />
    <div
      class="hero"
      :style="{ 'background-image': 'url(/sites/default/files' + cardData.hero + ')' }"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <div class="hero-inner">
        <div class="hero-details">
          <h1>{{ cardData.title }}</h1>
          {{ cardData.subtitle }}
          {{ cardData.category[0].name }}
        </div>
      </div>
    </div>
    <div
      class="project-overview section-wrapper"
      data-aos="fade-up"
      data-aos-duration="650"
      >
      <h2>Project Overview</h2>
      <div class="row two-col__three-one">
        <div v-if="cardData.product" class="sub-wrapper product">
          <h3>The Product</h3>
          <div v-html="cardData.product"></div>
        </div>
        <div v-if="cardData.duration" class="sub-wrapper duration">
          <h3>Duration</h3>
          {{ cardData.duration }}
        </div>
      </div>
      <div class="row two-col__even">
        <div v-if="cardData.problem"
          class="sub-wrapper problem"
          data-aos="flip-up"
          data-aos-duration="350"
          data-aos-delay="300"
        >
          <h3>The Problem</h3>
          <div v-html="cardData.problem"></div>
        </div>
        <div v-if="cardData.goal"
          class="sub-wrapper goal"
          data-aos="flip-up"
          data-aos-duration="350"
          data-aos-delay="300"
        >
          <h3>The Goal</h3>
          <div v-html="cardData.goal"></div>
        </div>
      </div>
      <div class="row two-col__even">
        <div v-if="cardData.my_role"
          class="sub-wrapper role"
          data-aos="flip-up"
          data-aos-duration="350"
        >
          <h3>My Role</h3>
          <div>
            {{ cardData.my_role }}
          </div>
        </div>
        <div v-if="cardData.responsibilities"
          class="sub-wrapper responsibilities"
          data-aos="flip-down"
          data-aos-duration="350"
        >
          <h3>Responsibilities</h3>
          <div v-html="cardData.responsibilities"></div>
        </div>
      </div>
    </div>
    <div
      v-if="cardData.research_summary"
      class="user-research section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <h2>User Research</h2>
      <div v-if="cardData.research_summary"
        class="sub-wrapper research-summary"
        data-aos="flip-up"
        data-aos-duration="350"
        data-aos-delay="300"
      >
        <h3>Summary</h3>
        <div v-html="cardData.research_summary"></div>
      </div>
      <div v-if="cardData.pain_points"
        class="sub-wrapper pain-points"
        data-aos="flip-up"
        data-aos-duration="350"
      >
        <h3>Pain Points</h3>
        <div class="pain-points-wrapper">
          <div class="pain-point" v-for="(pain_point, index) in cardData.pain_points" :key="pain_point.id">
            <div class="count">{{ index + 1 }}</div>
            <h4>{{ pain_point.name }}</h4>
            <div v-html="pain_point.description"></div>
          </div>
        </div>
      </div>
      <div v-if="cardData.personas" 
        class="personas"
        data-aos="fade-up"
        data-aos-duration="350"
        data-aos-delay="300"
      >
        <div class="personas-wrapper sub-wrapper">
          <h3>Personas</h3>
          <div class="persona" v-for="persona in cardData.personas" :key="persona.id">
            <PersonaCard :persona="persona" />
          </div>
        </div>
      </div>
      <div v-if="cardData.journey_map_intro"
        class="sub-wrapper journey-map"
        data-aos="fade-up"
        data-aos-duration="350"
        data-aos-delay="300"
      >
        <div class="row two-col__one-three">
          <div class="jm-info stacked-col">
            <h3>Journey Map</h3>
            {{ cardData.journey_map_intro }}
            <a :href="'/sites/default/files' + cardData.journey_map_pdf" target="_blank">View PDF</a>
          </div>
          <div class="jm-image">
            <a :href="'/sites/default/files' + cardData.journey_map_pdf" target="_blank"><img :src="'/sites/default/files' + cardData.journey_map_preview" alt="Journey Map Preview"></a>
          </div>
        </div>
      </div>
    </div>
    <div v-if="cardData.wireframes_prototypes"
      class="designs section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <h2>Designs</h2>
      <div class="sub-wrapper
        wireframe"
        data-aos="fade-up"
        data-aos-duration="350"
        data-aos-delay="200"
        v-for="wireframe in cardData.wireframes_prototypes"
        :key="wireframe.id"
      >
        <WireframePrototype :wfpt="wireframe" v-if="wireframe.round == 'round_1'" />
      </div>
    </div>
    <div v-if="cardData.usability_study_findings[0]"
      class="useability section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <h2>Usability Study</h2>
      <div class="row two-col__even">
        <div v-html="cardData.usability_study_intro"></div>
        <div class="useability-findings">
          <h3>{{ fancyRound(cardData.usability_study_findings[0].round) }} Findings</h3>
          <div
            class="finding"
            data-aos="flip-up"
            data-aos-duration="350"
            v-for="(finding, index) in cardData.usability_study_findings[0].findings" 
            :key="finding.id"
          >
            <span class="inline-count">{{ index + 1 }}</span><p class="finding-desc">{{ finding }}</p>
          </div>
        </div>
      </div>
    </div>
    <div v-if="cardData.wireframes_prototypes.length >= 2"
      class="prototypes section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <h2>Refinements & Prototypes Round 1</h2>
      <div 
        class="prototype sub-wrapper"
        data-aos="fade-up"
        data-aos-duration="350"
        data-aos-delay="200"
        v-for="wireframe in cardData.wireframes_prototypes"
        :key="wireframe.id"
      >
        <WireframePrototype :wfpt="wireframe" v-if="wireframe.round == 'round_2'" />
      </div>
    </div>
    <div v-if="cardData.usability_study_findings[1]"
      class="section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <h2>Usability Study Round 2</h2>
      <div class="row two-col__even">
        <div v-html="cardData.usability_study_intro"></div>
        <div class="useability-findings">
          <h3>{{ fancyRound(cardData.usability_study_findings[1].round) }} Findings</h3>
          <div
            class="finding"
            data-aos="flip-up"
            data-aos-duration="350"
            v-for="(finding, index) in cardData.usability_study_findings[1].findings" 
            :key="finding.id"
          >
            <span class="inline-count">{{ index + 1 }}</span><p class="finding-desc">{{ finding }}</p>
          </div>
        </div>
      </div>
    </div>
    <div v-if="cardData.wireframes_prototypes.length >= 3"
      class="section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
    <h2>Refinements & Prototypes Round 2</h2>
      <div
        class="prototype"
        data-aos="fade-up"
        data-aos-duration="350"
        data-aos-delay="200"
        v-for="wireframe in cardData.wireframes_prototypes"
        :key="wireframe.id"
      >
        <WireframePrototype :wfpt="wireframe" v-if="wireframe.round == 'round_3'" />
      </div>
    </div>
    <div v-if="cardData.design_system_intro"
      class="section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <div
        class="row two-col__one-three"
        data-aos="fade-up"
        data-aos-duration="350"
        data-aos-delay="200"
      >
        <div class="stacked-col">
          <h3>Design System</h3>
          <div class="system-intro" v-html="cardData.design_system_intro"></div>
        </div>
        <div v-if="cardData.design_system_image" class="previews">
          <img :src="'/sites/default/files' + cardData.design_system_image" alt="Design System Image">
        </div>
      </div>
    </div>
    <div v-if="cardData.accessibility_intro"
      class="accessibility section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <h2>Accessibility</h2>
      <div class="acc-intro" v-html="cardData.accessibility_intro"></div>
      <div class="acc-wrapper">
        <div
          class="acc-consideration"
          data-aos="flip-up"
          data-aos-duration="350"
          data-aos-delay="300"
          v-for="(consideration, index) in cardData.acc_considerations"
          :key="consideration.id"
        >
          <div class="count">{{ index + 1 }}</div>
          <p class="consideration-desc">{{ consideration.consideration }}</p>
        </div>
      </div>
    </div>
    <div v-if="cardData.impact"
      class="takeaways section-wrapper"
      data-aos="fade-up"
      data-aos-duration="500"
    >
      <h2>Takeaways</h2>
      <div class="row two-col__even">
        <div
          class="sub-wrapper"
          data-aos="flip-up"
          data-aos-duration="350"
          data-aos-delay="300"
        >
          <h3>Impact</h3>
          <div class="impact" v-html="cardData.impact"></div>
        </div>
        <div
          class="sub-wrapper"
          data-aos="flip-up"
          data-aos-duration="350"
          data-aos-delay="300"
        >
          <h3>What I Learned</h3>
          <div class="lessons" v-html="cardData.what_i_learned"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="work-category more section-wrapper">
    <div class="category-details">
      <h2>More {{ renameCategories(cardData.category[0].name) }}</h2>
    </div>
    <div class="row">
      <div
        v-for="card in relatedCards"
        :key="card.pid"
        class="tile-wrapper sub-wrapper"
        data-aos="flip-up"
        data-aos-duration="350"
        data-aos-delay="150"
      >
        <WorkTile :card="card" class="tile" v-if="card.pid !== cardData.pid"/>
      </div>
    </div>
  </div>
</template>

<script setup>
import WireframePrototype from '@/components/WireframePrototype.vue';
import PersonaCard from '@/components/PersonaCard.vue';
import WorkTile from '@/components/WorkTile.vue';
import { defineProps, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
  pid: String
})

const caseStudied = () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  })

  document.querySelector('nav a[href="#/work"]').classList.add('router-link-active')
}


const renameCategories = function(category) {
  let fancyName = ''
  switch (category) {
    case 'Web':
      fancyName = 'Web Dev/Design'
      break
    case 'App':
      fancyName = 'Apps'
      break
    case 'Game':
      fancyName = 'Games'
      break
    case 'Scribbles':
      fancyName = 'Scribbles'
      break
    default:
      fancyName = 'Web Dev/Design'
      break
  }

  return fancyName
}

const fancyRound = function(round) {
  if (round) {
    round = round.charAt(0).toUpperCase() + round.slice(1)

    return round.replace('_', ' ')
  }
}

const cardData = ref(window.drupalSettings.gameDeck.find(card => card.pid === props.pid))

const relatedCards = ref(window.drupalSettings.gameDeck.filter(card => card.category[0].name === cardData.value.category[0].name))

onMounted(() => {
  caseStudied()
  // console.log(cardData.value)
})

onUnmounted(() => {
  document.querySelector('nav a[href="#/work"]').classList.remove('router-link-active')
})

</script>

<style lang="scss">

.case-study {
  font-family: $primary-font;
  line-height: 1.2;
  margin-top: 4rem;
  overflow: hidden;

  a {
    color: $green;

    &:hover {
      color: $gold;
    }
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    font-family: $secondary-font;
  }

  h2 {
    color: $gold;
  }

  h3 {
    font-size: 1.5rem;
    font-weight: 400;
    color: $green;
  }

  h4 {
    font-size: 1.25rem;
    font-weight: 400;
    text-transform: uppercase;
  }
}

ul {
  padding-inline-start: 1.5rem;
}

img {
  max-width: 100%;
}

.hero {
  border-radius: 0;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  margin: 0;
  min-height: 350px;
  max-width: 100%;
  padding: 1rem 2rem;
  position: relative;

  .hero-inner {
    display: flex;
    justify-content: flex-end;
    flex-direction: column;
    background: rgba(0,0,0,0.25);
    background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 70%);
    border-radius: 0;
    padding: 2rem;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;

    h1 {
      margin: 0.5rem 0;
    }
  }

  @media screen and (min-width: 768px) {
    border: solid 2px $green;
    border-radius: 12px;
    margin: 2rem auto 1.25rem;
    max-width: 85%;

    .hero-inner {
      border-radius: 12px;
      background: linear-gradient(0deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 55%);
    }
  }
}

.section-wrapper {
  display: flex;
  flex-direction: column;
  background-color: transparent;
  border: 0;
  border-radius: 12px;
  margin: 2rem auto 1.25rem;
  padding: 1rem;
  width: 90%;

  &.project-overview {
    margin-top: 0;
  }

  @media screen and (min-width: 768px) {
    background-color: $black;
    border: solid 2px $green;
    max-width: 85%;
    padding: 1rem 2rem;

    &.project-overview {
      margin-top: 2rem;
    }
  }

  .stacked-col {
    display: flex;
    flex-direction: column;

    a {
      margin-top: 1rem;
    }
  }
}

.sub-wrapper {
  background-color: $black;
  border: solid 1px $gold;
  border-radius: 10px;
  padding: 0 1rem 1rem;
  margin: 1rem 0;

  &:empty {
    display: none;
  }

  p {
    line-height: 1.4;
  }
}

.row {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: space-between;

  &.dir-col {
    flex-direction: column;
  }

  &.inline {
    align-items: flex-start;
    justify-content: flex-start;
    margin-bottom: 10px;

    h4 {
      margin: 0 8px 0 0;
    }

    .inline-col-2 {
      padding-top: 5px;
    }
  }

  &.two-col {
    &__even {
      > * {
        flex-basis: 44%;

        @media screen and (min-width: 1150px) {
          flex-basis: 45%;
        }

        @media screen and (min-width: 1350px) {
          flex-basis: 46%;
        }
      }
    }

    &__three-one {
      > * {
        flex-basis: 64%;

        &:last-child {
          flex-basis: 24%;

          @media screen and (min-width: 1150px) {
            flex-basis: 26%;
          }
        }
      }
    }

    &__one-three {
      > * {
        flex-basis: 28%;

        @media screen and (min-width: 1150px) {
          flex-basis: 30%;
        }

        &:last-child {
          flex-basis: 64%;
        }
      }
    }

    @media screen and (max-width: 768px) {
      &__even,
      &__three-one,
      &__one-three {
        > *,
        > *:last-child {
          flex: 1 1 100%;
        }
      }
    }
  }
}

.count,
.inline-count {
  background: $green;
  border: 2px solid $gold;
  border-radius: 50%;
  color: $black;
  font-size: 1.75rem;
  font-weight: 700;
  height: 45px;
  width: 45px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.count {
  margin: 0 auto;
}

.inline-count {
  flex: 0 1 auto;
  margin-right: 10px;
  max-width: 45px;
}

.pain-points-wrapper,
.acc-wrapper {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 2rem;
  text-align: center;

  .pain-point,
  .acc-consideration {
    flex: 1 1 50%;

    @media screen and (min-width: 768px) {
      flex: 1 1 20%;
    }
  }
}

.journey-map {
  padding: 1rem;

  .jm-info {
    display: flex;
    flex-direction: column;
  }

  .jm-image {
    overflow: hidden;

    img {
      opacity: 0.8;
      transition: all 0.5s ease-in-out;

      &:hover {
        opacity: 1;
        scale: 1.1;
      }
    }
  }
}

.finding {
  display: flex;
  align-items: flex-start;
  font-size: 1.2rem;
  margin-bottom: 1rem;

  .finding-desc {
    flex: 0 1 90%;
    margin-block-start: 0;
    margin-block-end: 0;
  }
}

.work-category {
  &.more {
    background: none;
    border: 0;
    overflow: hidden;
  }
}

</style>