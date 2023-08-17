window.addEventListener('scroll', function (e) {
  var brand = document.getElementById('brand');
  if (document.getElementsByTagName('html')[0].scrollTop > 200) {
    brand.classList.remove('d-none');
  } else {
    brand.classList.add('d-none');
  }
});
