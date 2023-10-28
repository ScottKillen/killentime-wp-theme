window.addEventListener('scroll', function (e) {
  var brand = document.getElementById('nav-brand');
  if (document.getElementsByTagName('html')[0].scrollTop > 95) {
    brand.classList.remove('invisible');
    brand.classList.add('animate__fadeIn', 'animate__animated');
  } else {
    brand.classList.add('invisible');
    brand.classList.remove('animate__fadeIn', 'animate__animated');
  }
});
