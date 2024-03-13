<script>
export default {
    name: "Details",
    data() {
        return {
            restaurants: [],
        };

    },
    mounted() {
        // Chiamata per recuperare i dati dei ristoranti
        this.fetchData();
        console.log(this.$route.params.index);
        console.log(this.restaurants)
    },
    methods: {
        fetchData() {
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
        },
    },
};
</script>

<template>
    <div class="row m-3" v-if="restaurants">
        <div
            class="col-12 col-md-6 d-flex justify-content-center align-items-center"
        >
            <img :src="restaurants[this.$route.params.index].immagine" alt="" class="img_product" />
        </div>
        <div class="col-12 col-md-6 text-center text-md-start">
            <h1>{{ restaurants[this.$route.params.index].nome }}</h1>
            <h4 class="text-black-50">{{ restaurants[this.$route.params.index].citta }}</h4>
            <h4 class="text-black-50">{{ restaurants[this.$route.params.index].indirizzo }}</h4>
            <h5 class="text-success" v-if="restaurants[this.$route.params.index].aperto === true">
                APERTO
            </h5>
            <h5 class="text-danger" v-else>CHIUSO</h5>
        </div>
        <div class="menu">
            <h1 class="text-center mt-4">MENU</h1>
            <h2>ANTIPASTI:</h2>
            <!-- <div v-for="object in oggetti">
            <h3></h3>
        </div> -->
        </div>
    </div>
</template>

<style lang="scss" scoped>
.img_product {
    width: 100%;
}
</style>
