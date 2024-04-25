<template>
  <div class="playmat">
    <div class="row opponent-hand">
      <div v-for="card in gameDeck" :key="card.id" class="card-wrapper">
        <div class="card facedown"></div>
        <YinCard class="faceup" :card="card" />
      </div>
    </div>
    <div class="row">
      <div class="col draw-pile">
        <div class="card-slot">DRAW PILE</div>
        <button>NEW GAME</button>
      </div>
      <div class="col play-slots">
        <div class="row opponent-slots">
          <div class="card-slot opponent-slot-1"></div>
          <div class="card-slot opponent-slot-2"></div>
          <div class="card-slot opponent-slot-3"></div>
        </div>
        <div class="row player-slots">
          <div class="card-slot player-slot-1"></div>
          <div class="card-slot player-slot-2"></div>
          <div class="card-slot player-slot-3"></div>
        </div>
      </div>
      <div class="col discard-pile">
        <div class="card-slot">DISCARD</div>
        <button>SHUFFLE</button>
      </div>
    </div>
    <div class="row player-hand">
      <div v-for="card in gameDeck" :key="card.id"  class="card-wrapper">
        <YangCard :card="card" />
      </div>
    </div>
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
  .playmat {
    display: flex;
    flex-wrap: wrap;

    .row {
      display: flex;
      flex-basis: 100%;

      &.player {
        margin-top: -13px;
      }
    }

    .col {
      display: flex;
      flex-direction: column;
      flex-basis: 33.33%;
    }

    .play-slots {
      display: flex;
    }

    .opponent-slots {
      margin-top: 2rem;

      .card-slot {
        border-bottom: 0;
      }
    }

    .draw-pile,
    .discard-pile {
      justify-content: center;
      align-items: center;
      color: rgba(255, 255, 255, 0.75);

      .card-slot {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.4rem;
      }
    }

    .player-slots {
      margin: 0 0 2rem 0;
    }

    .card-slot {
      border: solid 5px #fff;
      border-right: 0;
      height: 225px;
      width: 150px;
      opacity: 0.4;

      &:last-of-type {
        border-right: solid 5px #fff;
      }
    }

    button {
      margin: 1rem 0 0;
    }
  }

  // Hands
  .opponent-hand {
    justify-content: center;
    margin-top: -60px;
    scale: -80%;

    .faceup {
      display: none;
    }
  }

  .player-hand {
    justify-content: center;
    margin-bottom: -20px;
    position: relative;

    .card-wrapper {
      &:hover {
        cursor: pointer;
        margin-top: -160px;
        rotate: unset;
        scale: 115%;
        z-index: 5;
      }

      .card {
        display: flex;
        flex-wrap: wrap;
        width: 200px;
        height: 305px;
      }
    }
  }

  .card-wrapper {
    display: flex;
    transition: scale 0.4s ease-in-out;

    &:first-of-type {
      rotate: -10deg;
    }

    &:last-of-type {
      rotate: 10deg;
    }
  }

  .card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.5);
    width: 150px;
    height: 225px;

    &.facedown {
      background: url('../assets/card-back.jpg') no-repeat center center;
      background-size: contain;
    }
  }
</style>
