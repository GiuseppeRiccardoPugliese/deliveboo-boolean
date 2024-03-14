<script>
export default {
  name: "Login",
  data() {
    return {
      login: true,
      registraAzienda: true,
    }
  },
  methods: {
    clickRegistration() {
      this.login = false
    },

    log() {

      this.login = true
      this.registraAzienda = true
    }
  }
};
</script>

<template>

  <!-- Accedi -->
  <form action="#" class="login" v-if="login === true">
    <h2>Accedi</h2>
    <div class="input">
      <label class="label" for="email">Indirizzo email</label>
      <input type="text" name="email" placeholder="es:name@example.com" class="p-2" required>
    </div>
    <div class="input">
      <label class="label" for="password">Password</label>
      <input type="password" name="password" placeholder="password" class="p-2" required>
    </div>

    <div class="button">
      <button>LOGIN</button>
    </div>
    <div>Non sei ancora registrato?<a href="#" @click="clickRegistration">Registrati</a></div>

  </form>

  <!-- Registra Utente -->
  <!-- <form action="#" class="login" v-if="registrazione === true && login === false">
    <h2>Registrati</h2>
    <div class="input">
      <label class="label" for="name">Nome</label>
      <input type="text" name="name" class="p-2">
    </div>
    <div class="input">
      <label class="label" for="email">Indirizzo email</label>
      <input type="text" name="email" placeholder="es:name@example.com" class="p-2">
    </div>
    <div class="input">
      <label class="label" for="password">Password</label>
      <input type="password" name="password" placeholder="password" class="p-2">
    </div>
    <div class="input">
      <label class="label" for="password">Confirm Password</label>
      <input type="text" name="password" placeholder="password" class="p-2">
    </div>

    <div class="button">
      <button>REGISTRATI</button>
    </div>
    <div>Vuoi registrarti come ristoratore?<a href="#" @click="registerCompany">Registra Azienda</a></div>

  </form>-->


  <!-- Registra Ristorante -->
  <form action="#" class="login" v-if="login === false && registraAzienda === true">
    <h2>Registra ristorante</h2>
    <div class="input">
      <label class="label" for="name">Nome ristorante: </label>
      <input type="text" name="name" class="p-2" required>
    </div>
    <div class="input">
      <label class="label" for="email">Indirizzo email: </label>
      <input type="text" name="email" placeholder="es: name@example.com" class="p-2" required>
    </div>
    <div class="input">
      <label class="label" for="address">Indirizzo ristorante: </label>
      <input type="text" name="address" placeholder="es: Via Milano 1, 20100" class="p-2" required>
    </div>
    <div class="input">
      <label class="label" for="password">Password: </label>
      <input type="password" name="password" placeholder="password" class="p-2" required>
    </div>
    <div class="input">
      <label class="label" for="piva">PIVA</label>
      <input type="text" name="piva" placeholder="12345678901" class="p-2" required>
    </div>
    <label for="tipo">Tipologia ristorante: </label>
    <select name="tipo" id="tipo" class="my-3 ms-3" required>
      <option value="#">Sushi</option>
      <option value="#">Pizzeria</option>
      <option value="#">Kebab</option>
      <option value="#">Gelateria</option>
      <option value="#">Bar</option>
    </select>

    <div class="button">
      <button>REGISTRATI</button>
    </div>
    <div><a href="#" @click="log">Accedi</a></div>

  </form>

</template>

<style lang="scss" scoped>
.login {
  padding: 50px;
  width: 477px;
  margin: 20px auto;
}

.input {
  margin: 15px 0;
}

.label {
  margin-bottom: 5px;
}

.button {
  text-align: center;
}

button {
  width: 100%;
  height: 40px;
  border-radius: 7px;
  background-color: #E2E5E5;
  margin-bottom: 7px;
}

button:hover {
  background-color: #22cdd0;
  color: white;
}

input {
  border: 1px solid rgb(195, 192, 192);
  border-radius: 5px;
  height: 40px;
  width: 100%;
}

input:focus {
  border-color: #22cdd0;
}

a {
  color: #22cdd0;
  margin-left: 3px;
}
</style>