<template>
  <div class="playmat">
    <div class="row controls-top">
      <div class="left">???</div>
      <div class="right">MODE</div>
    </div>
    <div class="row opponent-hand in-hand">
      <div v-for="card in opponentHand" :key="card.id" class="card-wrapper">
        <div class="card facedown"></div>
        <YinCard class="faceup" :card="card" />
      </div>
    </div>
    <div class="row">
      <div class="col draw-pile">
        <div class="card-slot">DRAW PILE</div>
        <div v-for="card in gameDeck" :key="card.id" class="stack card-wrapper">
          <div class="card facedown opp"></div>
          <div class="card facedown player"></div>
          <YinCard :card="card" />
          <YangCard :card="card" />
        </div>
        <button v-on:click="dealCards()" :disabled="dealt">DEAL</button>
      </div>
      <div class="col play-slots">
        <div class="row opponent-slots">
          <div class="card-slot opponent-slot-1"></div>
          <div class="card-slot opponent-slot-2"></div>
          <div class="card-slot opponent-slot-3"></div>
        </div>
        <div class="row player-slots">
          <div class="card-slot player-slot-1">
            <div class="slot-select"></div>
          </div>
          <div class="card-slot player-slot-2">
            <div class="slot-select"></div>
          </div>
          <div class="card-slot player-slot-3">
            <div class="slot-select"></div>
          </div>
        </div>
      </div>
      <div class="starburst"></div>
      <div class="fail"></div>
      <div class="col discard-pile">
        <div class="card-slot">DISCARD</div>
        <div v-for="card in discardPile" :key="card.id" class="stack card-wrapper">
          <div class="card facedown"></div>
        </div>
        <button v-on:click="newGame()" :disabled="!dealt">NEW GAME</button>
      </div>
    </div>
    <div class="row controls-bottom">
      <div class="left">HELP</div>
      <div class="right">
        <div class="modifier">- {{ modifier }}</div>
        <div class="health">{{ health }}</div>
      </div>
    </div>
    <div class="row player-hand in-hand">
      <div
        v-for="card in playerHand"
        :key="card.id"
        class="card-wrapper"
        @click="makeSlotsSelectable($event)">
        <YangCard :card="card" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import YinCard from '@/components/YinCard'
import YangCard from '@/components/YangCard'

let gameDeck = ref(window.drupalSettings.gameDeck)
let playerHand = ref([])
let opponentHand = ref([])
let dealt = ref(false)
let discardPile = ref([])
let cardSelected = ref(false)
let health = ref(1000)
let modifier = ref(0)

const dealCards = () => {
  if (dealt.value) return

  let i = playerHand.value.length
  let deck = document.querySelectorAll('.stack')
  const r_deck = Array.from(deck).reverse()
  animateDeal(i, r_deck)
  setTimeout(() => {
    opponentStarts()
  }, 5000)

  dealt = true
}

const newGame = () => {
  gameDeck.value = window.drupalSettings.gameDeck
  playerHand.value = []
  opponentHand.value = []
  dealt = false
  location.reload()
}

const animateDeal = (i, deck) => {
  if (deck.length === 0) return
  
  let stop = 5
  let animatedUp = deck[0].querySelector('.player')
  let animatedDown = deck[0].querySelector('.opp')
  animatedDown.classList.add('deal-down')
  const card = gameDeck.value[gameDeck.value.length - 1]

  animatedDown.addEventListener('animationend', () => {
    if (i !== stop) {
      animatedUp.classList.add('deal-up')
      playerHand.value.push(card)
    }
  })
  
  animatedUp.addEventListener('animationend', () => {
    if (i !== stop) {
      gameDeck.value.pop()
      opponentHand.value.push(card)
      animateDeal(i+1, deck.slice(1))
    }
  })
}

const opponentStarts = () => {
  // Play a random card from the opponents hand to an opponent slot.
  let randomCard = Math.floor(Math.random() * opponentHand.value.length)
  let randomSlot = Math.floor(Math.random() * 3) + 1
  let opponentCard = document.querySelector(`.opponent-hand .card-wrapper:nth-child(${randomCard}) .yin-card`)
  let slot = document.querySelector(`.opponent-slot-${randomSlot}`)
  // move the card object to the slot
  slot.appendChild(opponentCard).classList.add('in-play')
  opponentHand.value.splice(randomCard, 1)

}

