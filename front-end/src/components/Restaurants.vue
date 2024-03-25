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
            originalRistoranti: [], // Array per memorizzare l'elenco originale dei ristoranti
            // loaded: false,
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
                // this.fetchSecondApiData();
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

        // setTimeout(() => {
        //     this.loaded = true; // Imposta lo stato a true dopo un certo periodo di tempo
        // }, 550);
    },
    methods: {
        // fetchSecondApiData() {
        //     // Effettua la seconda chiamata per ottenere i ristoranti dalla seconda API (file JSON simulato)
        //     axios
        //         .get("http://localhost:5174/server.json")
        //         .then((response) => {
        //             // Aggiungi i ristoranti dalla seconda API alla lista esistente
        //             this.ristoranti = [...this.ristoranti, ...response.data];
        //             // Salva l'elenco originale anche per i ristoranti della seconda API
        //             this.originalRistoranti = [...this.originalRistoranti, ...response.data];
        //         })
        //         .catch((error) => {
        //             console.error("Error fetching data from second API:", error);
        //         });
        // },
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

                if (this.selectedTipology.length >= 2) {
                    return ristorante.tipologies.every(tipologia => this.selectedTipology.includes(tipologia));
                }

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
                this.clickedType.push(index);
            }
            elements[index].classList.toggle('scaled', !isClicked);

            // Aggiorna la classe di tutti gli elementi in base all'array clickedType
            elements.forEach((element, i) => {
                if (this.clickedType.length === 0 || this.clickedType.includes(i)) {
                    element.classList.remove('myopacity');
                    element.classList.remove('downscaled');

                } else {
                    element.classList.add('myopacity');
                    element.classList.add('downscaled');

                }
            });
        }
    }
}
</script>



<template>
    <div class="my-general-container">
        <!-- <section class="restaurant-container" :class="{ 'pop-up': loaded }"> -->
        <section class="restaurant-container">

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
                <div class="my-card-container">
                    <!-- Utilizza v-for per iterare sui ristoranti e mostrare i dati -->
                    <div class="my-card" v-for="(ristorante, index) in ristoranti" :key="index">
                        <router-link
                            :to="{ name: 'Details', params: { index: originalRistoranti.indexOf(ristorante), restaurantName: ristorante.name } }"
                            class="router-link">
                            <div class="restaurant-image"
                                :style="{ 'background-image': ristorante.image && ristorante.image.includes('images/') ? 'url(' + getImageUrl(ristorante) + ')' : 'url(' + ristorante.image + ')' }">
                                <div class="tipology-container">
                                    <!-- Utilizza v-for per iterare sulle tipologie del ristorante e mostrare le tipologie -->
                                    <span class="tipology-pin" v-for="(tipologia, idx) in ristorante.tipologies"
                                        :key="idx">{{ tipologia }}</span>
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
    </div>
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
            transition: opacity 0.5s ease, transform 0.5s ease;
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

    .tipo-card:hover {
        cursor: pointer;
    }

}

// .my-general-container {
//     height: 100%;
//     //   min-height: calc(100vh - 60px - 500px);

// }

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
    background-color: #6b4658;
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




// ANIMAZIONE PER FILTRI TYPO

.scaled,
.downscaled,
.myopacity {
    transition: all 0.5s ease;
}

.scaled {
    transform: scale(1.05);
}

.downscaled {
    transform: scale(0.95);
}

.myopacity {
    opacity: 0.5;
}
</style>
