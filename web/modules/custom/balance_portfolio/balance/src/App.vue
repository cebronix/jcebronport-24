<template>
  <header>
    <div class="branding">J. Cebron Cook</div>
    <nav>
      <router-link :to="{ name: 'splash' }">Home</router-link>
      <router-link :to="{ name: 'about' }">About</router-link>
      <router-link :to="{ name: 'portfolio' }">Portfolio</router-link>
      <!-- <router-link :to="{}">Resume</router-link> -->
      <router-link :to="{ name: 'contact' }">Contact</router-link>
    </nav>
  </header>
  <router-view/>
</template>

<style scoped lang="scss">
  header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #000;
    margin: 0 auto;
    position: relative;
    z-index: 1;

    .branding {
      color: white;
      display: flex;
      font-family: 'Rubik', sans-serif;
      font-size: 2rem;
      gap: 1rem;
      margin-left: 2rem;

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
      text-decoration: none;
      text-transform: uppercase;

      &:hover {
        color: #92B865;
      }
    }
  }
</style>

<style lang="scss">
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');

  .portfolio {
    background: rgb(57,56,54);
    background: linear-gradient(0deg, rgba(57,56,54,1) 0%, rgba(0,0,0,1) 36%, rgba(0,0,0,1) 64%, rgba(57,56,54,1) 100%);
    color: #fff;
    height: 100vh;
    overflow: hidden;
  }

  // $blue: #2E4F72;
  // $lt-blue: #2B90AE;
  // $green: #92B865;
  // $dk-grey: #393836;
  // $lt-grey: #504F4B;
</style>
