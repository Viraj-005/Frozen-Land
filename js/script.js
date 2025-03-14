let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
}

let account = document.querySelector('.user-account');

document.querySelector('#user-btn').onclick = () =>{
    account.classList.add('active');
}

document.querySelector('#close-account').onclick = () =>{
    account.classList.remove('active');
}

let myOrders = document.querySelector('.my-orders');

document.querySelector('#order-btn').onclick = () =>{
    myOrders.classList.add('active');
}

document.querySelector('#close-orders').onclick = () =>{
    myOrders.classList.remove('active');
}

let cart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = () =>{
    cart.classList.add('active');
}

document.querySelector('#close-cart').onclick = () =>{
    cart.classList.remove('active');
}

window.onscroll = () =>{
    navbar.classList.remove('active');
    myOrders.classList.remove('active');
    cart.classList.remove('active');
    
};

let slides = document.querySelectorAll('.home-bg .home .slide-container .slide');
let index = 0;

function next(){
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');

}

function prev(){
    slides[index].classList.remove('active');
    index = (index - 1 + slides.length) % slides.length;
    slides[index].classList.add('active');
}

let accordion = document.querySelectorAll('.faq .accordion-container .accordion');

accordion.forEach(acco =>{
    acco.onclick = () =>{
        accordion.forEach(remove => remove.classList.remove('active'));
        acco.classList.add('active');
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
function loader(){
    document.querySelector('.preloader').style.display = 'none';
}
 
function fadeOut(){
    setInterval(loader, 2000);
}

window.onload = fadeOut;
  
  

