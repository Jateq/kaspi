document.addEventListener('DOMContentLoaded', function() {
  var labels = document.querySelectorAll('.navbar-title');
  var tooltips = document.querySelectorAll('.tooltip-content');
  var timers = {};

  labels.forEach(function(label, index) {
    var tooltip = tooltips[index];
    var labelId = label.id;

    label.addEventListener('mouseenter', function() {
      clearTimeout(timers[labelId]);
      closeAllTooltips();
      tooltip.style.display = 'block';
    });

    label.addEventListener('mouseleave', function() {
      startCloseTimer(labelId);
    });

    tooltip.addEventListener('mouseenter', function() {
      clearTimeout(timers[labelId]);
    });

    tooltip.addEventListener('mouseleave', function() {
      startCloseTimer(labelId);
    });
  });

  function startCloseTimer(id) {
    timers[id] = setTimeout(function() {
      closeAllTooltips();
    }, 200);
  }

  function closeAllTooltips() {
    tooltips.forEach(function(tooltip) {
      tooltip.style.display = 'none';
    });
  }
});

// const slider = document.querySelector('.sample-slider');

// const swiper = new Swiper(slider, {
//     loop: true,
//     speed: 2000,
//     slidesPerView: 3,
//     autoplay: {
//         delay: 0,
//         pauseOnMouseEnter: true,
//         disableOnInteraction: true,
//         reverseDirection: false,
//     },
// });

// slider.addEventListener('mouseenter', () => {
//     swiper.autoplay.stop();
// });

// slider.addEventListener('mouseleave', () => {
//     swiper.autoplay.start();
// });

const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  loop: true,
  slidesPerView: 3,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});