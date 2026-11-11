  
  //1- preload
  window.onload = function() {
    const preload = document.querySelector('.preload');
    preload.style.display = 'none';
  };
  


var swiper = new Swiper(".mySwiper", {
    loop: true, 
    autoplay: {
      delay: 2000, 
      disableOnInteraction: false, 
    },
    effect: "fade", 
    fadeEffect: {
    //   crossFade: true, 
    },
    speed: 1000, 
    pagination: {
      el: ".swiper-pagination",
      clickable: true, 
    },
  });



  new Swiper(".reviewsSlider", {
    navigation: {
      nextEl: ".rightArrow",
      prevEl: ".leftArrow",
    },
  
    scrollbar: {
      el: ".swiper-scrollbar",
      draggable: true,
    },
  
    autoplay: {
      delay: 1000,  
      disableOnInteraction: false, 
    },
  
    loop: true,  
  
    slidesPerView: 1,  
  
    spaceBetween: 10, 
  
    freeMode: {
      enabled: true,
      sticky: true,
    },
  
    breakpoints: {
      "@1.50": {
        slidesPerView: 5,
        spaceBetween: 0,
      },
    },
  });
