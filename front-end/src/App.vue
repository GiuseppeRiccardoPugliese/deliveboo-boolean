<script>

//Importo axios
import axios from 'axios';
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';
import Home from './components/Home.vue';
import Carousel from './components/Carousel.vue';
import Restaurants from './components/Restaurants.vue';


export default {
  components: {
    AppHeader,
    AppFooter,
    Home,
    Carousel,
    Restaurants,
  },
  data() {
    return {
      showScrollTop: false,
    }
  },
  methods: {
    checkScroll() {
      // Se la pagina e' stata scrollata di 100px allora:
      this.showScrollTop = window.scrollY > 100;
      //Log "true" di showScrollTop
    },
    scrollToTop() {
      // Funzione per far scrollare la pagina verso l'alto
      window.scrollTo({
        top: 0,
        behavior: 'smooth', //Scrolla top lentamente 'smooth' invece di essere istantaneo
      });
    },
  },
  mounted() {
    // Aggiungi un ascoltatore di eventi per controllare lo scrolling
    window.addEventListener('scroll', this.checkScroll);
  },
  beforeDestroy() {
    // Memory leaks
    window.removeEventListener('scroll', this.checkScroll);
  },
}

</script>

<template>
  <div>
    <AppHeader />
    <div class="main-content">
      <Home />
        <div class="router-container">
          <router-view v-slot="{ Component }">
            <transition 
            enter-active-class="animate__animated animate__fadeInUp"
            leave-active-class="animate__animated animate__fadeOut animate__faster	500ms"
            mode="out-in"
            >
              <component :is="Component"/>
            </transition>
          </router-view>
        </div>
        <AppFooter />
    </div>
  </div>

  <!-- Freccia che compare quando scrolli di 100px -->
  <div v-if="showScrollTop" @click="scrollToTop" class="scroll-top-arrow show">
    <i class="fa-solid fa-circle-up"></i>
  </div>
</template>

<style lang="scss">
@use './style/style.scss' as *;
@use './style/partials/variables' as *;

/* Stili per la freccia */
.scroll-top-arrow {
  position: fixed;
  bottom: 100px;
  right: 20px;
  font-size: 30px;
  cursor: pointer;
  display: none;
  transition: opacity 0.3s ease;
}

/* Stili per la freccia quando visibile */
.scroll-top-arrow.show {
  display: block;
  opacity: 1;
  padding: 0px 12px;
  background-color: $btn_color;
  border-radius: 5px;
  z-index: 1000;
}

.router-container {
  // min-height: 600px;
  min-height: calc(100vh - 120px - 500px);

  // flex-grow: 1;
}

.slideIn-enter-from,
.slideIn-leave-to {
  opacity: 0;
  // transform: translateY(20%);
}

.slideIn-enter-active,
.slideIn-leave-active {
  transition: opacity 5s ease-out;
  // transition: opacity 0.5s ease, transform 5s ease-in-out;
}
</style>
