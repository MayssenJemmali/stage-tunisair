window.onload = function () {
  const loadingAnimation = document.querySelector(".loading-animation");
  const pageContent = document.querySelector(".page-content");

  loadingAnimation.style.display = "none";
  pageContent.style.display = "block";
};

/* const randomValue = Math.random();

// Determine the delay based on the random value
let randomDelay;
if (randomValue < 0.8) {
  // 80% chance for shorter delay (0 to 0.8 seconds)
  randomDelay = randomValue * 800;
} else {
  randomDelay = 800 + (randomValue - 0.8) * 400;
}

setTimeout(() => {
  const loadingAnimation = document.querySelector(".loading-animation");
  const pageContent = document.querySelector(".page-content");

  loadingAnimation.style.display = "none";

  pageContent.style.display = "block";
}, randomDelay);
 */
