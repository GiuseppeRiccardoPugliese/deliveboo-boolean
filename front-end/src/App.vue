<script>

//Importo axios
import axios from 'axios';
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';
import Details from './components/Details.vue';

export default {
  components: {
    AppHeader,
    AppFooter,
    Details
  }
}

</script>

<template>
  <div>
    <AppHeader />
    <router-view></router-view>
    <Details />
    <AppFooter />
  </div>
</template>

<style lang="scss">

</style>
