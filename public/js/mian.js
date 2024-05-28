window.addEventListener('scroll', e => {
	document.documentElement.style.setProperty('--scrollTop', `${this.scrollY}px`) // Update method
})
gsap.registerPlugin(ScrollTrigger, ScrollSmoother)
ScrollSmoother.create({
	wrapper: '.wrapper',
	content: '.content'
})
function toggleMenu() {
    var siteNav = document.querySelector('.site-nav');
    var menuToggle = document.querySelector('.menu-toggle');

    if (siteNav.classList.contains('site-nav--open')) {
        siteNav.classList.remove('site-nav--open');
        menuToggle.classList.remove('open');
    } else {
        siteNav.classList.add('site-nav--open');
        menuToggle.classList.add('open');
    }
}

var menuToggleElement = document.querySelector('.menu-toggle');
menuToggleElement.addEventListener('click', toggleMenu);
;

let slideIndex = 0;
showSlides();

// Next-previous control
function nextSlide() {
  slideIndex++;
  showSlides();
  timer = _timer; // reset timer
}

function prevSlide() {
  slideIndex--;
  showSlides();
  timer = _timer;
}

// Thumbnail image controlls
function currentSlide(n) {
  slideIndex = n - 1;
  showSlides();
  timer = _timer;
}

function showSlides() {
  let slides = document.querySelectorAll(".mySlides");
  let dots = document.querySelectorAll(".dots");

  if (slideIndex > slides.length - 1) slideIndex = 0;
  if (slideIndex < 0) slideIndex = slides.length - 1;

  // hide all slides
  slides.forEach((slide) => {
    slide.style.display = "none";
  });

  // show one slide base on index number
  slides[slideIndex].style.display = "block";

  dots.forEach((dot) => {
    dot.classList.remove("active");
  });

  dots[slideIndex].classList.add("active");
}

// autoplay slides --------
let timer = 7; // sec
const _timer = timer;

// this function runs every 1 second
setInterval(() => {
  timer--;

  if (timer < 1) {
    nextSlide();
    timer = _timer; // reset timer
  }
}, 1000); // 1sec


function initMap(){
//Map options
var options = {
    center: {lat: -1.3093 ,lng:36.8125},
    zoom: 16
}

//New Map
map = new google.maps.Map(document.getElementById("map"), options);

//Marker
const marker = new google.maps.Marker({
    position:{lat: -1.3093 ,lng:36.8125},
    map:map
});
}
 // Function to close alert
        function closeAlert(element) {
            element.parentElement.style.display = 'none';
        }

        // Attach click event to close buttons
        document.querySelectorAll('.alert .close').forEach(function(element) {
            element.onclick = function() {
                closeAlert(this);
            };
        });

        // Auto close alerts after 5 seconds
        setTimeout(function() {
            document.querySelectorAll('.alert').forEach(function(element) {
                element.style.display = 'none';
            });
        }, 5000);


 document.getElementById('password').addEventListener('input', function () {
        const password = this.value;
        const lengthRequirement = document.getElementById('length');
        const specialRequirement = document.getElementById('special');

        // Check password length
        if (password.length >= 8) {
            lengthRequirement.classList.add('valid');
        } else {
            lengthRequirement.classList.remove('valid');
        }

        // Check for special character
        const specialCharPattern = /[!@#$%^&*(),.?":{}|<>]/;
        if (specialCharPattern.test(password)) {
            specialRequirement.classList.add('valid');
        } else {
            specialRequirement.classList.remove('valid');
        }
    });
