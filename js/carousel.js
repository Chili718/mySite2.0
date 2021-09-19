/*

File for the functionality of the home pages carousel and its lightbox

*/
var carousel = document.querySelector('.carousel');

var cells = carousel.querySelectorAll('.carousel_cell');
//number of images in the carousel
var cellCount = 9;
//index of the cell selected
var selectedIndex = 0;

var cellWidth = carousel.offsetWidth;

var cellHeight = carousel.offsetHeight;
//willl always rotate on the y axis due to no need to have it rotate on the x axis
//for this project at least
var isHorizontal = true;
var rotateFn = isHorizontal ? 'rotateY' : 'rotateX';

var theta;

//function to rotate the carousel as a whole
function rotateCarousel(){

  var angle = theta * selectedIndex * -1;

  carousel.style.transform = 'translateZ(-385px)' + rotateFn +'(' + angle + 'deg)';

}
////////////////////////////////////////////////////////////
var prevButton = document.querySelector('.viewPreviousCaro');

function previousCar(){

  selectedIndex--;


  //console.log(selectedIndex + "Prev");

  changeCarousel();

}

prevButton.addEventListener('click', function(){

  previousCar();

});

//////////////////////////////////////////////////////////////
var nextButton = document.querySelector('.viewNextCaro');

function nextCar(){

  selectedIndex++;


  changeCarousel();
  //console.log(selectedIndex + "Next");

}

nextButton.addEventListener('click', function(){

  nextCar();

});
//function for handling the direction of the swipes from the swipe js function
function swipeDir(dir){
  //document.body.style.overflow = "hidden";
  //.setAttribute("style","-ms-touch-action: none;");
  //console.log(dir);
  if(dir == 'l')
  {

    nextCar();

  }
  else if(dir == 'r')
  {

    previousCar();

  }

}

//detectSwipe('lightbox', swipeDir);
detectSwipe('swipeBox', swipeDir);

//function to transform all of the cells in the carousel
//to the right angles then rotate it
function changeCarousel(){

  theta = 360 / cellCount;

  var cellSize = isHorizontal ? cellWidth : cellHeight;

  for( var i = 0; i < cells.length; i++){

    var cell = cells[i];

    if(i < cellCount){

      cell.style.opacity = 1;

      var cellAngle = theta * i;

      cell.style.transform = rotateFn + '(' + cellAngle + 'deg); ';

    }else{

      cell.style.opacity = 0;

      cell.style.transform = 'none';

    }

  }

  rotateCarousel();

}
