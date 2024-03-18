<script>
import axios from "axios";

export default {
    name: "Details",
    data() {
        return {
            restaurants: [],
            dishes: [],
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

        // Chiamata per recuperare i dati dei piatti
        axios
            .get("http://localhost:8000/api/v1/details")
            .then((response) => {
                this.dishes = response.data;
            })
            .catch((error) => {
                console.error("Error fetching data:", error);
            });
    },
    methods: {
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
                class="img_product rounded"
            />
        </div>
        <div class="col-12 col-md-6 text-center text-md-start mb-4">
            <h1>{{ restaurants[this.$route.params.index].name }}</h1>
            <!-- <h4 class="text-black-50">
                {{ restaurants[this.$route.params.index].citta }}
            </h4> -->
            <h4 class="text-black-50">
                {{ restaurants[this.$route.params.index].address }}
            </h4>
            <h5 class="text-success" v-if="restaurants[this.$route.params.index].visible === 1">
                APERTO
            </h5>
            <h5 class="text-danger" v-else>CHIUSO</h5>
        </div>
        <div class="menu text-center border-top">
            <h1 class="mt-4">MENU</h1>
            <div v-for="(plate, i) in dishes" :key="i" class="my-5">
                <div v-if="plate.restaurant_id === restaurants[this.$route.params.index].id">
                    <div class="border-top border-bottom py-4 d-flex flex-column" v-if="plate.visible">
                        <img :src="plate.image" alt="" />
                        <h5>{{ plate.name }}</h5>
                        <span>{{ plate.description }}</span>
                        <strong>{{ plate.price }}€</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.img_product {
    width: 100%;
    max-width: 600px;
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
