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
      axios.put(`/api/orders/${orderId}`, orderData)
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
    <div>
      <!-- Aggiungi il markup HTML per visualizzare i dettagli dell'ordine e il pulsante per confermare l'ordine -->
      <h2>Riepilogo dell'ordine</h2>
      <p v-for="(order, index) in orders" :key="index">{{ order.name }} ({{ order.quantity }}) - {{ order.price }}€</p>
      <p>Totale: {{ totalPrice }}€</p>
      <button @click="confirmOrder">Conferma Ordine</button>
    </div>
  </template>

  
<style lang="scss">
    
</style>