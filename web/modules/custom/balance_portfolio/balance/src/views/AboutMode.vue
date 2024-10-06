<template>
  <div class="about-mode" ref="about_mode">
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
            value: 0.125
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
    <div class="flavor-text">
      <h1>50th Anniversary of my existence!</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum interdum est id porttitor. Praesent pretium magna magna, non molestie nibh luctus commodo. Curabitur id ligula cursus ante suscipit finibus. Nunc nec dui vel mauris dictum vulputate ornare eu mauris. Etiam ornare ultrices sagittis. Aenean non nulla a mauris venenatis rhoncus. Nam eu finibus enim, et imperdiet nunc.
      </p>
    </div>
    <div v-for="category in aboutDeck" :key="category.id" class="about-category">
      <h2>{{ betterCategory(category[0].category) }}</h2>
      <div
        class="section-wrapper"
        data-aos="fade-up"
        data-aos-duration="500"
      >
        <div class="row two-col__even">
          <AboutTile v-for="card in category" :key="card.id" :card="card" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import AboutTile from '@/components/AboutTile.vue'

const about_mode = ref(null)
let aboutDeck = ref(window.drupalSettings.aboutDeck)

let aboutDeckArray = Object.values(aboutDeck.value)
let lastCategory = aboutDeckArray.pop()
aboutDeckArray.unshift(lastCategory)

aboutDeck.value = aboutDeckArray


const betterCategory = function(category) {
  let betterCategory = ''
  switch (category) {
    case 'Work Experience':
      betterCategory = 'Where I\'ve Been'
      break
    case 'Education':
      betterCategory = 'How I\'ve Learned'
      break
    case 'Leveled Data':
      betterCategory = 'What I know'
      break
    case 'Plain Text':
      betterCategory = 'Who I Am'
      break
    default:
      betterCategory = category
      break
  }

  return betterCategory
}

onMounted(() => {
  // console.log(aboutDeck.value)
})

</script>

<style scoped lang="scss">
.about-mode {
  display: flex;
  flex-direction: column;
  font-family: $primary-font;
  margin-top: 125px;
  overflow: hidden;

  @media screen and (min-width: 768px) {
    margin-top: 80px;
  }

  h1 {
    color: $green;
    font-size: 3rem;
    font-weight: 500;
    margin: 0 auto 1rem;
    max-width: 85%;
    // text-transform: uppercase;
  }

  h2 {
    color: $white;
    font-size: 2rem;
    font-weight: 500;
    margin: 0 auto;
    max-width: 85%;
    // text-transform: uppercase;

    @media screen and (min-width: 768px) {
      margin: 1rem auto;
    }
  }

  p {
    font-size: 1.2rem;
    font-weight: 100;
    margin: 0 auto 1rem;
    max-width: 85%;
  }

  .section-wrapper {
    margin-top: 0;
  }
}

.about-category {
  display: flex;
  flex-direction: column;
  flex-wrap: wrap;
  margin: 0 0 4rem;
  position: relative;

  .tiles {
    margin-bottom: 4rem;
  }
}
</style>
