<!-- <script>
import axios from "axios";

export default {
  name: "Payment",
  data() {
    return {
      orders: [], // Array per memorizzare i dettagli dell'ordine
      totalPrice: 0,
      // guest_name: "",
      // guest_email: "",
      // guest_address: "",
      orderData: {
        number_order: "",
        price: 0,
        guest_name: "",
        guest_email: "",
        guest_address: "",
        orders: [],
      },
    };
  },
  computed: {
    itemsFromLocalStorage() {
      // Recupera gli elementi dal localStorage e analizza il JSON, se presente
      return JSON.parse(localStorage.getItem("orders") || "[]");
    },
  },
  methods: {
    localStorage() {
      const dataToSave = {
        orders: this.orders,
        // sum: this.sum,
        totalPrice: this.totalPrice,
        orderData: this.orderData
      };

      // Salva gli elementi nel localStorage
      localStorage.setItem("cartData", JSON.stringify(dataToSave));
    },
    sendData() {
      console.log("Dati prima dell'invio:", this.orderData);
      this.errorsValidation();
      if (
        this.orderData.guest_name &&
        this.orderData.guest_email &&
        this.orderData.guest_address
      ) 
      {
        // Chiamata al metodo del componente Details per salvare i dati nel localStorage
        this.localStorage();

        this.orderData.total_price = this.totalPrice; // Modificato da this.sum
        this.orders.forEach((order) => {
          this.orderData.product_name.push(order.name);
          // Non hai bisogno di salvare gli ID dei prodotti o le quantità se stai già salvando gli ordini
        });

        axios.post("http://127.0.0.1:8000/api/orders", this.orderData);
        console.log(this.orderData);
        console.log(this.orders);
        this.$router.push({ name: "order_confirmed" });
      }
    }

  },
  watch: {
    // Un watcher per monitorare le modifiche agli ordini e salvare nel localStorage
    orders: {
      handler(newOrders) {
        this.localStorage();
      },
      deep: true,
    },
    totalPrice() {
      this.localStorage();
    },
    orderData: {
      handler(newOrderData) {
        this.localStorage();
      },
      deep: true,
    },
  },
  mounted() {
    // Recupera gli ordini dal localStorage e analizza il JSON, se presente
    const ordersFromLocalStorage = localStorage.getItem("orders");
    if (ordersFromLocalStorage) {
      // Se ci sono dati nel localStorage, analizzali e assegnali a this.orders
      this.orders = JSON.parse(ordersFromLocalStorage);
    }
  },
  created() {
    const storedData = JSON.parse(localStorage.getItem("cartData") || "{}");
    this.orders = storedData.orders || [];
    // this.sum = storedData.sum || 0;
    this.totalPrice = storedData.totalPrice || 0;
    this.orderData = storedData.orderData || {};

    console.log('Contenuto di localStorage:', storedData);
  },
}
</script>



<template>
  <div class="order-card">
    <div class="order-details">
      <h2 class="order-title">Riepilogo dell'ordine</h2>
      <div class="order-items">
        <div v-for="(order, index) in orders" :key="index" class="order-item">
          <p>{{ order.name }} ({{ order.quantity }}) - {{ order.price }}€</p>
        </div>
      </div>
      <p class="order-total">Totale: {{ totalPrice }}€</p>
    </div>
    <form action="">

      <div>
        <label for="guest_name">Nome:</label>
        <input type="text" id="guest_name" v-model="guest_name" required>
      </div>
      <div>
        <label for="guest_address">Indirizzo:</label>
        <input type="text" id="guest_address" v-model="guest_address" required>
      </div>
      <div>
        <label for="guest_email">Email:</label>
        <input type="email" id="guest_email" v-model="guest_email" required>
      </div>

      <button class="confirm-button" @click="sendData()">Conferma Pagamento</button>

    </form>
  </div>

</template> -->

<script>
import axios from "axios";

