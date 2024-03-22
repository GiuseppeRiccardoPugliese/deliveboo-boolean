<template>
    <div class="thank-you">
        <div class="thank-you-content">
            <h1 class="thank-you-text">Grazie!</h1>
            <p class="sub-text">Il tuo ordine è stato completato con successo.</p>
            <div class="icon-container">
                <i class="fas fa-check-circle check-icon"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ThankYou",
};
</script>

<style lang="scss" scoped>
.thank-you {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background-color: #f9f9f9;
}

.thank-you-content {
    text-align: center;
}

.thank-you-text {
    font-size: 4.5rem;
    color: #4caf50;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.sub-text {
    margin-top: 20px;
    font-size: 1.8rem;
    color: #333;
}

.icon-container {
    margin-top: 40px;
}

.check-icon {
    font-size: 6rem;
    color: #4caf50;
    animation: bounce 1s ease-in-out infinite;
}

@keyframes bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-20px);
    }
}
</style>