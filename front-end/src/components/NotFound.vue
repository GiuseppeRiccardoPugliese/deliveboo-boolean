<template>
    <div class="not-found-container">
        <h1>Oops!</h1>
        <img class="not-found-img" src="https://media1.tenor.com/m/tQebrdlEGnIAAAAC/error-404-404.gif"
            alt="NotFound Img">
        <p>La pagina che stai cercando non è disponibile.</p>
        <router-link to="/restaurants" class="back-restaurants-link">Torna ai ristoranti</router-link>
    </div>
</template>

<script>
export default {
    name: "NotFound",
};
</script>

<style lang="scss" scoped>
@use '../style/partials/variables' as *;

.not-found-container {
    text-align: center;
    margin-top: 50px;

    h1 {
        font-size: 48px;
        color: #fc0000;
    }

    .not-found-img {
        width: 300px;
        height: auto;
        margin: 20px auto;
    }

    p {
        font-size: 24px;
        color: #555;
    }
}

.back-restaurants-link {
    display: inline-block;
    margin: 20px;
    padding: 10px 20px;
    background-color: #fc0000;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.back-restaurants-link:hover {
    background-color: $btn_color;
}
</style>