let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');
let theme = document.querySelector('.header .flex .theme-container');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    profile.classList.remove('active');
    theme.classList.remove('active');
};

document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle('active');
    navbar.classList.remove('active');
};

document.querySelector('#setting-btn').onclick = () => {
    theme.classList.toggle('active');
    navbar.classList.remove('active');
};

window.onscroll = () => {
    navbar.classList.remove('active');
    profile.classList.remove('active');
    theme.classList.remove('active');
};

/* Dark mode & Light mode using LocalStorage */
const body = document.querySelector("body"),
    toggle = document.querySelector(".toggler");

let getMode = localStorage.getItem("mode");
if (getMode && getMode === 'dark') {
    body.classList.add('dark');
    toggle.classList.add('active');
} else {
    body.classList.remove('light');
}

toggle.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (!body.classList.contains("dark")) {
        return localStorage.setItem("mode", "light");
    }
    localStorage.setItem("mode", "dark");
});

toggle.addEventListener("click", () => toggle.classList.toggle("active"));

// Check if a color is already stored in localStorage
const storedColor = localStorage.getItem('selectedColor');
if (storedColor) {
    document.querySelector(':root').style.setProperty('--main-color', storedColor);
}

document.querySelectorAll('.theme-colors .color').forEach(color => {
    color.onclick = () => {
        let background = color.style.background;
        document.querySelector(':root').style.setProperty('--main-color', background);
        localStorage.setItem('selectedColor', background);
    }
});

// Top scroll arrow
let calcScrollValue = () => {
    let scrollProgress = document.getElementById("progress");
    let progressValue = document.getElementById("progress-value");
    let pos = document.documentElement.scrollTop;
    let calcHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
    let scrollValue = Math.round((pos * 100) / calcHeight);
    if (pos > 100) {
        scrollProgress.style.display = "grid";
    } else {
        scrollProgress.style.display = "none";
    }
    scrollProgress.addEventListener("click", () => {
        document.documentElement.scrollTop = 0;
    });

    // Retrieve the root colors using getComputedStyle
    let rootStyles = getComputedStyle(document.documentElement);
    let mainColor = rootStyles.getPropertyValue("--main-color");
    let roundColor = rootStyles.getPropertyValue("--round-color");

    // Set the background using the root colors
    scrollProgress.style.background = `conic-gradient(${mainColor} ${scrollValue}%, ${roundColor} ${scrollValue}%)`;
};

window.onscroll = calcScrollValue;
window.onload = calcScrollValue;

// Pre Loader
function loader() {
    document.querySelector('.preloader').style.display = 'none';
}

function fadeOut() {
    setInterval(loader, 2000);
}

window.onload = fadeOut;

/*=============== Time & Date ===============*/
function updateTime() {
    var date = new Date();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    var ampm = hours >= 12 ? 'PM' : 'AM';

    hours = hours % 12;
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;

    var timeString = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
    var timeElement = document.getElementById('time');
    var dateElement = document.getElementById('date');

    if (timeElement) {
        timeElement.innerHTML = timeString;
    }

    var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    var dateString = date.toLocaleDateString(undefined, options);

    if (dateElement) {
        dateElement.innerHTML = dateString;
    }
}

setInterval(updateTime, 1000); // Update time every second