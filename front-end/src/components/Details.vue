<script>
import axios from "axios";

export default {
    name: "Details",
    data() {
        return {
            ristoranti: [], // Array per fare il fetch dei ristoranti dal database
            totalPrice: 0, // Variavile per calcolare il prezzo totale
            orderData: {
                restaurantIndex: "",
                restaurantId: "",
                price: 0,
                orders: [],
            },
        };
    },
    created() {
        const storedData = JSON.parse(localStorage.getItem("orderData") || "{}");
        this.orderData = storedData.orderData || [];
        this.totalPrice = storedData.orderData.price || 0,
            console.log('Contenuto di localStorage1:', storedData.orderData);
    },
    mounted() {
        // Effettua la prima chiamata per ottenere i ristoranti dalla prima API
        axios
            .get("http://localhost:8000/api/v1/deliveboo")
            .then((response) => {
                this.ristoranti = response.data;
                // Una volta ricevuti i dati dalla prima API, effettua la seconda chiamata
            })
            .catch((error) => {
                console.error("Error fetching data from first API:", error);
            });
    },
    methods: {
        localStorage() {
            const dataToSave = {
                orderData: this.orderData,
            };
            localStorage.setItem("orderData", JSON.stringify(dataToSave));
        },
        goBack() {
            // Funzione per tornare alla pagina precedente
            this.$router.go(-1);
        },
        getImageUrl(ristorante) {
            return `http://localhost:8000/storage/${ristorante}`;
        },
        addToOrder(dish) {
            const restaurantId = this.ristoranti[this.$route.params.index].id;
            const restaurantIndex = this.$route.params.index;

            if (this.orderData.restaurantId === "") {
                this.orderData.restaurantId = restaurantId;
                this.orderData.restaurantIndex = restaurantIndex;
            } else if (this.orderData.restaurantId !== restaurantId) {
                // Mostra un alert con il messaggio appropriato
                if (confirm("Hai già un carrello aperto con un altro ristorante. Vuoi cancellarlo e proseguire o vuoi tornare sul vecchio ristorante?")) {
                    // Se l'utente conferma, cancella l'ordine attuale e prosegui
                    this.deleteOrders();
                    this.orderData.restaurantId = restaurantId;
                    this.orderData.restaurantIndex = restaurantIndex;
                } else {
                    // Altrimenti, torna sul vecchio ristorante
                    this.$router.push({ name: 'Details', params: { index: this.orderData.restaurantIndex } });
                    return;
                }
            }

            // Assicurati che this.orderData.orders sia definito
            if (!this.orderData.orders) {
                this.orderData.orders = [];
            }

            const existingOrder = this.orderData.orders.find(order => order.name === dish.name);
            const price = parseFloat(dish.price); // Converti il prezzo del piatto in un numero
            if (existingOrder) {
                existingOrder.quantity++;
                existingOrder.price += price;
            } else {
                this.orderData.orders.push({ name: dish.name, quantity: 1, price: price, dishId: dish.id });
            }
            this.totalPrice += price; // Aggiorna il prezzo totale
            const dataToSave = {
                orderData: this.orderData,
            };
            localStorage.setItem("orderData", JSON.stringify(dataToSave));
        },

        removeFromOrder(dish) {
            const existingOrderIndex = this.orderData.orders.findIndex(order => order.name === dish.name);
            if (existingOrderIndex !== -1) {
                const existingOrder = this.orderData.orders[existingOrderIndex];
                existingOrder.quantity--;
                existingOrder.price -= dish.price;
                if (existingOrder.quantity === 0) {
                    this.orderData.orders.splice(existingOrderIndex, 1);
                }
                this.totalPrice -= dish.price; // Aggiorna il prezzo totale
                localStorage.setItem("totalPrice", this.totalPrice);
            }
        },
        deleteOrders() {
            this.totalPrice = 0;
            this.orderData.restaurantIndex = "";
            this.orderData.restaurantId = "";
            this.orderData.price = 0;
            this.orderData.orders = [];
        }
    },
    watch: {
        orders: { // Un watcher per monitorare le modifiche agli ordini e salvare nel localStorage
            handler(newOrders) {
                this.orderData.orders = newOrders;
                this.localStorage();
            },
            deep: true,
        },
        totalPrice: {
            handler(newTotalPrice) {
                this.orderData.price = newTotalPrice; // Aggiorna orderData.price con totalPrice
                this.localStorage(); // Salva nel localStorage dopo l'aggiornamento
            },
            deep: true,
        },
        orderData: {
            handler(newOrderData) {
                this.localStorage();
            },
            deep: true,
        },
    },
};
// ristoranti: {
//     handler: function (newValue, oldValue) {
//         if (newValue.length > 0) {
//             this.addToOrderWithRestaurantId(); // Richiama la funzione quando la lista dei ristoranti viene aggiornata
//         }
//     },
//     deep: true // Controlla anche le modifiche interne degli oggetti nell'array ristoranti
// }
// computed: {
//     itemsFromLocalStorage() {
//         // Recupera gli elementi dal localStorage e analizza il JSON, se presente
//         return JSON.parse(localStorage.getItem("orderData") || "[]");
//     },
// },
// addToOrderWithRestaurantId() {
//     if (this.ristoranti.length > 0) { // Assicurati che ci sia almeno un ristorante nella lista
//         const restaurantId = this.ristoranti[this.$route.params.index].id; // Recupera l'ID del primo ristorante
//         this.orderData = {
//             ...this.orderData,
//             restaurantId: restaurantId
//         };
//     }
// },
// addToOrder(dish, restaurantId) {
//     const existingOrder = this.orderData.orders.find(order => order.name === dish.name);
//     const price = parseFloat(dish.price); // Converti il prezzo del piatto in un numero
//     if (existingOrder) {
//         existingOrder.quantity++;
//         existingOrder.price += price;
//     } else {
//         this.orderData.orders.push({ name: dish.name, quantity: 1, price: price, dishId: dish.id });
//     }
//     this.totalPrice += price; // Aggiorna il prezzo totale
//     console.log(this.totalPrice);
// },
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
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center mb-4">
                <img class="img_product rounded" :src="ristoranti[this.$route.params.index].image &&
                    ristoranti[this.$route.params.index].image.includes(
                        'images/'
                    )
                    ? getImageUrl(
                        ristoranti[this.$route.params.index].image
                    )
                    : ristoranti[this.$route.params.index].image
                    " alt="Ristorante Image" />
            </div>
            <div class="col-12 col-md-6 text-center text-md-start mb-4">
                <h1>{{ ristoranti[this.$route.params.index].name }}</h1>
                <h3 class="text-primary my-2">Tipologie:</h3>
                <div v-for="(type, index) in ristoranti[this.$route.params.index]
                    .tipologies" :key="index" class="text-center text-md-start">

                    <h4 class="text-black-50 fw-bold">- {{ type }}</h4>
                </div>

                <h4 class="text-black-50 my-3">
                    {{ ristoranti[this.$route.params.index].address }}
                </h4>
                <h5 class="text-success d-none" v-if="ristoranti[this.$route.params.index].visible === 1">
                    APERTO
                </h5>
                <h5 class="text-danger d-none" v-else>CHIUSO</h5>
            </div>
            <div class="row">
                <div class="col-12 col-md-8 text-center">
                    <div v-for="(dish, index) in ristoranti[
                    this.$route.params.index
                ].dishes" :key="index">
                        <div class="row my-5">
                            <div class="col-6 py-4 d-flex flex-column">
                                <img :src="dish.image" alt="" />
                                <h5>{{ dish.name }}</h5>
                                <span>{{ dish.description }}</span>
                                <strong>{{ dish.price }}€</strong>
                            </div>
                            <div class="col-6 d-flex justify-content-center align-items-center">
                                <button type="button" class="mx-3 btn btn-outline-danger"
                                    @click="removeFromOrder(dish)">-</button>
                                <button type="button" class="mx-3 btn btn-outline-success"
                                    @click="addToOrder(dish)">+</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card_payment col-12 col-md-4 text-center border pt-3">

                    <h2>I TUOI ORDINI</h2>

                    <div v-for="(order, index) in orderData.orders" :key="index">
                        <p><strong class="text-black-50">x{{ order.quantity }} |</strong> {{ order.name }} <strong>{{
                    order.price.toFixed(2) }}€</strong></p>
                    </div>
                    <p><strong>Totale: {{ totalPrice.toFixed(2) }}€</strong></p>

                    <router-link :to="{ name: 'Payment' }">
                        <button class="btn btn-primary" type="button" style="width: 100%;">Effettua l'ordine</button>
                    </router-link>

                    <button class="btn btn-danger mt-3" type="button" style="width: 100%;"
                        @click="deleteOrders()">Svuota il carrello
                    </button>

                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.img_product {
    width: 100%;
    max-width: 700px;
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
    height: 600px;
    background-color: #fff;
    position: sticky;
    top: 2%;
}
</style>
