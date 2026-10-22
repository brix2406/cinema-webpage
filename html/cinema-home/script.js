// Replace these with your own movie banners and titles.
const slides = [
  { image: "images/banner1.jpg", title: "Experience movies on the big screen" },
  { image: "images/banner2.jpg", title: "Discover this week's biggest releases" },
  { image: "images/banner3.jpg", title: "Find your next movie night" }
];
let currentSlide = 0;

function showSlide(index) {
  currentSlide = (index + slides.length) % slides.length;
  document.getElementById("hero-image").src = slides[currentSlide].image;
  document.getElementById("hero-title").textContent = slides[currentSlide].title;
}

document.getElementById("prev-slide").addEventListener("click", function () {
  showSlide(currentSlide - 1);
});
document.getElementById("next-slide").addEventListener("click", function () {
  showSlide(currentSlide + 1);
});
