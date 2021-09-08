/*

File for all the basic js functions a page on this website needs for
the burger menu and pre loader

*/

//hamburger icon
var ham = document.querySelector(".burger");
//the list of the links on the navigation
var navLinks = document.querySelector(".nav-links");
//all the individual links
var links = document.querySelectorAll(".nav-links li");
var imgLink = document.querySelector(".imgLink");



//removes the preloader when the page is loaded by adding the 'loaded' class
window.addEventListener('load', () => {

  var preload = document.querySelector('.preloader');

  //add the class to remove the prelaoder after two seconds
  //so the user can see the ship
  setTimeout(function(){

    preload.classList.add('loaded');

  }, 2000);

});
//toggle the menu when the user clicks on a link
links.forEach((link) => {

    link.addEventListener("click", () => {

        var check = document.getElementById("check");
        //dont want open to toggle open when the website isnt using the burger
        if(check.classList.contains("open")){

          toggleMenu();

        }

    });
});
//also must add the toggle to the home img link
imgLink.addEventListener("click", ()=> {

  var check = document.getElementById("check");
  //dont want open to toggle open when the website isnt using the burger
  if(check.classList.contains("open")){

    toggleMenu();

  }

});
//open and close menu from the burger as standard
ham.addEventListener("click", ()=>{

  toggleMenu();

});

//toggles the classes to show the menu for burger and the links
function toggleMenu(){

  navLinks.classList.toggle("open");

  ham.classList.toggle("ex");
  //add the fade in animation to the navbar links to show the user on open
  links.forEach((link, index) => {
    //if the links already have an animation it will be removed or re applied
    //if not
    if(link.style.animation){
      link.style.animation = '';
    }else{
      link.style.animation = `linksFadeIn 0.4S ease-in-out forwards ${index / 5}s`;
    }

  });

}

//stop animations from playing when the window is being resized
//removes the jank look
var resizeTimer;
window.addEventListener("resize", e => {

  document.body.classList.add("resize-animation-stopper");

  clearTimeout(resizeTimer);

  resizeTimer = setTimeout(() => {
    document.body.classList.remove("resize-animation-stopper");
  }, 400);

});
