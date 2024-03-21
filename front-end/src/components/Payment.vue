<script>
import axios from "axios";

export default {
  name: "Payment",
  data() {
    return {
      orders: [], // Array per memorizzare i dettagli dell'ordine
      totalPrice: 0
    };
  },
  methods: {
    confirmOrder() {
      // Raccolta dei dettagli dell'ordine
      const orderData = {
        // Altri dettagli dell'ordine se necessario
        dishes: this.orders, // Array contenente gli elementi del carrello
        totalPrice: this.totalPrice // Aggiungi il prezzo totale
      };

      // Invia la richiesta PUT per aggiornare l'ordine al backend
      axios.post(`/api/orders/${orderId}`, orderData)
        .then(response => {
          console.log('Ordine aggiornato con successo:', response.data);
          // Dopo aver confermato l'ordine, reindirizza l'utente alla pagina successiva
          this.$router.push({ name: 'PaginaSuccessiva' });
        })
        .catch(error => {
          console.error('Errore durante l\'aggiornamento dell\'ordine:', error.response.data);
          // Gestisci l'errore e fornisce feedback all'utente, se necessario
        });
    }
  },
  mounted() {
    // Decodifica i dati dell'ordine dai parametri di query nell'URL
    const orderData = JSON.parse(this.$route.query.orderData);

    // Assegna i dati dell'ordine alle variabili del componente
    this.orders = orderData.dishes;
    this.totalPrice = orderData.totalPrice;
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
            <label for="guestName">Nome:</label>
            <input type="text" id="guestName" v-model="guestName" required>
        </div>
        <div>
            <label for="guestAddress">Indirizzo:</label>
            <input type="text" id="guestAddress" v-model="guestAddress" required>
        </div>
        <div>
            <label for="guestEmail">Email:</label>
            <input type="email" id="guestEmail" v-model="guestEmail" required>
        </div>
        <button class="confirm-button" @click="confirmOrder">Conferma Pagamento</button>
      </form>
  </div>
</template>
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
