
import '../scss/styles.scss';
import 'jquery-mask-plugin';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap

import $ from 'jquery'
window.$ = window.jQuery = $;

$(function () {
    $('.money').mask('000.000.000.000.000,00', { reverse: true });
    $('.cpf').mask('000.000.000-00');
    $('.phone').mask('(00) 00000-0000');
    $('.percent').mask('0000000,00%', { reverse: true });
});
