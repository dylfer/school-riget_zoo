function login() {
  var user = document.getElementById("username").value; // can be email or username
  var password = document.getElementById("password").value;
  var error = document.getElementById("error");
  var errorBox = document.getElementById("error-box");
  var success = document.getElementById("success");
  var successBox = document.getElementById("success-box");
  if (!user || !password) {
    error.innerHTML = "All fields are required!";
    errorBox.classList.remove("hidden");
    return;
  }
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "api/auth/login", true);
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      success.innerHTML = JSON.parse(xhr.responseText).message;
      errorBox.classList.add("hidden");
      successBox.classList.remove("hidden");
      setTimeout(() => {
        if (JSON.parse(xhr.responseText).mfa) {
          window.location.href = "/registermfa";
        } else {
          window.location.href = "/dashboard";
        }
      }, 2000);
    } else if (xhr.readyState === 4) {
      error.innerHTML = JSON.parse(xhr.responseText).error;
      errorBox.classList.remove("hidden");
    }
  };
  let data;
  if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(user)) {
    data = JSON.stringify({
      email: user,
      password: password,
    });
  } else {
    data = JSON.stringify({
      username: user,
      password: password,
    });
  }
  xhr.send(data);
}
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("login").addEventListener("click", login);
});
