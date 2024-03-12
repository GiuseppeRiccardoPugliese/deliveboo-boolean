<script>
export default {
  name: 'Restaurants',
  data() {
    return {
      // Array per memorizzare i dati dei ristoranti
      ristoranti: [],
    };
  },

  mounted() {
    // Chiamata per recuperare i dati dei ristoranti
    this.fetchData(); 
    
  },
  
  methods: {

    fetchData() {
      // Simulazione della chiamata API
      fetch('/server.json')
        .then(response => response.json())
        .then(data => {
          // Imposta i dati dei ristoranti ottenuti dalla chiamata API
          this.ristoranti = data;
        })
        .catch(error => {
          console.error('Si è verificato un errore:', error);
        });
    },

    goBack() {
      // Funzione per tornare alla pagina precedente
      this.$router.go(-1);
    },
    
  }
};
</script>

<template>
  <section>
    <div class="my-container">

      <div class="arrow-container">
        <span class="back-arrow">
          <!-- Evento click per tornare indietro -->
          <i @click="goBack" class="fa-solid fa-circle-left"></i>
        </span>
        <span class="restaurants-zone">
          <strong>Ristoranti a Milano</strong>
        </span>
      </div>

      <div class="my-card-container">
        <!-- Utilizza v-for per iterare sui ristoranti e mostrare i dati -->
        <div class="my-card" v-for="(ristorante, index) in ristoranti" :key="index">

          <router-link :to="{ name: 'Details' }" class="router-link">
            <div class="restaurant-image" :style="{ backgroundImage: 'url(' + ristorante.immagine + ')' }"></div>
            <h6>{{ ristorante.nome }}</h6>
            <p v-if="ristorante.aperto" class="open-status">Aperto</p>
            <p v-else class="closed-status">Chiuso</p>
          </router-link>

        </div>        
      </div>

    </div>
  </section>
</template>


<style scoped lang="scss">
  @import '../style/restaurants.scss';
</style>
