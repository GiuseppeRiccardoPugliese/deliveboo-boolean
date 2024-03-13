<script>

export default {
    name: 'Home',
}

</script>

<template>

    <!-- sezione dedicata al jumbotron -->
    <div class="container-fluid">
        <div class="jumbotron">
            <div class="col-6 jumbo-title">
                <span> I piatti che ami dove e quando vuoi </span>
            </div>
            <div class="col-6 advanced-search">
                <div class="advanced-input">
                    <input type="text" placeholder="Inserisci la tua città..">
                    <!-- La rotta che tramite il cerca porta ai ristoranti -->
                    <router-link :to="{ name: 'Restaurants' }" class="cerca">
                        <a> <button type="button"> Cerca </button> </a>
                    </router-link>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped lang="scss">
@use '../style/partials/variables' as *;

.container-fluid {
    width: 100%;
    height: 500px;
    background-image: url(../../public/img/jumbotron2.jpg);
    background-size: cover;


    .jumbotron {

        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        padding: 30px;

        .jumbo-title {
            display: flex;
            align-items: center;
            padding: 50px;

                display: flex;
                justify-content: center;
                background-color: rgba(0, 0, 0, 0);
            }

            span {
                color: white;
                font-size: 90px;
                font-weight: 600;
                text-shadow: 5px 5px 200px black;
            }

            .advanced-search {

                .advanced-input {

                    display: flex;
                    justify-content: center;
              
                    input {
                        border-radius: 100px;
                        width: 400px;
                        padding-left: 30px;
                        height: 50px;
                        margin: 0;
                        font-size: 16px;
                        margin-right: 10px;
                        border: none;
                    }

                    button {
                        border-radius: 100px;
                        padding: 12px 37px;
                        color: #fff;
                        background: #00ccbc;
                        border: none;
                        font-weight: 400;
                    }

                input {
                    border-radius: 100px;
                    width: 400px;
                    padding-left: 30px;
                    height: 50px;
                    margin: 0;
                    font-size: 16px;
                    margin-right: 10px;
                    border: none;
                }

                button {
                    border-radius: 100px;
                    padding: 12px 37px;
                    color: #fff;
                    background: $btn_color;
                    border: none;
                    font-weight: 400;
                }

            }
        }
    }

}
</style>
