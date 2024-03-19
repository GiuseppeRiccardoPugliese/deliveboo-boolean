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
                    console.error(
                        "Error fetching data from second API:",
                        error
                    );
                });
        },
        goBack() {
            // Funzione per tornare alla pagina precedente
            this.$router.go(-1);
        },
        getImageUrl(ristorante) {
            return `http://localhost:8000/storage/${ristorante}`;
        },
    },
};
</script>

<template>
    <div class="bg-c">
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
            <div
                class="col-12 col-md-6 d-flex justify-content-center align-items-center mb-4"
            >
                <img
                    class="img_product"
                    :src="
                        ristoranti[this.$route.params.index].image &&
                        ristoranti[this.$route.params.index].image.includes(
                            'images/'
                        )
                            ? getImageUrl(
                                ristoranti[this.$route.params.index].image
                            )
                            : ristoranti[this.$route.params.index].image
                    "
                    alt="Ristorante Image"
                />
            </div>
            <div class="col-12 col-md-6 text-center text-md-start mb-4">
                <h1>{{ ristoranti[this.$route.params.index].name }}</h1>
                <div v-for="(type, index) in ristoranti[this.$route.params.index].tipologies" :key="index" class="my-2">
                    <h4 class="text-info">
                        - {{ type }}
                    </h4>
                </div>
                
                <h4 class="text-black-50">
                    {{ ristoranti[this.$route.params.index].address }}
                </h4>
                <h5
                    class="text-success d-none"
                    v-if="ristoranti[this.$route.params.index].visible === 1"
                >
                    APERTO
                </h5>
                <h5 class="text-danger d-none" v-else>CHIUSO</h5>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 text-center">
                    <div v-for="(dish, index) in ristoranti[this.$route.params.index].dishes" :key="index">
                        <div class="row my-5">
                            <div class="col-6 py-4 d-flex flex-column">
                                <img :src="dish.image" alt="" />
                                <h5>{{ dish.name }}</h5>
                                <span>{{ dish.description }}</span>
                                <strong>{{ dish.price }}€</strong>
                            </div>
                            <div class="col-6 d-flex justify-content-center align-items-center">
                                <button type="button" class="mx-3 btn btn-outline-success">+</button>
                                <button type="button" class="mx-3 btn btn-outline-danger">-</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_payment col-12 col-md-4 text-center border">
                    <h2>I TUOI ORDINI</h2>
                </div>
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

.bg-c {
    background-color: #f9fafa;
}

.card_payment {
    height: 400px;
    background-color: #fff;
}
</style>
