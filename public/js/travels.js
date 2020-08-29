var logo = document.getElementsByClassName('sticky-offset-logo');
var sidebar = document.getElementsByClassName('list-group');
var actionbutton = document.getElementsByClassName('floating-ab');


window.onscroll = function (e) {  
  if(window.scrollY > 50){
    logo[0].style.display = 'block';
    sidebar[0].style.display = 'block';
    actionbutton[0].style.display = 'block';
  } else {
    logo[0].style.display = 'none';
    sidebar[0].style.display = 'none';
    actionbutton[0].style.display = 'none';
  }
} 