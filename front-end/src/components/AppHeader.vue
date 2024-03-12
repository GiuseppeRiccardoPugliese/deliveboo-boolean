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
          <img src="../assets/logo.svg" alt="Logo">
        </div>
      </router-link>
      <!-- Rotte a destra -->
      <ul class="navbar-links">
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
  </header>
  <div class="aaa">
    HEADER
    <router-link :to="{ name: 'Restaurants' }" class="cerca"> <a>cerca</a> </router-link>
  </div>
</template>

<style scoped lang="scss">
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #333;
  padding: 10px 20px;
}

.navbar-logo {
  color: white;
  width: 100px;
  height: 100px;
  text-decoration: none;

  img {
    width: 100%;
    height: 100%;
  }
}

.navbar-links {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
}

.navbar-links li {
  margin-left: 20px;
}

.navbar-links li a {
  color: white;
  text-decoration: none;
  font-size: 18px;
}
</style>
