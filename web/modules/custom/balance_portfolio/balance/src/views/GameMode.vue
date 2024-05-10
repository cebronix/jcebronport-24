<template>
  <div class="playmat">
    <div class="row opponent-hand in-hand">
      <div v-for="card in gameDeck" :key="card.id" class="card-wrapper">
        <div class="card facedown"></div>
        <YinCard class="faceup" :card="card" />
      </div>
    </div>
    <div class="row">
      <div class="col draw-pile">
        <div class="card-slot">DRAW PILE</div>
        <div v-for="card in gameDeck" :key="card.id" class="stack card-wrapper">
          <div class="card facedown"></div>
          <YinCard :card="card" />
          <YangCard :card="card" />
        </div>
        <button>SHUFFLE</button>
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
        <button>NEW GAME</button>
      </div>
    </div>
    <div class="row player-hand in-hand">
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
  // console.log(gameDeck.value)
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
      align-items: center;
      color: rgba(255, 255, 255, 0.75);
      font-family: 'Oswald', sans-serif;
      font-weight: 600;
      justify-content: center;

      .card-slot {
        border: solid 5px #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.4rem;
      }

      .yin-card,
      .yang-card {
        display: none;
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

    .stack {
      position: absolute;
      rotate: unset;
      transform: translate(-15px, -38px);

      .card {
        z-index: unset;
      }

      &:nth-child(4) {
        .card {
          transform: translate(4px, 4px);
        }
      }
        
      &:nth-child(3) {
        .card {
          transform: translate(8px, 8px);
        }
      }

      &:nth-child(2) {
        .card {
          transform: translate(12px, 12px);
        }
      }
    }

    button {
      background-color: #2B90AE;
      border: 0;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
      margin: 1rem 0 0;
      padding: 0.5rem 1rem;

      &:hover {
        background-color: #2E4F72;
      }
    }
  }

  .in-hand {
    .card-wrapper {
      display: flex;
      transition: all 0.325s ease-in-out;
  
      &:first-of-type {
        margin-top: 40px;
        rotate: -10deg;
        transform: translateX(120px);
        z-index: 0;
      }
  
      &:nth-child(2) {
        margin-top: 0px;
        rotate: -5deg;
        transform: translateX(60px);
        z-index: 1;
      }
  
      &:nth-child(3) {
        margin-top: -20px;
        z-index: 2;
      }
  
      &:nth-child(4) {
        margin-top: 0px;
        rotate: 5deg;
        transform: translateX(-60px);
        z-index: 3;
      }
  
      &:last-of-type {
        margin-top: 40px;
        rotate: 10deg;
        transform: translateX(-120px);
        z-index: 4;
      }
    }
  }

  // Hands
  .opponent-hand {
    justify-content: center;
    margin-top: -120px;
    scale: -80%;

    .faceup {
      display: none;
    }
    
    .card-wrapper .card {
      width: 140px;
    }
  }

  .player-hand {
    justify-content: center;
    margin-top: 20px;
    position: relative;

    .card-wrapper {
      &:hover {
        cursor: pointer;
        margin-top: -140px;
        rotate: unset;
        scale: 110%;
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
