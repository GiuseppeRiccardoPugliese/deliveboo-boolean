<script>
//swiper
import { Swiper, SwiperSlide } from "swiper/vue";

import "swiper/css";

import "swiper/css/pagination";
import "swiper/css/navigation";

import { Autoplay, Pagination, Navigation } from "swiper/modules";

export default {
    name: "Carousel",
    components: {
        Swiper,
        SwiperSlide,
    },

    setup() {
        return {
            modules: [Autoplay, Pagination, Navigation],
        };
    },
};
</script>
<template>
    <div class="carousel-container">
        <swiper
            :spaceBetween="30"
            :centeredSlides="true"
            :autoplay="{
                delay: 2500,
                disableOnInteraction: false,
            }"
            :slidesPerView="4"
            :loop="true"
            :navigation="true"
            :modules="modules"
            :breakpoints="{
                '400': {
                    slidesPerView: 1,
                    spaceBetween: 0
                },
                '800': {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                '1300': {
                    slidesPerView: 4,
                    spaceBetween: 0,
                },
            }"
            class="mySwiper my-4"
        >
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img00.jpg" alt="" />
                <span>Pizzeria Bella Napoli</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img01.jpg" alt="" />
                <span>Ristorante La Trattoria</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img02.jpg" alt="" />
                <span>Ristorante Sushiya</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img03.jpg" alt="" />
                <span>Ristorante La Dolce Vita</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img04.jpg" alt="" />
                <span>Ristorante La Trattoria</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img05.jpg" alt="" />
                <span>Ristorante Da Mario</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img06.jpg" alt="" />
                <span>Ristorante Il Giardino</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img07.jpg" alt="" />
                <span>Ristorante Il Gabbiano</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img08.jpg" alt="" />
                <span>Ristorante Sapore di Mare</span>
            </swiper-slide>
            <swiper-slide
                class="d-flex flex-column justify-content-center align-items-center"
            >
                <img src="../../public/img/img09.jpg" alt="" />
                <span>Ristorante Buon Gusto</span>
            </swiper-slide>
        </swiper>
    </div>
</template>
<style lang="scss" scoped>
img {
    width: 300px;
    height: 200px;
    border-radius: 20px;
}

.carousel-container {
    height: 100%;
}

@media screen and (max-width: 900px) {
    img {
        width: 100%;
        height: 100%;
    }
}

@media screen and (min-width: 1400px) {
    img {
        width: 300px;
        height: 200px;
        margin-left: 20px;
        margin-right: 20px;
    }
}
</style>
