<template>
  <header>
    <router-link :to="{ name: 'splash' }" class="branding">J. Cebron Cook</router-link>
    <nav>
      <!-- <router-link :to="{ name: 'splash' }">Home</router-link> -->
      <router-link :to="{ name: 'about' }">About</router-link>
      <router-link :to="{ name: 'portfolio' }">Portfolio</router-link>
      <router-link :to="{ name: 'resume' }">Resume</router-link>
      <router-link :to="{ name: 'contact' }">Contact</router-link>
    </nav>
  </header>
  <router-view/>
</template>

<script setup>
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init();

</script>

<style scoped lang="scss">
  @import url('../../../../../themes/custom/balance/dist/css/global.css');
  header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #000;
    margin: 0 auto;
    position: fixed;
    width: 100%;
    z-index: 1;

    .branding {
      color: white;
      display: flex;
      font-family: 'Rubik', sans-serif;
      font-size: 2rem;
      gap: 1rem;
      margin-left: 2rem;
      text-decoration: none;

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

  nav {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    height: 60px;
    margin-right: 2rem;
    max-width: 1600px;

    a {
      color: #fff;
      font-family: "Oswald", sans-serif;
      font-weight: 400;
      letter-spacing: 0.075rem;
      text-decoration: none;
      text-transform: uppercase;

      &:hover,
      &.router-link-active {
        color: #92B865;
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

  // $blue: #2E4F72;
  // $lt-blue: #2B90AE;
  // $green: #92B865;
  // $dk-grey: #393836;
  // $lt-grey: #504F4B;
</style>
