<!-- <script>
import axios from "axios";

export default {
    name: "Restaurants",
    data() {
        return {
            ristoranti: [], // Array per memorizzare i dati dei ristoranti
            tipologie: [],
            selectedTipology: [], //ARRAY PER IL FILTRO DELLE TIPOLOGIE SELEZIONATE
            clickedType: [], //ARRAY PER LE TIPOLOGIE CLICCATE
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

        axios
            .get("http://localhost:8000/api/v1/tipologies")
            .then((response) => {
                this.tipologie = response.data;
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
        getImageUrl(ristorante) { //FUNZIONE PER RITORNARE IL PATH DELL'IMG 
            return `http://localhost:8000/storage/${ristorante.image}`;
        },
        getTipology(name) { //FUNZIONE PER IL NOME DELLA TIPOLOGIA
            if (!this.selectedTipology.includes(name)) {
                this.selectedTipology.push(name);
            }
            else {
                const index = this.selectedTipology.indexOf(name); //IndexOf Restituisce l'index dell'elemento name all'interno del vettore
                if (index !== -1) { //SE NON HAI NESSUNA TIPOLOGIA SELEZIONATA ALLORA TI IMPOSTO LA PRIMA
                    this.selectedTipology.splice(index, 1);
                }
            }
            console.log(this.selectedTipology);
            this.searchTipology();
        },
        searchTipology() { //RICERCA DELLA TIPOLOGIA
            let dataToSend = {};
            if (this.selectedTipology.length > 0) {
                console.log(this.selectedTipology);
                dataToSend.tipology = this.selectedTipology;
            }
            axios.post("http://127.0.0.1:8000/api/v1/filtered", dataToSend) //CHIAMATA AXIOS FILTRATA IN BASE ALLA TIPOLOGIA SELEZIONATA
                .then((response) => {
                    this.ristoranti = response.data.restaurants;
                })
                .catch((error) => {
                    console.error("Errore durante la richiesta API:", error);
                }
                );
        },
        toggleActive(index) { //FUNZIONE PER LE TIPOLOGIE SELEZIONATE(permette di selezionare piu' tipologie insieme cambiando l'opacity se selezionate o meno)
            const elements = document.querySelectorAll('.tipo-img');
            const clickedElement = elements[index];

            // Controlla se l'elemento cliccato è già presente nell'array this.clickedType
            const isClicked = this.clickedType.includes(index);

            // Se l'elemento è già stato cliccato, rimuovilo dall'array e dalla classe
            if (isClicked) {
                const idx = this.clickedType.indexOf(index);
                this.clickedType.splice(idx, 1);
            } else {
                // Altrimenti, aggiungi l'indice all'array
                this.clickedType.push(index);
            }

            // Aggiorna la classe di tutti gli elementi in base all'array clickedType
            elements.forEach((element, i) => {
                if (this.clickedType.includes(i)) {
                    element.classList.add('opacity-50');
                } else {
                    element.classList.remove('opacity-50');
                }
            });

            console.log(this.clickedType);
        }
    }
}
</script> -->

<script>
import axios from "axios";

export default {
    name: "Restaurants",
    data() {
        return {
            ristoranti: [], // Array per memorizzare i dati dei ristoranti
            tipologie: [],
            selectedTipology: [], //ARRAY PER IL FILTRO DELLE TIPOLOGIE SELEZIONATE
            clickedType: [], //ARRAY PER LE TIPOLOGIE CLICCATE
            originalRistoranti: [] // Array per memorizzare l'elenco originale dei ristoranti
        };
    },
    mounted() {
        // Effettua la prima chiamata per ottenere i ristoranti dalla prima API
        axios
            .get("http://localhost:8000/api/v1/deliveboo")
            .then((response) => {
                this.ristoranti = response.data;
                // Assegna l'elenco originale dei ristoranti
                this.originalRistoranti = response.data;

                // Una volta ricevuti i dati dalla prima API, effettua la seconda chiamata
                this.fetchSecondApiData();
            })
            .catch((error) => {
                console.error("Error fetching data from first API:", error);
            });

        axios
            .get("http://localhost:8000/api/v1/tipologies")
            .then((response) => {
                this.tipologie = response.data;
            })
            .catch((error) => {
                console.error("Error fetching data from first API:", error);
            });
    },
    methods: {
        fetchSecondApiData() {
            // Effettua la seconda chiamata per ottenere i ristoranti dalla seconda API (file JSON simulato)
            axios
                .get("http://localhost:5174/server.json")
                .then((response) => {
                    // Aggiungi i ristoranti dalla seconda API alla lista esistente
                    this.ristoranti = [...this.ristoranti, ...response.data];
                    // Salva l'elenco originale anche per i ristoranti della seconda API
                    this.originalRistoranti = [...this.originalRistoranti, ...response.data];
                })
                .catch((error) => {
                    console.error("Error fetching data from second API:", error);
                });
        },
        goBack() {
            // Funzione per tornare alla pagina precedente
            this.$router.go(-1);
        },
        getImageUrl(ristorante) { //FUNZIONE PER RITORNARE IL PATH DELL'IMG 
            return `http://localhost:8000/storage/${ristorante.image}`;
        },
        getTipology(name) { //FUNZIONE PER IL NOME DELLA TIPOLOGIA
            if (!this.selectedTipology.includes(name)) {
                this.selectedTipology.push(name);
            }
            else {
                const index = this.selectedTipology.indexOf(name); //IndexOf Restituisce l'index dell'elemento name all'interno del vettore
                if (index !== -1) { //SE NON HAI NESSUNA TIPOLOGIA SELEZIONATA ALLORA TI IMPOSTO LA PRIMA
                    this.selectedTipology.splice(index, 1);
                }
            }
            console.log(this.selectedTipology);
            this.searchTipology();
        },
        searchTipology() {
            // Se non ci sono tipologie selezionate, ripristina l'elenco completo dei ristoranti
            if (this.selectedTipology.length === 0) {
                this.ristoranti = [...this.originalRistoranti];
                return;
            }

            // Altrimenti, applica il filtro basato sulle tipologie selezionate
            let filteredRestaurants = [...this.originalRistoranti];
            filteredRestaurants = filteredRestaurants.filter(ristorante => {
                return ristorante.tipologies.some(tipologia => this.selectedTipology.includes(tipologia));
            });

            // Aggiorna la lista dei ristoranti con quelli filtrati
            this.ristoranti = filteredRestaurants;
        },
        toggleActive(index) { //FUNZIONE PER LE TIPOLOGIE SELEZIONATE(permette di selezionare piu' tipologie insieme cambiando l'opacity se selezionate o meno)
            const elements = document.querySelectorAll('.tipo-img');
            const clickedElement = elements[index];

            // Controlla se l'elemento cliccato è già presente nell'array this.clickedType
            const isClicked = this.clickedType.includes(index);

            // Se l'elemento è già stato cliccato, rimuovilo dall'array e dalla classe
            if (isClicked) {
                const idx = this.clickedType.indexOf(index);
                this.clickedType.splice(idx, 1);
            } else {
                // Altrimenti, aggiungi l'indice all'array
                this.clickedType.push(index);
            }

            // Aggiorna la classe di tutti gli elementi in base all'array clickedType
            elements.forEach((element, i) => {
                if (this.clickedType.includes(i)) {
                    element.classList.add('opacity-50');
                } else {
                    element.classList.remove('opacity-50');
                }
            });

            console.log(this.clickedType);
        }
    }
}
</script>



<template>
    <section>
        <!-- TIPOLOGIE -->
        <div class="tipology">
            <div class="tipo-card" v-for="(tipologia, index) in tipologie" :key="index">
                <div class="tipo-img" @click=" getTipology(tipologia.name)"> <!-- Click prende la tipologia -->
                    <img :src="tipologia.image" alt="" @click="toggleActive(index)"> <!-- Click opacity -->
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
                    <router-link :to="{ name: 'Details', params: { index: index, restaurantName: ristorante.name } }" class="router-link">
                        <div class="restaurant-image"
                            :style="{ 'background-image': ristorante.image && ristorante.image.includes('images/') ? 'url(' + getImageUrl(ristorante) + ')' : 'url(' + ristorante.image + ')' }">
                            <div class="tipology-container">
                            <!-- Utilizza v-for per iterare sulle tipologie del ristorante e mostrare le tipologie -->
                            <span class="tipology-pin" v-for="(tipologia, idx) in ristorante.tipologies" :key="idx">{{ tipologia }}</span>
                        </div>
                        </div>
                        <h6>{{ ristorante.name }}</h6>
                        <p v-if="ristorante.visible" class="open-status d-none">
                            Aperto
                        </p>
                        <p v-else class="closed-status d-none">Chiuso</p>
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

.my-card {
    position: relative;
    display: inline-block;
}

.tipology-container {
    position: absolute;
    bottom: 45px;
    left: -5px;
    padding: 10px;
}

.tipology-pin {
    background-color: #4285f4;
    color: white;
    font-weight: bold; 
    padding: 4px 12px; 
    border-radius: 8px; 
    margin-left: 5px; 
    display: inline-block;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);    
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    transition: background-color 0.3s ease;
}

.tipology-pin:hover {
    background-color: #3367d6;
}

.restaurant-container {
    opacity: 0;
    transform: translateY(100%);
    transition: opacity 1s ease, transform 1s ease;
}

.restaurant-container.pop-up {
    opacity: 1;
    transform: translateY(0);
}
</style>
