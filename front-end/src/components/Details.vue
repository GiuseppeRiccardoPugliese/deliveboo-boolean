<script>
import axios from "axios";

export default {
    name: "Details",
    data() {
        return {
            ristoranti: [], // Array per memorizzare i dati dei ristoranti
            // tipologie: [],
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
        getImageUrl(ristorante) {
            return `http://localhost:8000/storage/${ristorante}`;
        },
    }
}
</script>

<template>
    <div class="arrow-container">
        <span class="back-arrow">
            <!-- Evento click per tornare indietro -->
            <i @click="goBack" class="fa-solid fa-circle-left my-4 ms-3"></i>
        </span>
        <span class="restaurants-zone">
            <strong>Ristoranti</strong>
        </span>
    </div>
    
    <div class="row mx-3 mb-3" v-if="ristoranti[this.$route.params.index]">
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center mb-4">
            <img class="img_product"
                :src="ristoranti[this.$route.params.index].image && ristoranti[this.$route.params.index].image.includes('images/') ? getImageUrl(ristoranti[this.$route.params.index].image) : ristoranti[this.$route.params.index].image"
                alt="Ristorante Image" />
        </div>
        <div class="col-12 col-md-6 text-center text-md-start mb-4">
            <h1>{{ ristoranti[this.$route.params.index].name }}</h1>
            <!-- <h4 class="text-black-50">
                {{ ristoranti[this.$route.params.index].citta }}
            </h4> -->
            <h4 class="text-black-50">
                {{ ristoranti[this.$route.params.index].address }}
            </h4>
            <h5 class="text-success" v-if="ristoranti[this.$route.params.index].visible === 1">
                APERTO
            </h5>
            <h5 class="text-danger" v-else>CHIUSO</h5>
        </div>
        <div class="menu text-center border-top">
            <h1 class="mt-4">MENU</h1>
            <div v-for="(dish, index) in ristoranti[this.$route.params.index].dishes" :key="index"
                class="my-5 py-4 border-top border-bottom d-flex flex-column">

                <img :src="dish.image" alt="">
                <h5>{{ dish.name }}</h5>
                <span>{{ dish.description }}</span>
                <strong>{{ dish.price }}€</strong>
            </div>


        </div>
    </div>
</template>

<style lang="scss" scoped>
.img_product {
    width: 100%;
}

.back-arrow {
    padding-left: 1rem;
    font-size: 2rem;

    i:hover {
        cursor: pointer;
    }
}

.restaurants-zone {
    padding-left: 1rem;
    font-size: 1.5rem;
}
</style>
