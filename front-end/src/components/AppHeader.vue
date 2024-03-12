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
