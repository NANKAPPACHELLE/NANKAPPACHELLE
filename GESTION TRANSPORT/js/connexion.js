//Materialize Initialization ///////////
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".sidenav");
  var instances = M.Sidenav.init(elems, options);
});

// Authentification //////////
function connex() {
  var user = document.getElementById("user");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  const success = document.getElementById("success");
  const danger = document.getElementById("danger");
  if (email.value === "" || password.value === "" || user.value === "") {
    danger.style.display = "block";
  } else {
    setTimeout(() => {
      email.value = "";
      password.value = "";
      user.value = "";
    }, 2000);
    danger.style.display = "none";
    success.style.display = "block";
    window.location.href = "acceuil.html";
  }
}