export default {
  name: "Payment",
  data() {
    return {
      orders: [], // Array per memorizzare i dettagli dell'ordine
      totalPrice: 0,
      orderData: {
        number_order: "",
        price: 0,
        guest_name: "",
        guest_email: "",
        guest_address: "",
        product_name: [], // Aggiunto array per memorizzare i nomi dei prodotti
        orders: [],
      },
    };
  },
  computed: {
    itemsFromLocalStorage() {
      // Recupera gli elementi dal localStorage e analizza il JSON, se presente
      return JSON.parse(localStorage.getItem("orders") || "[]");
    },
  },
  methods: {
    localStorage() {
      const dataToSave = {
        orders: this.orders,
        totalPrice: this.totalPrice,
        orderData: this.orderData,
      };

      // Salva gli elementi nel localStorage
      localStorage.setItem("cartData", JSON.stringify(dataToSave));
    },
    sendData() {
      console.log("Dati prima dell'invio:", this.orderData);
      this.errorsValidation();
      if (
        this.orderData.guest_name &&
        this.orderData.guest_email &&
        this.orderData.guest_address
      ) {
        // Chiamata al metodo per salvare i dati nel localStorage
        this.localStorage();

        this.orderData.price = this.totalPrice; // Modificato da this.sum
        this.orders.forEach((order) => {
          this.orderData.product_name.push(order.name);
        });
        this.orderData.orders = this.orders;


        axios.post("http://127.0.0.1:8000/api/orders", this.orderData);
        console.log(this.orderData);
        // console.log(this.orders);
        // this.$router.push({ name: "order_confirmed" });
      }
    },
  },
  watch: {
    // Un watcher per monitorare le modifiche agli ordini e salvare nel localStorage
    orders: {
      handler(newOrders) {
        this.localStorage();
      },
      deep: true,
    },
    totalPrice() {
      this.localStorage();
    },
    orderData: {
      handler(newOrderData) {
        this.localStorage();
      },
      deep: true,
    },
  },
  mounted() {
    // Recupera gli ordini dal localStorage e analizza il JSON, se presente
    const ordersFromLocalStorage = localStorage.getItem("orders");
    if (ordersFromLocalStorage) {
      // Se ci sono dati nel localStorage, analizzali e assegnali a this.orders
      this.orders = JSON.parse(ordersFromLocalStorage);
    }
  },
  created() {
    const storedData = JSON.parse(localStorage.getItem("cartData") || "{}");
    this.orders = storedData.orders || [];
    this.totalPrice = storedData.totalPrice || 0;
    this.orderData = storedData.orderData || {};

    console.log('Contenuto di localStorage:', storedData);
  },
}
</script>

<template>
  <div class="order-card">
    <div class="order-details">
      <h2 class="order-title">Riepilogo dell'ordine</h2>
      <div class="order-items">
        <div v-for="(order, index) in orders" :key="index" class="order-item">
          <p>{{ order.name }} ({{ order.quantity }}) - {{ order.price }}€</p>
        </div>
      </div>
      <p class="order-total">Totale: {{ totalPrice }}€</p>
    </div>
    <form action="">

      <div>
        <label for="guest_name">Nome:</label>
        <input type="text" id="guest_name" v-model="orderData.guest_name" required>
      </div>
      <div>
        <label for="guest_address">Indirizzo:</label>
        <input type="text" id="guest_address" v-model="orderData.guest_address" required>
      </div>
      <div>
        <label for="guest_email">Email:</label>
        <input type="email" id="guest_email" v-model="orderData.guest_email" required>
      </div>

      <button class="confirm-button" @click="sendData()">Conferma Pagamento</button>

    </form>
  </div>
</template>


<style lang="scss">
.order-card {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

.order-details {
  margin-bottom: 20px;
}

.order-title {
  font-size: 24px;
  color: #1c1c1c;
  margin-bottom: 10px;
}

.order-items {
  margin-bottom: 10px;
}

.order-item {
  padding: 10px 0;
  border-bottom: 1px solid #eaeaea;
}

.order-total {
  font-size: 18px;
  font-weight: bold;
  color: #1c1c1c;
}

.confirm-button {
  display: block;
  width: 100%;
  padding: 12px 0;
  background-color: #ff5a5f;
  color: #fff;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.confirm-button:hover {
  background-color: #e75155;
}
</style>
