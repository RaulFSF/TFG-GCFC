import Alpine from 'alpinejs'
import Focus from '@alpinejs/focus'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import { tns } from "/node_modules/tiny-slider/src/tiny-slider"


Alpine.plugin(Focus)
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)

window.Alpine = Alpine

Alpine.start()

document.addEventListener('DOMContentLoaded', function () {

    var prevButton = document.getElementById('prev-button');
    var nextButton = document.getElementById('next-button');

    if (document.querySelector('.ratingSlider')) {
        var slider = tns({
            container: '.ratingSlider',
            slideBy: "page",
            items: 4,
            mouseDrag: true,
            swipeAngle: false,
            speed: 400,
            nav: false,
            controls:false,
            arrowKeys: true,
            autoHeight: true,
            prevButton: prevButton,
            nextButton: nextButton,
            loop: false,
            gutter: 30,
            edgePadding: 10,
        });
    }

    if (document.querySelector('.ratingSliderMobile')) {
        var slider = tns({
            container: '.ratingSliderMobile',
            slideBy: "page",
            items: 1,
            mouseDrag: true,
            swipeAngle: false,
            speed: 400,
            arrowKeys: true,
            autoHeight: true,
            controls: false,
            loop: false,
            preventScrollOnTouch: 'auto',
            gutter: 30,
            nav: false,
            edgePadding: 10,
        });
    }
});
