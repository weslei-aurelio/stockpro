import '../scss/styles.scss';
import 'jquery-mask-plugin';
import * as bootstrap from 'bootstrap';

import flatpickr from 'flatpickr';
import 'flatpickr/dist/flatpickr.min.css';
import pt from 'flatpickr/dist/l10n/pt.js';

flatpickr.localize(pt);

window.bootstrap = bootstrap
import $ from 'jquery'
window.$ = window.jQuery = $;


$(function () {
    $('.money').mask('000.000.000.000.000,00', { reverse: true });
    $('.cpf').mask('000.000.000-00');
    $('.phone').mask('(00) 00000-0000');
    $('.percent').mask('0000000,00%', { reverse: true });

    flatpickr(".date-picker", {
        dateFormat: "d/m/Y",
        locale: pt.default,  // ponto essencial
    });
});

import setupProductMarginCalculation from './product-margin';

document.addEventListener('DOMContentLoaded', function () {
    // IDs devem ser os mesmos dos inputs nos seus forms
    setupProductMarginCalculation('purchaseValue', 'salePrice', 'profitMargin');

    // Campos do modal de edição
    const editModal = document.getElementById('EditProduct');
    if (editModal) {
        editModal.addEventListener('shown.bs.modal', function () {
            console.log('Modal Edit aberta!'); // ⚠️ debug
            setupProductMarginCalculation('editPurchaseValue', 'editSalePrice', 'editProfitMargin');
        });
    }

});

$(function(){
    flatpickr("#periodo", {
        mode: "range",
        locale: "pt",
        dateFormat: "d/m/Y",
        onValueUpdate: function(selectedDates, inputValue, flatpickrInstance, dayElem){
            if(selectedDates.length > 1){
                $('#form-search').trigger('submit');
            }
        },
    });
});

