function checkAuth() {
  const cookies = document.cookie.split(";");
  for (let i = 0; i < cookies.length; i++) {
    const cookie = cookies[i].trim();
    if (cookie.startsWith("auth=true")) {
      return true;
    }
  }
  return false;
}

function logout() {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/api/auth/logout", true);
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      window.location.reload();
    }
  };
  xhr.send();
}

document.addEventListener("DOMContentLoaded", () => {
  if (checkAuth()) {
    document.getElementById("nav-login").classList.add("hidden");
    document.getElementById("nav-signup").classList.add("hidden");
    document.getElementById("nav-logout").classList.remove("hidden");
    document.getElementById("nav-user").classList.remove("hidden");
  }
  document.getElementById("nav-user").addEventListener("click", () => {
    window.location.href = "/dashboard";
  });
  document.getElementById("nav-logout").addEventListener("click", logout);
});
