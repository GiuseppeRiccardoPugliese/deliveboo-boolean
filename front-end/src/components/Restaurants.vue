<script>
import axios from "axios";

export default {
  name: "Restaurants",
  data() {
    return {
      ristoranti: [], // Array per memorizzare i dati dei ristoranti
      tipologie: [],
    };
  },
  mounted() {
    // Effettua la prima chiamata per ottenere i ristoranti dalla prima API
    axios
      .get("http://localhost:8000/api/v1/deliveboo")
      .then((response) => {
        this.ristoranti = response.data;
        // Una volta ricevuti i dati dalla prima API, effettua la seconda chiamata
        this.fetchSecondApiData();
      })
      .catch((error) => {
        console.error("Error fetching data from first API:", error);
      });
  },
  methods: {
    fetchSecondApiData() {
      // Effettua la seconda chiamata per ottenere i ristoranti dalla seconda API
      axios
        .get("http://localhost:5174/server.json")
        .then((response) => {
          // Aggiungi i ristoranti dalla seconda API alla lista esistente
          this.ristoranti = [...this.ristoranti, ...response.data];
        })
        .catch((error) => {
          console.error("Error fetching data from second API:", error);
        });
    },
    goBack() {
      // Funzione per tornare alla pagina precedente
      this.$router.go(-1);
    },
  },
};
</script>

<template>
    <section>

        <div class="tipology">
            <div class="tipo-card" v-for="(tipologia, index) in tipologie" :key="index">
                <div class="tipo-img">
                    <img :src="tipologia.image" alt="">
                </div>
                <span> {{ tipologia.name }} </span>
            </div>
        </div>

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
                    <router-link :to="{ name: 'Details', params: { index: index } }" class="router-link">
                        <div class="restaurant-image"
                            :style="{ 'background-image': ristorante.image.includes('images/') && ristorante.image.includes('images/') !== null ? 'url(' + getImageUrl(ristorante) + ')' : ' url(' + ristorante.image + ')' }">
                        </div>
                        <h6>{{ ristorante.name }}</h6>
                        <p v-if="ristorante.visible" class="open-status">
                            Aperto
                        </p>
                        <p v-else class="closed-status">Chiuso</p>
                    </router-link>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped lang="scss">
@import "../style/restaurants.scss";

.back-arrow {
    i:hover {
        cursor: pointer;
    }
}

.tipology {
    max-width: 1320px;
    min-width: 375px;
    padding-left: 1rem;
    border-radius: 5px;
    margin: 0 auto;
    padding: 2rem 0.5rem 1rem 0.5rem;
    display: flex;

    .tipo-card {
        width: 120px;
        margin-left: 10px;

        .tipo-img {
            width: 100%;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
        }


        img {
            width: 100%;
            border-radius: 8px;
        }

        .name_card {
            width: 100%;
            height: 100%;

            span {
                width: 100%;
                height: 100%;
            }
        }

    }





}
</style>
