/**
 *  Materialize initialization
 */

$(document).ready(function () {
    $('.carousel').carousel();
    $('.tap-target').tapTarget();

});

$('#orderButton').click(function() {

    $('#order-form').toggle();
})


