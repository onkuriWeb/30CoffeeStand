// header
window.addEventListener('load', function() {
  const headerButton = document.querySelector('.js-header-button');
  const headerNav = document.querySelector('.js-header-nav');

  headerButton.addEventListener('click', function(){
    this.classList.toggle('is-open');
    headerNav.classList.toggle('is-open');
  })
});

// smoothscroll
const headerHeight = document.querySelector('header').offsetHeight;
const headerButton = document.querySelector('.js-header-button');
const headerNav = document.querySelector('.js-header-nav');

document.querySelectorAll('a[href*="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();

    const href = anchor.getAttribute('href');
    const id = href.substring(href.indexOf("#"));
    const target = document.getElementById(id.replace('#', ''));
    const targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight;

    window.scrollTo({
      top: targetPosition,
      behavior: 'smooth'
    });

    headerButton.classList.remove('is-open');
    headerNav.classList.remove('is-open');
  });
});