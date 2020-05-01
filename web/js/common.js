$(function() {

//slider

  let page = 1;
  let maxPage = $('.cell').length;

  $('.counter div:first-child').text(page);
  $('.counter  div:last-child').text(maxPage);

  $('.cell').each((k, v) => {
    $(v).attr('index', (k+1))
  });

  $('button.next').click(() => {
    if (page === 1) $('.cell[index=1]').css({'z-index': 'initial'});
    $('.cell[index=${page + 1}]').animate({left: '0'}, 700, function() {
      $('.cell:not(.cell[index=${page}]):not(.cell[index=${page - 1}])').css({'left': '-200%'})
    });

    page++;
    if (page > maxPage) {
      $('.cell[index=1]').css({'z-index': '2'});
      $('.cell[index=1]').animate({left: '0'}, 700, function() {
        $('.cell:not(.cell[index=1])').css({'left': '-200%'})
      });
      page = 1
    }
    $('.counter  div:first-child').text(page)
  });
//slider

//slick

  $('.block-slides').slick({
    prevArrow: $('.prev-slick'),
    nextArrow: $('.next-slick'),
  });

  let pages = 1;
  let maxPages = $('.production-items:not(.slick-cloned)').length;

  $('.counter-slick div:first-child div').text(appendZero(pages));
  $('.counter-slick div:last-child div').text(appendZero(maxPages));


  $('.next-slick').click(()=>{
    pages++;
    if (pages > maxPages) {
      pages = 1
    }
    $('.counter-slick  div:first-child div').text(appendZero(pages))
  });

  $('.prev-slick').click(()=>{
    pages--;
    if (pages < 1){
      pages = maxPages
    }
      $('.counter-slick div:first-child div').text(appendZero(pages))
      
  });


  $('.block-slides_article').slick({
      prevArrow: $('.prev-slider'),
      nextArrow: $('.next-slider'),
      slidesToShow: 3,
      slidesToScroll: 1,
      variableWidth: true,
      responsive: [
        {
          breakpoint: 1280,
          settings: {
            slidesToShow: 3,
            variableWidth: false
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            variableWidth: false
          }
        },
        {
          breakpoint: 800,
          settings: {
            slidesToShow: 1,
            variableWidth: false
          }
        }
      ]
  });


  $('.company-slider').slick({
      prevArrow: $('.prev-slider'),
      nextArrow: $('.next-slider'),
      slidesToShow: 3,
      slidesToScroll: 1,
      variableWidth: true,
      responsive: [
        {
          breakpoint: 1280,
          settings: {
            slidesToShow: 2,
            variableWidth: false
          }
        },
        {
          breakpoint: 533,
          settings: {
            slidesToShow: 1,
            variableWidth: false
          }
        }
      ]
  });

  $('.company-awards').slick({
    prevArrow: $('.prev-slick'),
    nextArrow: $('.next-slick'),
    slidesToShow: 1,
    slidesToScroll: 1,
    variableWidth: true,
    responsive: [
      {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
          variableWidth: false
        }
      },
      {
        breakpoint: 533,
        settings: {
          slidesToShow: 1,
          variableWidth: false
        }
      }
    ]
  });
//slick



  function appendZero(page){
    return page < 10 ? '0' + page : page
  }


  window.onscroll = function showHeader() {
    let header = document.querySelector('.fixed-menu');
    if(window.pageYOffset > 600){
        //$(`.fixed-container`).css({'display': 'block'})
      header.classList.remove('showno');
      header.classList.add('showyes');
    } else{
        //$(`.fixed-container`).css({'display': 'none'})
      header.classList.remove('showyes');
      header.classList.add('showno');
    }
  };


  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $('.page_up').fadeIn();
    } else {
      $('.page_up').fadeOut();
    }
  });
  $('.page_up').click(function () {
    $('body,html').animate({scrollTop: 0}, 400); return false;
  });

  var scrollbar = document.body.clientWidth - window.innerWidth + 'px';

  document.querySelector('[href="#openModal"]').addEventListener('click', function () {
    document.body.style.overflow = 'hidden';
    document.querySelector('#openModal').style.marginLeft = scrollbar;
  });
  document.querySelector('[href="#close"]').addEventListener('click', function () {
    document.body.style.overflow = 'visible';
    document.querySelector('#openModal').style.marginLeft = '0px';
  });

  $(function(){
    $("#phone").mask("+7(999) 999-9999");
  });

});


$('.inside-items').addClass("hidden_product").viewportChecker({
  classToAdd: 'visible_product animated fadeInUpBig',
  offset: 200
});


$('.js-hamburger').click(function() {
  $("body").toggleClass('menu-opened');
});