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
  <header>
    <transition name="nav-transition">
      <nav class="navbar">
        <section class="nav-section" :style="{ maxWidth: isWide ? '1320px' : '100%' }">

          <!-- Rotta per la Home & Logo a sinistra -->
          <router-link :to="{ name: 'Home' }">
            <div class="navbar-logo"></div>
          </router-link>
    
          <!-- Pulsante Account -->
          <div>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
              aria-controls="offcanvasRight">
              Accedi
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
      <router-link :to="{ name: 'Login' }">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Accedi o Registrati!</h5>
      </router-link>
    </div>
  </div>
</template>

<style scoped lang="scss">
@use '../style/partials/variables' as *;

//NAV SETUP 

.navbar {
  background-color: #FAFAFF;
  width: 100%;
}

.nav-section {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #FAFAFF;
  padding: 5px 20px;
  margin: 0 auto;
  /* velocità animazione NavBar*/
  transition: max-width 0.3s ease;

  .btn-primary {
    background-color: $btn_color;
    border-color: grey;
  }

  .navbar-logo {
    height: 70px;
    width: 230px;
    text-decoration: none;
    background-image: url('../../public/Deliveboo1.png');
    background-size: contain;
    background-position: center;
    background-repeat: no-repeat;
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