const makeSlotsSelectable = (e) => {
  cardSelected.value = !cardSelected.value
  const card = e.currentTarget
  const slots = document.querySelectorAll('.slot-select')
  if (cardSelected.value) {
    card.classList.add('stickit')
    slots.forEach((slot) => {
      slot.classList.add('selectable')
      slot.addEventListener('click', function selectable() {
        let slotValue = slot.parentElement.classList[1].split('-')[2]
        playCard(card, slotValue)
      })
    })
  } else {
    card.classList.remove('stickit')
    slots.forEach(slot => slot.classList.remove('selectable'))
  }
}

const playCard = (card, slot) => {
  let playerSlot = document.querySelector(`.player-slot-${slot}`)
  const slots = document.querySelectorAll('.slot-select')
  slots.forEach(slot => slot.classList.remove('selectable'))
  card.classList.remove('stickit')
  playerSlot.appendChild(card).classList.add('in-play')

  const oppCard = document.querySelector('.opponent-slots').querySelector('.in-play')
  const oppSlot = oppCard.parentElement.classList[1].split('-')[2]
  const playerPid = parseInt(card.querySelector('.pid').innerText)
  const oppPid = parseInt(oppCard.querySelector('.pid').innerText)

  if (oppSlot === slot && oppPid === playerPid) {
    battle(card.querySelector('.card').querySelector('.type').innerText, oppCard.querySelector('.type').innerText)
  } else {
    fail(card, playerSlot)
  }
}

const battle = (cardType, oppCardType) => {
  const starburst = document.querySelector('.starburst')
  starburst.classList.add('reaction')

  starburst.addEventListener('animationend', () => {
    starburst.classList.remove('reaction')
    battleAnimation(cardType, oppCardType)
  })
}

const fail = (card, playerSlot) => {
  const fail = document.querySelector('.fail')
  fail.classList.add('reaction')
  const value = parseInt(card.querySelector('.value').innerText)

  fail.addEventListener('animationend', () => {
    fail.classList.remove('reaction')
    playerSlot.removeChild(card)
    const playerHand = document.querySelector('.player-hand')
    card.classList.remove('in-play')
    playerHand.appendChild(card)
    loseHealth(value)
  })
}

const loseHealth = (value) => {
  const modifierWrapper = document.querySelector('.modifier')
  modifierWrapper.classList.add('active')
  modifier.value = value
  health.value -= value
  setTimeout(() => {
    modifierWrapper.classList.remove('active')
  }, 1500)
}

const battleAnimation = (cardType, oppCardType) => {
  // Run animation based on card type and oppCardType
  console.log(cardType, oppCardType)
  // Discard both cards
  // battle.addEventListener('animationend', () => {
    discardBoth()
  // })
}

const discardBoth = () => {
  const playerSlot = document.querySelector('.player-slots').querySelector('.in-play')
  const oppSlot = document.querySelector('.opponent-slots').querySelector('.in-play')
  const discardSlot = document.querySelector('.discard-pile')
  console.log(playerSlot, oppSlot, discardSlot)
  discardPile.value.push(playerSlot)
  discardPile.value.push(oppSlot)

  setTimeout(() => {
    openCaseStudy()
  }, 1000)

  // Remove cards from play
  playerSlot.remove()
  oppSlot.remove()

}

const openCaseStudy = () => {
  // Open Case Study Modal/Component
  console.log('Open Case Study')
}

onMounted(() => {
  // newGame()
})

onUnmounted(() => {
  newGame()
})

</script>

