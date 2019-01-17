import $ from 'jquery';

export function scrollTo(position) {
  const offsetdis = position || 0;
  $('html, body').animate({
    scrollTop: offsetdis,
  }, 500);
}

export default {
  scrollTo,
};
