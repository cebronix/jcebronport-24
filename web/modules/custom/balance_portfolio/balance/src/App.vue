<template>
  <header>
    <router-link :to="{ name: 'splash' }" class="branding" @click="scrollToTop"><span>J. Cebron Cook</span></router-link>
    <nav>
      <router-link :to="{ name: 'about' }" @click="scrollToTop">About</router-link>
      <router-link :to="{ name: 'work' }" @click="scrollToTop">Work</router-link>
      <a href="#" target="_blank">Resume</a>
      <!-- <router-link :to="{ name: 'resume' }" @click="scrollToTop">Resume</router-link> -->
      <router-link :to="{ name: 'contact' }" @click="scrollToTop">Contact</router-link>
    </nav>
  </header>
  <router-view/>
</template>

<script setup>
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init();

const scrollToTop = () => {
  window.scrollTo(0, 0);
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
    padding: 1rem 0;
    position: fixed;
    width: 100%;
    z-index: 1;

    @media screen and (min-width: 768px) {
      padding: 0;
    }

    .branding {
      color: $white;
      display: flex;
      font-family: $primary-font;
      font-size: 2rem;
      gap: 1rem;
      margin-left: 1rem;
      text-decoration: none;

      @media screen and (min-width: 768px) {
        margin-left: 2rem;

        span {
          display: block;
        }
      }

      &::before {
        content: '';
        display: block;
        height: 40px;
        width: 40px;
        background: url('./assets/CBX4b100.png') no-repeat center center;
        background-size: contain;
      }
    }
  }

  nav {
    display: flex;
    align-items: center;
    justify-content: space-around;
    gap: unset;
    background: $black;
    height: 60px;
    max-width: unset;
    position: absolute;
    top: 60px;
    width: 100%;

    @media screen and (min-width: 768px) {
      display: flex;
      gap: 1.5rem;
      justify-content: flex-end;
      margin-right: 2rem;
      max-width: 1600px;
      position: relative;
      top: unset;
      width: unset;
    }

    a {
      color: $white;
      font-family: $secondary-font;
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
  .portfolio {
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow-x: hidden;
  }

  li {
    line-height: 1.2;
    margin-bottom: 1rem;
  }
</style>
