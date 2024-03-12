<script>

//Importo axios
import axios from 'axios';
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';

export default {
  components: {
    AppHeader,
    AppFooter,
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
    <router-view></router-view>
    <AppFooter />
  </div>

  <!-- Freccia che compare quando scrolli di 100px -->
  <div v-if="showScrollTop" @click="scrollToTop" class="scroll-top-arrow show">
    <i class="fa-solid fa-circle-up"></i>
  </div>
</template>

<style lang="scss">
@use './style/partials/variables' as *;

/* Stili per la freccia */
.scroll-top-arrow {
  position: fixed;
  bottom: 20px;
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
</style>