<style lang="scss">
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

    .controls {
      &-top {
        justify-content: space-between;
        padding: 1rem 2rem 0;
        position: absolute;
        width: 94%;
      }

      &-bottom {
        justify-content: space-between;
        padding: 0 2rem 1rem;
        position: absolute;
        bottom: 0;
        width: 94%;

        .right {
          text-align: center;
        }
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
        border: solid 5px $lt-grey;
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

      .slot-select {
        content: url(../assets/arrow-in-down.svg);
        display: none;
        height: 50px;
        width: 50px;
        margin: 1rem auto;
        opacity: 0.325;
        transition: color 0.325s ease-in-out;

        &.selectable {
          display: block;
        }

        &:hover {
          cursor: pointer;
          opacity: 1;
        }
      }

      .card-wrapper.in-play {
        position: relative;
        top: -20px;
        left: -10px;
        scale: 82%;

        .card {
          height: 240px;
        }
      }
    }

    .card-slot {
      border: solid 5px $lt-grey;
      border-right: 0;
      height: 225px;
      width: 150px;

      &:last-of-type {
        border-right: solid 5px $lt-grey;
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
      background-color: $lt-blue;
      border: 0;
      border-radius: 5px;
      color: $white;
      cursor: pointer;
      margin: 1rem 0 0;
      padding: 0.5rem 1.5rem;

      &:hover {
        background-color: $blue;
      }

      &:disabled {
        background-color: $lt-grey;
        cursor: not-allowed;
      }
    }

    .modifier {
      color: $deep-red;
      font-size: 2.5rem;
      font-weight: 700;
      opacity: 0;
      transition: all 0.325s ease-in-out;
      position: absolute;
      bottom: 0;
      right: 2%;

      &.active {
        bottom: 50px;
        opacity: 1;
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
        transform: translateX(160px);
        z-index: 0;
      }
  
      &:nth-child(2) {
        margin-top: 0px;
        rotate: -5deg;
        transform: translateX(80px);
        z-index: 1;
      }
  
      &:nth-child(3) {
        margin-top: -20px;
        z-index: 2;
      }
  
      &:nth-child(4) {
        margin-top: 0px;
        rotate: 5deg;
        transform: translateX(-80px);
        z-index: 3;
      }
  
      &:last-of-type {
        margin-top: 40px;
        rotate: 10deg;
        transform: translateX(-160px);
        z-index: 4;
      }
    }
  }

  // Hands
  .opponent-hand {
    justify-content: center;
    margin-top: -120px;
    min-height: 265px;
    scale: -80%;

    .faceup {
      display: none;
    }
    
    .card-wrapper .card {
      width: 150px;
    }
  }

  .player-hand {
    justify-content: center;
    margin-top: 20px;
    position: relative;
    transition-delay: 4s;

    .card-wrapper {
      &:hover,
      &.stickit {
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
    background-color: $white;
    border-radius: 8px;
    box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.5);
    width: 150px;
    height: 225px;

    &.in-play {
      display: block;
      height: 108%;
      scale: 82%;
      transition: scale 0.325s ease-in-out;
      position: relative;
      top: -22px;
      left: -12px;
      
      &:hover {
        scale: 120%;
      }
    }

    &.facedown {
      background: url('../assets/card-back.jpg') no-repeat center center;
      background-size: contain;

      &.opp {
        position: absolute;
        top: 0;
      }
    }

    &.deal-up {
      animation: dealup 350ms ease-in-out;
    }

    &.deal-down {
      animation: dealdown 350ms ease-in-out;
    }
  }

  .starburst {
    background: url('../assets/starburst.svg') no-repeat center center;
    height: 850px;
    width: 850px;
    top: 8%;
    left: 18%;
  }

  .fail {
    background: url('../assets/fail.svg') no-repeat center center;
    height: 750px;
    width: 750px;
    top: 12%;
    left: 18%;
  }

  .fail,
  .starburst {
    background-size: contain;
    position: absolute;
    opacity: 0;
    transition: all 0.325s ease-in-out;
    z-index: -1;

    &.reaction {
      animation: reaction 500ms ease-in-out;
      opacity: 1;
      z-index: 10;
    }
  }

  // All these numbers will need computed values.
  @keyframes dealup {
    0% {
      transform: translate(0, 0) rotate(0deg);
    }
    100% {
      transform: translate(450px, -390px) rotate(180deg);
    }
  }

  @keyframes dealdown {
    0% {
      transform: translate(0, 0) rotate(0deg);
    }
    100% {
      transform: translate(450px, 390px) rotate(180deg);
    }
  }

  @keyframes reaction {
    0% {
      transform: scale(0);
    }
    100% {
      transform: scale(1);
    }
  }

</style>
