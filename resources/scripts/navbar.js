var open = false;

$(".menu-btn").on("click", function () {
  if (!open) {
    $(".overlay").fadeIn("slow");
    $("body").toggleClass("no-scroll");
  } else {
    $(".overlay").fadeOut("slow");
    $("body").toggleClass("no-scroll");
  }

  $(".menu-btn").toggleClass("open");
  $(".menu-btn__burger").toggleClass("color");
  open = !open;
});

