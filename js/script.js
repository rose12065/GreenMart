(function($) {

  "use strict";

  var initPreloader = function() {
    $(document).ready(function($) {
    var Body = $('body');
        Body.addClass('preloader-site');
    });
    $(window).load(function() {
        $('.preloader-wrapper').fadeOut();
        $('body').removeClass('preloader-site');
    });
  }

  // init Chocolat light box
	var initChocolat = function() {
		Chocolat(document.querySelectorAll('.image-link'), {
		  imageSize: 'contain',
		  loop: true,
		})
	}

  var initSwiper = function() {

    var swiper = new Swiper(".main-swiper", {
      speed: 500,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });

    var category_swiper = new Swiper(".category-carousel", {
      slidesPerView: 6,
      spaceBetween: 30,
      speed: 500,
      navigation: {
        nextEl: ".category-carousel-next",
        prevEl: ".category-carousel-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        991: {
          slidesPerView: 4,
        },
        1500: {
          slidesPerView: 6,
        },
      }
    });

    var brand_swiper = new Swiper(".brand-carousel", {
      slidesPerView: 4,
      spaceBetween: 30,
      speed: 500,
      navigation: {
        nextEl: ".brand-carousel-next",
        prevEl: ".brand-carousel-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 2,
        },
        991: {
          slidesPerView: 3,
        },
        1500: {
          slidesPerView: 4,
        },
      }
    });

    var products_swiper = new Swiper(".products-carousel", {
      slidesPerView: 5,
      spaceBetween: 30,
      speed: 500,
      navigation: {
        nextEl: ".products-carousel-next",
        prevEl: ".products-carousel-prev",
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        991: {
          slidesPerView: 4,
        },
        1500: {
          slidesPerView: 6,
        },
      }
    });
  }

  var initProductQty = function(){

    $('.product-qty').each(function(){

      var $el_product = $(this);
      var quantity = 0;

      $el_product.find('.quantity-right-plus').click(function(e){
          e.preventDefault();
          var quantity = parseInt($el_product.find('#quantity').val());
          $el_product.find('#quantity').val(quantity + 1);
      });

      $el_product.find('.quantity-left-minus').click(function(e){
          e.preventDefault();
          var quantity = parseInt($el_product.find('#quantity').val());
          if(quantity>0){
            $el_product.find('#quantity').val(quantity - 1);
          }
      });

    });

  }

  // init jarallax parallax
  var initJarallax = function() {
    jarallax(document.querySelectorAll(".jarallax"));

    jarallax(document.querySelectorAll(".jarallax-keep-img"), {
      keepImg: true,
    });
  }

  // document ready
  $(document).ready(function() {
    
    initPreloader();
    initSwiper();
    initProductQty();
    initJarallax();
    initChocolat();

  }); // End of a document

})(jQuery);















function validateName() {
  var letters = /^[A-Za-z]+$/;
  var regex=/^\s/;
  var name= document.getElementById("uname");
  var lblError = document.getElementById("lblErrorName");    
  if(name.value.match(regex))
    {
      lblError.innerHTML="";
     
      return false;
    }   
    if(name.value.match(letters))
    {
      lblError.innerHTML="";
      
      return true;
    }
   
      lblError.innerHTML="Name field required only alphabet characters";
      
      return false;
    
}

function validateEmail(){
  var email= document.getElementById("email").value; 
  var lblError = document.getElementById("lblErrorEmail");
    lblError.innerHTML = "";
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
   if(email==""){
    lblError.innerHTML="Email is required";
    
    return false;
   }
   if (!expr.test(email)) {
        lblError.innerHTML = "Invalid email address.";
        
        return false;
    }
  
      lblError.innerHTML="";
      
      return true;
    
}

function validatePassword(){
  var pwd= document.getElementById("pwd").value;
  var lblError = document.getElementById("lblErrorPass");
        pattern= /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;
         if(pwd==" ")
        {
            lblError.innerHTML="Please enter Password";
           
            return false;
        }
        if(!pattern.test(pwd))
        {
          lblError.innerHTML="Feild should conatin one special charater and one number";
          
          return false;
        }
         if(document.getElementById("pwd").value.length < 6)
        {
          lblError.innerHTML="Password minimum length is 6 ";
         
          return false;
        }
         if(document.getElementById("pwd").value.length > 12)
        {
          lblError.innerHTML="Password max length is 12";
          
          return false;
        }
        
          lblError.innerHTML=" ";
          
          return true;
        
}
function validateRepeatPassword(){
  var pwd= document.getElementById("pwd").value;
  var rpwd= document.getElementById("repeat-pwd").value;
  var lblError = document.getElementById("lblErrorRepeatPass");
  if(rpwd==""){
    lblError.innerHTML="Enter confirm password";
   
    return false;
  }
   if(pwd!=rpwd){
    lblError.innerHTML="Password not matched";
    
    return false;
  }
  
    lblError.innerHTML=" ";
   
    return true;
  
}

function validateRegister(){
  if (valid=true){
    window.confirm('Login succsesful');
  }
  if(window.confirm('Login succsesful'))
              {
              window.location.href='login.html';
              header("Location: login.html");
              };
}
