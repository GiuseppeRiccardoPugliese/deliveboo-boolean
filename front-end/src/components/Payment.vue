<script>
// npm install braintree-web
import * as braintreeDropin from 'braintree-web-drop-in';
import axios from "axios";

export default {
  name: "Payment",
  data() {
    return {
      totalPrice: 0,
      orderData: {
        restaurantIndex: "",
        restaurantId: "",
        price: 0,
        orders: [],
        guest_name: "",
        guest_address: "",
        guest_email: "",
        number_order: "",
      },
      braintreeInstance: null, // Memorizza l'istanza di Braintree
      buttonClicked: false,
    };
  },
  created() {
    setTimeout(() => {
      const storedData = JSON.parse(localStorage.getItem("orderData") || "{}");
      if (storedData.orderData) {
        this.orderData = storedData.orderData;
        this.totalPrice = storedData.orderData.price;
      }
      console.log('Contenuto di localStorage1:', storedData.orderData);

      // Controlla se il carrello è vuoto e torna indietro se necessario
      if (this.orderData.orders.length === 0) {
        this.$router.go(-1); // Torna alla pagina precedente
      }
    }, 500);
  },
  methods: {
    localStorage() {
      const dataToSave = {
        orderData: this.orderData,
      };
      localStorage.setItem("orderData", JSON.stringify(dataToSave));
    },

    sendData() {
      if (this.orderData.guest_name && this.orderData.guest_email && this.orderData.guest_address) {
        this.makeBtnPayment();
      }
    },

    makeDropIn() { //FUNZIONE PER GENERARE IL FORM PER INSERIRE I DATI DELLA CARTA
      braintreeDropin.create({
        authorization: 'sandbox_bntx9z5d_y9fkzm9y4q49xcj9',
        selector: '#dropin-container',
        locale: 'it_IT',
      }, (err, instance) => {
        if (err) {
          console.error('Error initializing Braintree:', err);
          return;
        }

        this.braintreeInstance = instance; // Assegna l'istanza appena creata a braintreeInstance
        this.makeBtnPayment();

      });
    },

    makeBtnPayment() { //FUNZIONE PER RECUPERARE L'ISTANZA AL CLICK DEL BOTTONE
      if (!this.braintreeInstance) {
        console.error('Braintree instance not initialized.');
        return;
      }
      let button = document.querySelector('#submit-button');
      button.addEventListener('click', () => {
        this.braintreeInstance.requestPaymentMethod((err, payload) => {
          if (err) {
            console.error('Error requesting payment method:', err);
            return;
          }
          let paymentMethodNonce = payload.nonce;
          this.makePayment(paymentMethodNonce);
        });
      });
    },

    makePayment(paymentMethodNonce) { //FUNZIONE PER IL PAGAMENTO
      if (this.orderData.orders && this.orderData.orders.length > 0) {
        const productIds = {};
        this.orderData.orders.forEach(order => {
          const { dishId, price } = order;
          if (productIds[dishId]) {
            productIds[dishId] += price;
          } else {
            productIds[dishId] = price;
          }
        });
        // Invia i dati al server per elaborare il pagamento
        axios.post('http://localhost:8000/api/make/payment', {
          token: paymentMethodNonce,
          product: productIds,
          _token: '{{ csrf_token() }}'
        })
          .then((response) => {
            let data = response.data;
            if (data.success) {
              const dataToSend = {
                price: this.totalPrice,
                guest_name: this.orderData.guest_name,
                guest_email: this.orderData.guest_email,
                guest_address: this.orderData.guest_address,
                product_name: this.orderData.orders.map(order => ({ id: order.dishId, quantity: order.quantity })),
                restaurant_id: this.orderData.restaurantId,
              };

              axios.post("http://127.0.0.1:8000/api/v1/orders", dataToSend)
                .then(response => {
                  // this.totalPrice = 0;
                  // this.orderData.restaurantIndex = "";
                  // this.orderData.restaurantId = "";
                  this.orderData.price = 0;
                  this.orderData.orders = [];
                  this.localStorage();
                  console.log('pagamento andato', dataToSend);
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
      } else {
        console.error('Nessun ordine trovato.');
      }
    },
    submitForm() {
      if (this.validateForm()) {
        this.buttonClicked = true;
        // Validazione allora
        this.sendData();
      }
    },
    validateForm() {
      console.log(this.orderData.guest_name);
      if (this.orderData.guest_name === null || this.orderData.guest_address === null || this.isValidEmail(this.orderData.guest_email) === null) {
        return false;
      }
      return true;
    },
    isValidEmail(email) {
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailPattern.test(email);
    },
    cancelOrder() {
      // Torna alla pagina precedente
      this.$router.go(-1);
    },
  },
  // watch: {
  //   orderData: {
  //     handler(newOrderData) {
  //       this.localStorage();
  //     },
  //     deep: true,
  //   },
  // },
  mounted() {
    this.makeDropIn();
    this.orderData.guest_name = "";
    this.orderData.guest_address = "";
    this.orderData.guest_email = "";
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
          <div v-for="(order, index) in orderData.orders" :key="index" class="order-item">
            <p><strong class="text-black-50">x{{ order.quantity }} |</strong> {{ order.name }} {{
            order.price.toFixed(2) }}€</p>
          </div>
        </div>
        <p class="order-total">Totale: {{ totalPrice.toFixed(2) }}€</p>
      </div>

      <!-- FORM CON DATI ESSENZIALI -->
      <div class="card-details">
        <form action="" @submit.prevent="submitForm()">

          <div class="form-group">
            <label for="guest_name">Nome:</label>
            <input type="text" class="form-control" id="guest_name" name="guest_name" v-model="orderData.guest_name">
            <div v-if="buttonClicked && !orderData.guest_name" style="color: red;">Il campo Nome è obbligatorio
            </div>
          </div>
          <div class="form-group">
            <label for="guest_address">Indirizzo:</label>
            <input type="text" class="form-control" id="guest_address" name="guest_address"
              v-model="orderData.guest_address">
            <div v-if="buttonClicked && !orderData.guest_address" style="color: red;">Il campo Indirizzo è obbligatorio
            </div>
          </div>
          <div class="form-group">
            <label for="guest_email">Email:</label>
            <input type="email" class="form-control" id="guest_email" name="guest_email"
              v-model="orderData.guest_email">
            <div v-if="buttonClicked && !isValidEmail(orderData.guest_email)" style="color: red;">Inserisci un indirizzo
              email valido</div>
          </div>

          <!-- DROPIN BRAINTREE PAYMENT -->
          <div id="dropin-container"></div>

          <div>
            <button class="confirm-button" id="submit-button" type="submit">Conferma e
              Paga</button>
          </div>
        </form>
      </div>

    </div>

    <div>
      <button class="confirm-button" id="submit-button" @click.prevent="sendData()" type="button">
        Conferma e Paga
      </button>
      <button class="cancel-button" @click.prevent="cancelOrder()" type="button">
        Annulla
      </button>

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
  background-color: #0d6efd;
  color: #fff;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  border: none;
  border-radius: 100px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.confirm-button:hover {
  background-color: #0037ff;
}

.cancel-button {
  margin-top: 0.5rem;
  display: block;
  width: 100%;
  padding: 12px 0;
  background-color: #ff5a5f;
  color: #fff;
  font-size: 18px;
  font-weight: bold;
  text-align: center;
  border: none;
  border-radius: 100px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.cancel-button:hover {
  background-color: #f82e34;
}
</style>
