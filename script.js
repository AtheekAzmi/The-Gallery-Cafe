// Get the modal and button elements
const modal = document.getElementById('story-modal');
const btn = document.getElementById('learn-more-btn');
const span = document.getElementsByClassName('close')[0];

// Add event listener to the button to open the modal
btn.onclick = function() {
  modal.style.display = 'block';
}

// Add event listener to the close button to close the modal
span.onclick = function() {
  modal.style.display = 'none';
}

// Add event listener to the window to close the modal when clicked outside
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = 'none';
  }
}



const sliderInner = document.querySelector('.slider-inner');
const sliderNav = document.querySelector('.slider-nav');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
const eventSlides = document.querySelectorAll('.event-slide');

let currentSlide = 0;

prevButton.addEventListener('click', () => {
  currentSlide--;
  updateSlider();
});

nextButton.addEventListener('click', () => {
  currentSlide++;
  updateSlider();
});

function updateSlider() {
  const translateX = currentSlide * -100 + '%';
  sliderInner.style.transform = `translateX(${translateX})`;
  if (currentSlide === 0) {
    prevButton.disabled = true;
  } else {
    prevButton.disabled = false;
  }
  if (currentSlide === eventSlides.length - 1) {
    nextButton.disabled = true;
  } else {
    nextButton.disabled = false;
  }
}

updateSlider();

// login 
