<script>

//Importo axios
import axios from 'axios';
import AppHeader from './components/AppHeader.vue';
import AppFooter from './components/AppFooter.vue';

// import { useRouter } from 'vue-router';
// const router = useRouter()
export default {
  components: {
    AppHeader,
    AppFooter,
  }
}

</script>

<template>
  <div>
    <AppHeader />
    <router-view></router-view>
    <AppFooter />
  </div>
</template>

<style lang="scss"></style>
