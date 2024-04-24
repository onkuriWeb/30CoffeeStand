// display header
function displayHeader() {
  const frontHeader = document.querySelector('.js-front-header');
  const mediaQuery = window.matchMedia('(min-width: 960px)');

  const checkMediaQuery = (mq) => {
    if (mq.matches) {
      const scroll = window.scrollY;
  
      if( scroll > 800) {
        frontHeader.classList.add('is-display');
        } else {
        frontHeader.classList.remove('is-display');
      }
    }
  1}
  checkMediaQuery(mediaQuery);
 
  mediaQuery.addEventListener('change', checkMediaQuery);
};

window.addEventListener('scroll', displayHeader);
window.addEventListener('load', displayHeader);

// menu nav
const ACTIVE_CLASS_NAME = 'is-active';
const buttons = document.querySelectorAll('.p-front-menu__nav-link');
const buttonArea = document.querySelector('.p-front-menu__nav-list');

buttons.forEach(button => {
  let options = {
    // root: document.querySelector('.p-front-menu__nav-list'),
    rootMargin: "-50% 0px",
    threshold: 0
  };
  const target = document.querySelector(button.getAttribute('href'));
  const observer = new IntersectionObserver(([{isIntersecting}]) => {
    if (isIntersecting) {
      buttons.forEach(el => el.classList.remove(ACTIVE_CLASS_NAME));
      button.classList.add(ACTIVE_CLASS_NAME);
    }
  }, options);
  observer.observe(target);
})