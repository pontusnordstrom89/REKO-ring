var elem = document.querySelector(".collapsible.expandable");
var instance = M.Collapsible.init(elem, {
  accordion: false,
});

$(".collapsible-header").click(function (event) {
  const value = event.currentTarget.children[1].innerHTML;

  if (value === "add") {
    event.currentTarget.children[1].innerHTML = "remove";
    event.target.classList.remove("collapsible-closed");
  }
  if (value === "remove") {
    event.currentTarget.children[1].innerHTML = "add";
    event.target.classList.add("collapsible-closed");
  }
});
