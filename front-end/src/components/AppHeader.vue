<script>

export default {
  name: 'AppHeader',
  data() {
    return {
      isWide: false // Inizialmente impostato su false
    };
  },
  watch: {
    // Osserva il cambio di rotta
    '$route'() {
      this.verificaCambioRotta();
    }
  },
  methods: {
    verificaCambioRotta() {
      // Verifica la rotta corrente e imposta isWide in base ad essa
      this.isWide = this.$route.name === 'Restaurants';
    }
  },
  mounted() {
    // Esegui la funzione handleRouteChange al caricamento della pagina
    this.verificaCambioRotta();
  }
}

</script>


<template>
  <header class="fixed-header">
    <transition name="nav-transition">
      <nav class="navbar">
        <section class="nav-section" :style="{ maxWidth: isWide ? '1320px' : '100%' }">

          <!-- Rotta per la Home & Logo a sinistra -->
          <router-link :to="{ name: 'Carousel' }">
            <div class="navbar-logo">
              <img src="../../public/Deliveboo1.png" alt="Deliveboo Logo">
            </div>
          </router-link>

          <!-- Pulsante Account -->
          <div>
            <button class="btn btn-primary d-flex" type="button" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
              <i class="fa-solid fa-bars fs-4"></i>
            </button>
          </div>

        </section>
      </nav>
    </transition>
  </header>

  <!-- Off-canvas -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom border-1">
      <img class="login-logo" src="../../public/Deliveboo.png" alt="Logo">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <!-- Rotta per la Login page -->
      <!-- <router-link :to="{ name: 'Login' }"> -->
      <a href="http://localhost:8000/register" class="offcanvas-title d-block mb-3" id="offcanvasRightLabel">Registrati
        come
        ristoratore! </a>
      <a href="http://localhost:8000/login" class="offcanvas-title" id="offcanvasRightLabel">Accedi come
        ristoratore!</a>
      <!-- </router-link> -->
    </div>
  </div>
</template>

<style scoped lang="scss">
@use '../style/partials/variables' as *;

.fixed-header {
  // position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
}

//NAV SETUP 

.navbar {
  background-color: #FAFAFF;
  width: 100%;
  padding: 0;
}

.nav-section {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #FAFAFF;
  padding: 0 20px;
  margin: 0 auto;
  /* velocità animazione NavBar*/
  transition: max-width 0.3s ease;

  .btn-primary {
    background-color: $btn_color;
    border-color: grey;
  }

  .navbar-logo {
    height: 60px;
    // width: 230px;
    text-decoration: none;
    // background-image: url('../../public/Deliveboo1.png');
    // background-size: contain;
    // background-position: center;
    // background-repeat: no-repeat;
    padding: 0.5rem 0;
  }

  img {
    height: 40px;
  }

}

//OFF CANVAS 
.offcanvas {
  width: 300px;

  .offcanvas-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    .login-logo {
      width: 125px;
    }
  }
}

.blurred {
  filter: blur(0.25rem);
  transition: filter 0.3s ease;
}
</style>
