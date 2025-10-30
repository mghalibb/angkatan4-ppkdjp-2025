/* =================================
   Services Section Start
   ================================= */
const nav = document.querySelector('.navbar-transparent');
if (nav) {
  // Cek apakah navbar transparan ada di halaman ini
  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      nav.classList.add('scrolled');
      nav.classList.remove('navbar-dark');
    } else {
      nav.classList.remove('scrolled');
      nav.classList.add('navbar-dark');
    }
  });
}
/* =================================
   Services Section End
   ================================= */
