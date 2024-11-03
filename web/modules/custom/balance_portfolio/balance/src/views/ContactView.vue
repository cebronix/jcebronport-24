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
        <p>I'm not much for social media but you can find me on LinkedIn and my new personal favorite, BlueSky.<br>
          <!-- <br>One for professional contacts, one not so much. Dev on one side, art on the other? Contact me on whichever is more appropriate for the topic. -->
        </p>
        <a href="https://bsky.app/profile/cebronix.bsky.social" target="_blank" class="icon bluesky"></a>
      </div>
      <div class="row">
        <div class="sub-wrapper agency">
          <a href="https://viagiotech.com" target="_blank" class="agency-logo"></a>
          <p>My development services are tied to my employer Viagio Technologies. If you're looking for a team of developers for a custom software or web project, we're your team. Hit up the site for proper channels. If it's not development related, hit me up on BlueSky.<br>
            <!-- <br>If you're looking for a designer or have illustration/cartoon/book cover projects, I'm your guy. I mean, I would be if I had actual time for freelance work. I'm always open to a conversation, but guarantee nothing. -->
          </p>
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
  font-size: 1.2rem;
  line-height: 1.2;
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
      transition: scale 0.3s;

      &:hover {
        scale: 1.1;
      }
    }

    .linkedin {
      background: url('../assets/linkedin.svg') no-repeat center center;
      transition: scale 0.3s;

      &:hover {
        scale: 1.1;
      }
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
      background: url('../assets/ViagioTech.svg') no-repeat center center;
      background-size: contain;
      content: '';
      height: 70px;
      width: 200px;
      transition: scale 0.3s;

      @media screen and (min-width: 768px) {
        height: 100%;
        width: 100%;
      }

      &:hover {
        scale: 1.05;
      }
    }
  }
}
</style>