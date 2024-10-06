<template>
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
  <div class="contact">
    <h1>Contact</h1>
    <div class="section-wrapper">
      <div class="row social">
        <a href="https://www.linkedin.com/in/jcebroncook" target="_blank" class="icon linkedin"></a>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum interdum est id porttitor. Praesent pretium magna magna, non molestie nibh luctus commodo. Curabitur id ligula cursus ante suscipit finibus.</p>
        <a href="https://bsky.app/profile/cebronix.bsky.social" target="_blank" class="icon bluesky"></a>
      </div>
      <div class="row">
        <div class="sub-wrapper agency">
          <a href="https://viagiotech.com" target="_blank" class="agency-logo"></a>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum interdum est id porttitor. Praesent pretium magna magna, non molestie nibh luctus commodo. Curabitur id ligula cursus ante suscipit finibus.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>

</script>

<style lang="scss">
.contact {
  display: flex;
  flex-direction: column;
  color: white;
  font-family: $primary-font;
  margin: 6rem 1rem 4rem;
  text-align: center;

  @media screen and (min-width: 768px) {
    margin: 4rem 2rem 4rem;
  }

  h1 {
    color: $green;
    font-size: 2.5rem;
    font-weight: 500;
    text-transform: uppercase;
  }

  .social {
    display: flex;
    align-items: center;
    flex-direction: column;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1rem;
    padding: 1rem 0;

    @media screen and (min-width: 768px) {
      flex-direction: row;
      gap: unset;
    }

    .icon {
      background-size: contain;
      content: '';
      display: block;
      height: 120px;
      width: 120px;
    }

    p {
      flex-basis: 100%;

      @media screen and (min-width: 768px) {
        flex-basis: 60%;
      }
    }

    .bluesky {
      background: url('../assets/bluesky.svg') no-repeat center center;
    }

    .linkedin {
      background: url('../assets/linkedin.svg') no-repeat center center;
    }
  }

  .agency {
    display: flex;
    align-items: center;
    flex-direction: column;
    gap: 1rem;
    padding: 1rem 2rem;

    @media screen and (min-width: 768px) {
      flex-direction: row;
      gap: 2rem;
      
    }

    .agency-logo {
      background: url('../assets/viagiotech-logo.png') no-repeat center center;
      background-size: contain;
      content: '';
      height: 70px;
      width: 200px;

      @media screen and (min-width: 768px) {
        height: 100%;
        width: 100%;
      }
    }
  }
}
</style>