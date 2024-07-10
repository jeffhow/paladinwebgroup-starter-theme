const dk_switch = document.querySelector("#dark-mode-toggle");
// checked for saved preference
let theme = localStorage.getItem("theme");

function setMode() {
  if (theme === 'dark') {
    darkMode();
  } else if (theme === 'light') {
    lightMode();
  } else {
    // check system pref
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      // dark mode
      darkMode();
    } else {
      lightMode();
    }
  }
  localStorage.setItem("theme", theme);
}


// check for changes to system pref
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
  theme = event.matches ? "dark" : "light";
  localStorage.setItem("theme", theme);
  setMode();
});

function darkMode() {
  document.body.classList.remove("light-theme");
  document.body.classList.add("dark-theme");
}
function lightMode() {
  document.body.classList.remove("dark-theme");
  document.body.classList.add("light-theme");
}

dk_switch.addEventListener("click", function () {
  if (this.checked) {
    theme = 'dark';
    darkMode();
  } else {
    theme = 'light';
    lightMode();
  }
  localStorage.setItem("theme", theme);
});

setMode();