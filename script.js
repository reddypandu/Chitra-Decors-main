const btn = document.querySelector(".nav-item.drop-down");
const btn2 = document.querySelector(".nav-link");
btn.addEventListener("click", () => {
  btn.classList.toggle("active");
  // btn2.classList.remove("active");
});
const btn1 = document.querySelector("li.drop-down1");
btn1.addEventListener("click", () => {
  btn1.classList.toggle("active");
  btn.classList.remove("active");
});
window.onscroll = function () {
  scrollFunction();
};
function scrollFunction() {
  var header = document.getElementById("header_section");

  // Add the "fixed" class to the header when scrolled 200px down
  if (
    document.body.scrollTop > 100 ||
    document.documentElement.scrollTop > 100
  ) {
    header.classList.add("fixed");
  } else {
    // Remove the "fixed" class when scrolled back to the top
    header.classList.remove("fixed");
  }
}
