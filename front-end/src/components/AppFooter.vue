<script>

export default {
    name: 'AppFooter',
}

</script>

<template>
    <div class="container-fluid">
        <div class="footer">
            <div class="icone-social">
                <a href="https://www.facebook.com/?locale=it_IT"> <i class="fa-brands fa-facebook"></i> </a>
                <a href="https://www.instagram.com/"> <i class="fa-brands fa-instagram"></i> </a>
                <a href="https://twitter.com/?lang=it"> <i class="fa-brands fa-twitter"></i> </a>
                <a href="https://www.tiktok.com/login?redirect_url=https%3A%2F%2Fwww.tiktok.com%2Fit-IT%2F&lang=en&enter_method=mandatory"> <i class="fa-brands fa-tiktok"></i> </a>
            </div>

            <span>
                © 2024 Deliveboo
            </span>
        </div>
    </div>
</template>

<style scoped lang="scss">

.container-fluid {
    width: 100%;
    background-color: #2e3333;
    // z-index: 1000;

    .footer {
        width: 80%;
        height: 60px;
        margin: 0 auto;
        display: flex;
        color: white;
        justify-content: space-between;
        align-items: center;

        i {
            padding: 5px;
            color: white;
        }
    }



}


</style>
