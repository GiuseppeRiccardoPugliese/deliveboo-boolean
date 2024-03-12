<script>

export default {
    name: 'Home',
}

</script>

<template>
    <div class="container-fluid">
        <div class="jumbotron">
            <div class="jumbo-title">
                <span> I PIATTI CHE AMI DOVE E QUANDO VUOI </span>
            </div>
            <div class="advanced-search">
                <div class="input-group">
                    <input type="text" placeholder="Inserisci la tua città..">
                    <button type="button"> Cerca </button>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped lang="scss">
    .container-fluid {
       width: 100%;
       height: 500px;
       background-image: url(../../public/img/jumbotron1.jpg);
       background-size: cover;

       .jumbotron {

            span {
                color: white;
                font-size: 30px;
            }

            .advanced-search {

                button {
                    border-radius: 100px;
                    padding: 16px 40px;
                }
            }
       }
       
    }


</style>
