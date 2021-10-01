/*

File for all the function that set and get the themes across the whole site

*/
//var dayNightToggle = document.querySelector("dayNightToggle");

//function for setting the theme in the localstorage if needed
function checkIfStorageSet(){

  if(localStorage.getItem('theme') == null){

    localStorage.setItem('theme','Day');

  }

  //set the theme
  setTheme(localStorage.getItem('theme'));

}
//function for changing the href for the theme and button icon
function setTheme(theme){

    var path = "".concat("css/variables", theme, ".css");

    document.getElementById("dayNightToggle").setAttribute("href", path);

}

//set the local storage item for the theme the user wants
function changeTheme(){

  if(localStorage.getItem('theme') == 'Night'){

    localStorage.setItem('theme', 'Day');
    setTheme('Day');

  }else{

    localStorage.setItem('theme', 'Night');
    setTheme('Night');

  }
  //localStorage.setItem('theme',theme);

}
//function for changing the day icons and the specific images on the pages etc
function changeIcon(){
  //changing all of the elements to fit the day theme
  if(localStorage.getItem('theme') == 'Day'){
    document.querySelector('.dayNightToggle').innerHTML = "<ion-icon name='moon-outline'></ion-icon>";
    //if we are on the home page which contains the only parallax
    //dont have to check for the other elements because they are on every page
    if(document.querySelector('.parallax') != null){
      document.querySelector('.myPicture').src = 'images/picofme.png';
      document.querySelector('.parallax').style.backgroundImage = "url('images/mainDay.jpg')";
    }

    document.querySelector('.nav-signature').src = 'images/logo.png';
    //all preloader image changes
    document.querySelector('.ship').src = 'images/ship.gif';
    document.querySelector('.loadDots').firstElementChild.src = 'images/Loading.gif';
    document.querySelector('.loadDots').lastElementChild.src = 'images/Circle.gif';


    //start of font changes
    document.querySelector('.navbar').classList.remove('nightBar');
  }else{//night theme changes
    document.querySelector('.dayNightToggle').innerHTML = "<ion-icon name='sunny-outline'></ion-icon>";
    //if we are on the home page which contains the only parallax
    //dont have to check for the other elements because they are on every page
    if(document.querySelector('.parallax') != null){
      document.querySelector('.myPicture').src = 'images/picofmeNight.png';
      document.querySelector('.parallax').style.backgroundImage = "url('images/mainNight.jpg')";
    }

    document.querySelector('.nav-signature').src = 'images/logoNight.png';
    //all preloader image changes
    document.querySelector('.ship').src = 'images/shipNight.gif';
    document.querySelector('.loadDots').firstElementChild.src = 'images/LoadingNight.gif';
    document.querySelector('.loadDots').lastElementChild.src = 'images/CircleNight.gif';

    //home svg changes
    //document.querySelector('.image-anim').innerHTML = "";

    //start of font changes
    document.querySelector('.navbar').classList.add('nightBar');
  }

}
//check and set if needed
checkIfStorageSet();

//console.log(localStorage.getItem('theme'));
