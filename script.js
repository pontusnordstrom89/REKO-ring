/**
 *  Materialize initialization
 */

$(document).ready(function () {
    $('.carousel').carousel();
    $('.tap-target').tapTarget();
    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown();
});

$('#orderButton').click(function () {

    $('#order-form').toggle();
})



