<script>

export default {
  name: 'AppHeader',
}

</script>


<template>
  <header>
    <nav class="navbar">
      <!-- Rotta per la Home & Logo a sinistra -->
      <router-link :to="{ name: 'Home' }">
        <div class="navbar-logo">
          <img src="../../public/Deliveboo.png" alt="Logo">
        </div>
      </router-link>
      <!-- Pulsante Account -->
      <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">Accedi</button>
    </nav>
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
    <div class="aaa">
      HEADER
      <router-link :to="{ name: 'Restaurants' }" class="cerca"> <a>cerca</a> </router-link>
    </div>
</template>

<style scoped lang="scss">
//NAV SETUP 
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #FAFAFF;
  padding: 10px 20px;

  .btn-primary {
    background-color: #00ccbc;
    border-color: grey;
  }

  .navbar-logo {
    color: white;
    width: 125px;
    text-decoration: none;

    img {
      width: 100%;
      height: 100%;
    }
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
