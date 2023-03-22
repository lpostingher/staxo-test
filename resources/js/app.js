import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import jQuery from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.min.js';

import 'jquery-mask-plugin';

$(function () {
    $('.money').mask('000,000,000,000.00', { reverse: true });
});