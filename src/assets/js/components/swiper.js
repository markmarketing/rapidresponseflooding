import Swiper, {
    Navigation,
    Pagination,
    Scrollbar,
    Autoplay,
    Mousewheel,
    Keyboard,
    Parallax,
    Lazy,
    EffectFade,
    Thumbs,
    Controller,
  } from 'swiper';


Swiper.use([Navigation, Pagination, Scrollbar, Autoplay, Mousewheel, Keyboard, Parallax, Lazy, EffectFade, Thumbs, Controller]);

(function() {
    document.addEventListener('DOMContentLoaded', () => {

        const swipers = document.querySelectorAll('[data-swiper]');

        swipers.forEach((elem) => {
            let options = elem.dataset.swiper ? JSON.parse(elem.dataset.swiper) : {};
            new Swiper(elem,options);

        });

    });
})();