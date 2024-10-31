const darkmodeToggle = document.getElementById('darkmode-toggle');

darkmodeToggle.addEventListener('click', () => {
  document.body.classList.toggle('darkmode');
});