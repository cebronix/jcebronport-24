<template>
  <header>
    <router-link :to="{ name: 'splash' }" class="branding">J. Cebron Cook</router-link>
    <nav>
      <!-- <router-link :to="{ name: 'splash' }">Home</router-link> -->
      <router-link :to="{ name: 'about' }" @click="hideMenu">About</router-link>
      <router-link :to="{ name: 'portfolio' }" @click="hideMenu">Portfolio</router-link>
      <router-link :to="{ name: 'resume' }" @click="hideMenu">Resume</router-link>
      <router-link :to="{ name: 'contact' }" @click="hideMenu">Contact</router-link>
    </nav>
    <div class="menu-toggle" @click="toggleMenu"></div>
  </header>
  <router-view/>
</template>

<script setup>
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init();

const toggleMenu = () => {
  const nav = document.querySelector('nav');
  const menuToggle = document.querySelector('.menu-toggle');
  nav.classList.toggle('open');
  menuToggle.classList.toggle('open');
}

const hideMenu = () => {
  const nav = document.querySelector('nav');
  const menuToggle = document.querySelector('.menu-toggle');
  if (!nav.classList.contains('open') || !menuToggle.classList.contains('open')) return;
  nav.classList.remove('open');
  menuToggle.classList.remove('open');
}

</script>

<style scoped lang="scss">
  @import url('../../../../../themes/custom/balance/dist/css/global.css');
  header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: $black;
    margin: 0 auto;
    position: fixed;
    width: 100%;
    z-index: 1;

    .branding {
      color: $white;
      display: flex;
      font-family: 'Rubik', sans-serif;
      font-size: 2rem;
      gap: 1rem;
      margin-left: 1rem;
      text-decoration: none;

      @media screen and (min-width: 768px) {
        margin-left: 2rem;
      }

      &::before {
        content: '';
        display: block;
        height: 40px;
        width: 40px;
        background: url('./assets/logo-white.png') no-repeat center center;
        background-size: contain;
      }
    }
  }

  .menu-toggle {
    content: url('./assets/hamburger.svg');
    cursor: pointer;
    display: block;
    padding: 1rem;
    width: 35px;
    transition: scale 0.2s ease-in-out;

    &:hover {
      scale: 1.1;
    }

    &.open {
      content: url('./assets/close.svg');
    }

    @media (min-width: 768px) {
      display: none;
    }
  }

  nav {
    display: flex;
    align-items: center;
    justify-content: space-around;
    gap: 1.5rem;
    background: $black;
    height: 60px;
    max-width: unset;
    opacity: 0;
    pointer-events: none;
    position: absolute;
    top: 5px;
    transition: top 0.5s ease-in-out, opacity 0.5s ease-in-out;
    width: 100%;

    &.open {
      opacity: 1;
      pointer-events: all;
      top: 60px;
    }

    @media screen and (min-width: 768px) {
      display: flex;
      justify-content: flex-end;
      margin-right: 2rem;
      max-width: 1600px;
      opacity: 1;
      pointer-events: all;
      position: relative;
      top: unset;
      width: unset;
    }

    a {
      color: $white;
      font-family: "Oswald", sans-serif;
      font-weight: 400;
      letter-spacing: 0.075rem;
      text-decoration: none;
      text-transform: uppercase;

      &:hover,
      &.router-link-active {
        color: $green;
      }
    }
  }
</style>

<style lang="scss">
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

  .portfolio {
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow-x: hidden;
  }
</style>
