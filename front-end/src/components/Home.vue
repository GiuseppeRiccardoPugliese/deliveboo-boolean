<script>

export default {
    name: 'Home',
}

</script>

<template>

    <!-- sezione dedicata al jumbotron -->
    <div class="container-fluid">
        <div class="jumbotron">
            
                <div class="jumbo-title">
                    <span id="title-content"> I piatti che ami dove e quando vuoi </span>
                </div>
           
            
                <div class="advanced-search">
                    <div class="advanced-input">
                        <div>
                            <span> Dai un'occhiata ai ristoranti nella città di 
                                Milano <i class="fa-solid fa-location-dot"></i> 
                            </span>
                        </div>
                        
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
    padding: 0;

    .jumbotron {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        padding: 30px;
        background: linear-gradient(to right, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 100%);

        .jumbo-title {
            width: 50%;
            padding: 50px;
            display: flex;
            justify-content: center;
            animation: slideInFromRight 1.5s ease forwards;
            }

            span {
                color: white;
                font-size: 80px;
                font-weight: 600;
                text-shadow: 5px 5px 200px black;
            }

            .advanced-search {

                .advanced-input {

                    display: flex;
                    flex-direction: column;
                    align-items: center;

                    div {
                    
                        background-color: rgba(0, 0, 0, 0);
                        margin-bottom: 30px;

                        span {
                        font-size: 20px;
                        // color: #ae3f68;
                        }
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

    @keyframes slideInFromRight {
        0% {
            transform: translateX(100%);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

}

@media all and (min-width: 300px) and (max-width: 1024px) {

    .jumbotron{
        flex-direction: column;
    }

    .jumbo-title{
        width: 100%;
        align-items: center;
        text-align: center;
    
        #title-content {
        font-size: 40px;
    }
    }
   
        
}

@media all and (min-width: 1025px) and (max-width: 1320px) {

    .jumbotron {
        flex-direction: column;
    }

    .jumbo-title{
        width: 100%;
        align-items: center;
        padding: 10px;

        #title-content  {
        font-size: 40px;
        text-align: center;
    }
    }
    
        
}


</style>
