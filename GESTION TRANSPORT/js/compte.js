//Materialize Initialization ///////////
document.addEventListener("DOMContentLoaded", function () {
  var elems = document.querySelectorAll(".sidenav");
  var instances = M.Sidenav.init(elems, options);
});

// Authentification //////////
function auth() {
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var confirmPwd = document.getElementById("confirm-pwd");
  const success = document.getElementById("success");
  const danger = document.getElementById("danger");
  if (email.value === "" || password.value === "" || confirmPwd.value === "") {
    danger.style.display = "block";
  } else {
    setTimeout(() => {
      email.value = "";
      password.value = "";
      confirmPwd.value = "";
    }, 2000);
    danger.style.display = "none";
    success.style.display = "block";
    window.location.href = "acceuil.html";
  }
}
