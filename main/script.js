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



var swiper = new Swiper('.swiper', {
  
  direction: 'horizontal',
  loop: true,
  slidesPerView: 5,

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

});

