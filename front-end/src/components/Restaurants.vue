<script>
import axios from "axios";

export default {
    name: "Restaurants",
    data() {
        return {
            // Array per memorizzare i dati dei ristoranti
            ristoranti: [],
        };
    },

    mounted() {
        axios
            .get("http://localhost:8000/api/v1/restaurants")
            .then((response) => {
                this.ristoranti = response.data;
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
                <div
                    class="my-card"
                    v-for="(ristorante, index) in ristoranti"
                    :key="index"
                >
                    <router-link
                        :to="{ name: 'Details', params: { index: index } }"
                        class="router-link"
                    >
                        <div
                            class="restaurant-image"
                            :style="{
                                backgroundImage:
                                    'url(' + ristorante.image + ')',
                            }"
                        ></div>
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
</style>
