document.addEventListener("DOMContentLoaded", () => {
  const themeToggle = document.getElementById("theme-toggle");
  const htmlElement = document.documentElement;
  const moonIcon = document.getElementById("moon-icon");
  const sunIcon = document.getElementById("sun-icon");

  const setTheme = (isDark) => {
    if (isDark) {
      htmlElement.classList.add("dark");
      localStorage.setItem("theme", "dark");
      moonIcon.classList.add("hidden");
      sunIcon.classList.remove("hidden");
    } else {
      htmlElement.classList.remove("dark");
      localStorage.setItem("theme", "light");
      moonIcon.classList.remove("hidden");
      sunIcon.classList.add("hidden");
    }
  };

  const getInitialTheme = () => {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) return savedTheme === "dark";
    return window.matchMedia("(prefers-color-scheme: dark)").matches;
  };

  setTheme(getInitialTheme());

  themeToggle.addEventListener("click", () => {
    setTheme(!htmlElement.classList.contains("dark"));
  });
});
