var open = false;

$(".menu-btn").on("click", function () {
  if (!open) {
    $(".overlay").fadeIn("slow");
  } else {
    $(".overlay").fadeOut("slow");
  }

  $(".menu-btn").toggleClass("open");
  $(".menu-btn__burger").toggleClass("color");
  open = !open;
});
