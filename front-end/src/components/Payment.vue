<script>
// @ts-ignore
import axios from "axios";

// @ts-ignore
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
        // product_name: [], // Aggiunto array per memorizzare i nomi dei prodotti
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
        price: this.totalPrice,
        guest_name: this.orderData.guest_name,
        guest_address: this.orderData.guest_address,
        guest_email: this.orderData.guest_email,
        restaurant_id: this.orderData.restaurantId,

        orders: this.orders,
        totalPrice: this.totalPrice,
        orderData: this.orderData,

        product_name: this.orders.map(order => order.name), // Array di nomi dei prodotti
      };

      // Salva gli elementi nel localStorage
      localStorage.setItem("cartData", JSON.stringify(dataToSave));
    },
    sendData() {
      event.preventDefault();
      console.log("Dati prima dell'invio:", this.orderData);
      // this.errorsValidation();
      if (
        this.orderData.guest_name &&
        this.orderData.guest_email &&
        this.orderData.guest_address
      ) {
        // Chiamata al metodo per salvare i dati nel localStorage
        this.localStorage();
        this.makeDropIn();
      }
    },

    makeDropIn() { //DropIn Pagamento BrainTree
      var button = document.querySelector('#submit-button');

      // @ts-ignore
      braintree.dropin.create({
        authorization: 'sandbox_bntx9z5d_y9fkzm9y4q49xcj9',
        selector: '#dropin-container',
        locale: 'it_IT',
      }, (err, instance) => {
        if (err) {
          console.error('Error initializing Braintree:', err);
          return;
        }

        button.addEventListener('click', () => {
          instance.requestPaymentMethod((err, payload) => {
            if (err) {
              console.error('Error requesting payment method:', err);
              return;
            }

            // Ottieni il nonce del pagamento e invia il pagamento al server
            var paymentMethodNonce = payload.nonce;
            this.makePayment(paymentMethodNonce); // Utilizza "this" per accedere alla funzione makePayment
          });
        });
      });
    },


    makePayment(paymentMethodNonce) { //FUNZIONE PER IL PAGAMENTO
      const storedData = JSON.parse(localStorage.getItem("cartData") || "{}");
      const orders = storedData.orders || [];

      const productIds = {};

      orders.forEach(order => {
        const { dishId, price } = order;
        // Se l'ID del piatto è già presente, aggiungi il prezzo al totale
        // Altrimenti, crea una nuova voce nell'oggetto
        if (productIds[dishId]) {
          productIds[dishId] += price;
        } else {
          productIds[dishId] = price;
        }
      });

      console.log(productIds);
      // Invia i dati al server per elaborare il pagamento
      axios.post('http://localhost:8000/api/make/payment', {
        token: paymentMethodNonce,
        product: productIds,
        _token: '{{ csrf_token() }}'
      })

        .then((response) => {
          var data = response.data;
          if (data.success) {
            console.log('pagamento andato');
            console.log(orders)
            const dataToSend = {
              price: this.totalPrice,
              guest_name: this.orderData.guest_name,
              guest_email: this.orderData.guest_email,
              guest_address: this.orderData.guest_address,
              product_name: this.orders.map(order => order.name), // Array di nomi dei prodotti
              restaurant_id: this.orderData.restaurantId,
            };
            axios.post("http://127.0.0.1:8000/api/v1/orders", dataToSend)
              .then(response => {
                console.log("Ordine inviato con successo:", response.data);
                // Esegui il routing alla pagina di conferma dell'ordine
                this.$router.push({ name: 'ThankYou' });
              })
              .catch(error => {
                console.error("Errore durante l'invio dell'ordine:", error);
                // Gestisci l'errore in base alle tue esigenze
              });
          } else {
            alert(data.message); // Mostra un messaggio di errore
          }
        })
        .catch((error) => {
          console.error('Errore durante la richiesta:', error);
        });
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
    this.makeDropIn();
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


    <div class="my-container">
      <!-- DETTAGLI ORDINE -->
      <div class="order-details">
        <h2 class="order-title">Riepilogo dell'ordine</h2>
        <div class="order-items">
          <div v-for="(order, index) in orders" :key="index" class="order-item">
            <p>{{ order.name }} ({{ order.quantity }}) - {{ order.price.toFixed(2) }}€</p>
          </div>
        </div>
        <p class="order-total">Totale: {{ totalPrice.toFixed(2) }}€</p>
      </div>

      <!-- FORM CON DATI ESSENZIALI -->
      <div class="card-details">
        <form action="">

          <div class="form-group">
            <label for="guest_name">Nome:</label>
            <input type="text" class="form-control" id="guest_name" name="guest_name" v-model="orderData.guest_name"
              required>
          </div>
          <div class="form-group">
            <label for="guest_address">Indirizzo:</label>
            <input type="text" class="form-control" id="guest_address" name="guest_address"
              v-model="orderData.guest_address" required>
          </div>
          <div class="form-group">
            <label for="guest_email">Email:</label>
            <input type="email" class="form-control" id="guest_email" name="guest_email" v-model="orderData.guest_email"
              required>
          </div>

          <!-- DROPIN BRAINTREE PAYMENT -->
          <div id="dropin-container"></div>

        </form>
      </div>
    </div>


    <div>
      <button class="confirm-button" id="submit-button" @click="sendData()">Conferma e Paga</button>
    </div>






  </div>

</template>


<style lang="scss">
.order-card {

  max-width: 800px;
  margin: 2rem auto;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;

  .my-container {
    display: flex;
    justify-content: space-around;
    // align-items: center;
  }
}

.order-details {
  width: 45%;
  margin-bottom: 20px;
}

.card-details {
  width: 45%;
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
