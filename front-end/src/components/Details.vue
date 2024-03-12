<script>

import data from '../../public/server.js'

export default {
    name: "Details",
    data(){
        return{
            oggetti: data
        }
    }
};
</script>

<template>
    <div class="row mx-3">
        <div class="col-12 col-md-6">
            <img :src="oggetti[0].immagine" alt="" class="img_product"/>
        </div>
        <div class="col-12 col-md-6">
            <h1>{{ oggetti[0].nome }}</h1>
            <h4 class="text-black-50">{{ oggetti[0].citta }}</h4>
            <h4 class="text-black-50">{{ oggetti[0].indirizzo }}</h4>
            <h5 class="text-black-50" v-if="oggetti[0].aperto === true">APERTO</h5>
            <h5 class="text-black-50" v-else>CHIUSO</h5>
        </div>
    </div>
    <div class="menu">
        <h1 class="text-center mt-5">MENU</h1>
        <h2>ANTIPASTI:</h2>
        <div v-for="object in oggetti">
            <h3></h3>
        </div>
    </div>
</template>

<style lang="scss" scoped>

.img_product{
    width: 400px;
}

</style>
