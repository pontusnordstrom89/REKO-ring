var hejsan = document.getElementsByClassName("nav-wrapper");

window.addEventListener("scroll", (event) => {
    let scroll = this.scrollY;
    console.log(scroll)
    if(scroll > 100) {
        document.getElementById("nav").style.backgroundColor = "blue";
    }
    if(scroll <= 100) {
        document.getElementById("nav").style.backgroundColor = "red"
    }
});



