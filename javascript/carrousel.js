// Replace these with your own movie banners and titles.
const slides = [
  { image: "../media/moviePosters/by_any_means.jpeg", title: "Experience movies on the big screen" },
  { image: "../media/moviePosters/digger.jpeg", title: "Discover this week's biggest releases" },
  { image: "../media/moviePosters/the_mage.jpeg", title: "Find your next movie night" }
];
let currentSlide = 0;

function showSlide(index) {
  'use strict';
  currentSlide = (index + slides.length) % slides.length;
  document.getElementById("hero-image").src = slides[currentSlide].image;
  document.getElementById("hero-title").textContent = slides[currentSlide].title;
}
function init() {
  document.getElementById("prev-slide").addEventListener("click", function () {
    showSlide(currentSlide - 1);
  });
  document.getElementById("next-slide").addEventListener("click", function () {
    showSlide(currentSlide + 1);
  });
}

init()