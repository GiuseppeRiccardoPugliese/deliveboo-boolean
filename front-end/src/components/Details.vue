<script>

import axios from 'axios';

export default {
    name: "Details",
    data() {
        return {
            restaurants: [],
        };
    },
    mounted() {
        // Chiamata per recuperare i dati dei ristoranti
        axios
            .get("http://localhost:8000/api/v1/restaurants")
            .then((response) => {
                this.restaurants = response.data;
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    },
    methods: {
        /* fetchData() {
            // Simulazione della chiamata API
            fetch("/server.json")
                .then((response) => response.json())
                .then((data) => {
                    // Imposta i dati dei ristoranti ottenuti dalla chiamata API
                    this.restaurants = data;
                })
                .catch((error) => {
                    console.error("Si è verificato un errore:", error);
                });
        }, */
        goBack() {
            // Funzione per tornare alla pagina precedente
            this.$router.go(-1);
        },
    },
};
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
    <div class="row mx-3 mb-3" v-if="restaurants[this.$route.params.index]">
        <div
            class="col-12 col-md-6 d-flex justify-content-center align-items-center mb-4"
        >
            <img
                :src="restaurants[this.$route.params.index].image"
                alt=""
                class="img_product"
            />
        </div>
        <div class="col-12 col-md-6 text-center text-md-start mb-4">
            <h1>{{ restaurants[this.$route.params.index].name }}</h1>
            <h4 class="text-black-50">
                {{ restaurants[this.$route.params.index].citta }}
            </h4>
            <h4 class="text-black-50">
                {{ restaurants[this.$route.params.index].address }}
            </h4>
            <h5
                class="text-success"
                v-if="restaurants[this.$route.params.index].visible === 1"
            >
                APERTO
            </h5>
            <h5 class="text-danger" v-else>CHIUSO</h5>
        </div>
        <!-- <div class="menu text-center border-top">
            <h1 class="mt-4">MENU</h1>
            <h2 v-if="restaurants[this.$route.params.index].menu.Antipasti" class="mt-5 fw-bold">ANTIPASTI:</h2>
            <div v-for="(plate,i) in restaurants[this.$route.params.index].menu.Antipasti" :key="i" class="mt-4 d-flex flex-column">
                <h5>{{ plate.nome }}</h5>
                <span>{{ plate.descrizione }}</span>
                <strong>{{ plate.prezzo }}€</strong>
            </div>
            <h2 v-if="restaurants[this.$route.params.index].menu.PrimiPiatti" class="mt-5 fw-bold">PRIMI PIATTI:</h2>
            <div v-for="(plate,i) in restaurants[this.$route.params.index].menu.PrimiPiatti" :key="i" class="mt-4 d-flex flex-column">
                <h5>{{ plate.nome }}</h5>
                <span>{{ plate.descrizione }}</span>
                <strong>{{ plate.prezzo }}€</strong>
            </div>
            <h2 v-if="restaurants[this.$route.params.index].menu.SecondiPiatti" class="mt-5 fw-bold">SECONDI PIATTI:</h2>
            <div v-for="(plate,i) in restaurants[this.$route.params.index].menu.SecondiPiatti" :key="i" class="mt-4 d-flex flex-column">
                <h5>{{ plate.nome }}</h5>
                <span>{{ plate.descrizione }}</span>
                <strong>{{ plate.prezzo }}€</strong>
            </div>
            <h2 v-if="restaurants[this.$route.params.index].menu.Pizze" class="mt-5 fw-bold">PIZZE:</h2>
            <div v-for="(plate,i) in restaurants[this.$route.params.index].menu.Pizze" :key="i" class="mt-4 d-flex flex-column">
                <h5>{{ plate.nome }}</h5>
                <span>{{ plate.descrizione }}</span>
                <strong>{{ plate.prezzo }}€</strong>
            </div>
            <h2 v-if="restaurants[this.$route.params.index].menu.SushiESashimi" class="mt-5 fw-bold">SUSHI:</h2>
            <div v-for="(plate,i) in restaurants[this.$route.params.index].menu.SushiESashimi" :key="i" class="mt-4 d-flex flex-column">
                <h5>{{ plate.nome }}</h5>
                <span>{{ plate.descrizione }}</span>
                <strong>{{ plate.prezzo }}€</strong>
            </div>
            <h2 v-if="restaurants[this.$route.params.index].menu.Dolci" class="mt-5 fw-bold">DOLCI:</h2>
            <div v-for="(plate,i) in restaurants[this.$route.params.index].menu.Dolci" :key="i" class="mt-4 d-flex flex-column">
                <h5>{{ plate.nome }}</h5>
                <span>{{ plate.descrizione }}</span>
                <strong>{{ plate.prezzo }}€</strong>
            </div>
            <h2 v-if="restaurants[this.$route.params.index].menu.Bevande" class="mt-5 fw-bold">BEVANDE:</h2>
            <div v-for="(plate,i) in restaurants[this.$route.params.index].menu.Bevande" :key="i" class="mt-4 d-flex flex-column">
                <h5>{{ plate.nome }}</h5>
                <span>{{ plate.descrizione }}</span>
                <strong>{{ plate.prezzo }}€</strong>
            </div>
        </div> -->
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
