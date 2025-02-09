function signup() {
  const username = document.getElementById("username").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;
  const confirmPassword = document.getElementById("confirm-password").value;
  const TandC = document.getElementById("t&c").checked;
  const mfa = document.getElementById("mfa").checked;
  const error = document.getElementById("error");
  const errorBox = document.getElementById("error-box");
  const success = document.getElementById("success");
  const successBox = document.getElementById("success-box");
  if (password !== confirmPassword) {
    error.innerHTML = "Passwords do not match!";
    errorBox.classList.remove("hidden");
    return;
  }
  if (!TandC) {
    error.innerHTML = "You must agree to the terms and conditions!";
    errorBox.classList.remove("hidden");
    return;
  }
  if (!username || !email || !password || !confirmPassword) {
    error.innerHTML = "All fields are required!";
    errorBox.classList.remove("hidden");
    return;
  }
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "api/auth/register", true);
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && (xhr.status === 201 || xhr.status === 200)) {
      success.innerHTML = "Account created. redirecting to dashboard.";
      errorBox.classList.add("hidden");
      successBox.classList.remove("hidden");
      setTimeout(() => {
        if (mfa) {
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

  const data = JSON.stringify({
    username: username,
    email: email,
    password: password,
    TandC: TandC,
    // TODO add imputs for name values
    first_name: "",
    last_name: "",
    mfa: mfa,
  });

  xhr.send(data);
}

const signupButton = document.getElementById("signup");
signupButton.addEventListener("click", signup);
