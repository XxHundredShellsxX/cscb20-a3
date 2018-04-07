function toggleLinks() {
  document.getElementById("course-links").classList.toggle("open")
}

function toggleNotifications() {
  document.getElementById("messages").classList.toggle("show")
}

function toggleMenu() {
  document.getElementsByTagName("nav")[0].classList.toggle("show")
  document.getElementsByTagName("body")[0].classList.toggle("no-scroll")
}