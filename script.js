/**
 *  Materialize initialization
 */

$(document).ready(function () {
    $('.carousel').carousel();
    $('.tap-target').tapTarget();
    $('.sidenav').sidenav();
});

$('#orderButton').click(function() {

    $('#order-form').toggle();
})
