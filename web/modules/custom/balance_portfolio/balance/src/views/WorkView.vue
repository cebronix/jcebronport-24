<template>
  <div class="work">
    <!-- Get these from a config page later -->
    <div class="flavor-text">
      <h1>My Work</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum interdum est id porttitor. Praesent pretium magna magna, non molestie nibh luctus commodo. Curabitur id ligula cursus ante suscipit finibus. Nunc nec dui vel mauris dictum vulputate ornare eu mauris. Etiam ornare ultrices sagittis. Aenean non nulla a mauris venenatis rhoncus. Nam eu finibus enim, et imperdiet nunc.
      </p>
    </div>
    <div v-for="category in categories" :key="category.id" class="work-category" :id=category>
      <div class="category-details">
        <h2>{{ renameCategories(category) }}</h2>
        <!-- Get these from a config page later -->
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum interdum est id porttitor. Praesent pretium magna magna, non molestie nibh luctus commodo. Curabitur id ligula cursus ante suscipit finibus.
        </p>
      </div>
      <div class="tiles">
        <div v-for="card in gameDeck" :key="card.pid" class="tile-wrapper">
          <WorkTile :card="card" class="tile" v-if="category == card.category[0].name"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import WorkTile from '@/components/WorkTile.vue'

const gameDeck = ref(window.drupalSettings.gameDeck)
const categories = ref([])

const getCategories = function() {
  gameDeck.value.forEach((card) => {
    if (!categories.value.includes(card.category[0].name)) {
      categories.value.push(card.category[0].name)
    }
  })
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

onMounted(() => {
  getCategories()
})

</script>

<style lang="scss">

.work {
  display: flex;
  flex-direction: column;
  font-family: 'Rubik', sans-serif;
  margin-top: 75px;

  h1 {
    color: $green;
    font-size: 3rem;
    font-weight: 500;
    margin: 0 auto 1rem;
    max-width: 85%;
    text-transform: uppercase;
  }

  h2 {
    color: $green;
    font-size: 2rem;
    font-weight: 400;
    margin: 1rem auto;
    max-width: 85%;
    text-transform: uppercase;
  }

  p {
    font-size: 1.2rem;
    font-weight: 100;
    margin: 0 auto 1rem;
    max-width: 85%;
  }
}

.work-category {
  display: flex;
  flex-wrap: wrap;
  position: relative;
}

.flavor-text,
.category-details {
  margin: 0 auto;
  max-width: 85%;
  padding: 2rem 0;
  text-align: center;
}

.category-details {
  width: 85%;

  h1,
  h2 {
    color: $green;
    font-family: 'Rubik', sans-serif;
    font-weight: 500;
    text-transform: uppercase;
  }
}

.tiles {
  display: flex;
  flex-wrap: wrap;
  justify-content: flex-start;
  width: 100%;
}

.tile-wrapper {
  display: flex;
  flex-basis: 100%;
  flex-direction: column;
  cursor: pointer;
  height: 400px;
  overflow: hidden;
  position: relative;

  @media screen and (min-width: 768px) {
    flex-basis: 50%;
  }

  &:empty {
    display: none;
  }

  &:hover {
    .tile-details {
      background: rgba(0, 0, 0, 0.9);
      top: 0;

      h4 {
        margin: 4px 0 1rem;
      }
    }
  }
}

</style>
