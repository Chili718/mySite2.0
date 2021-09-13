/*

File for the functionality of the home pages carousel

*/
var carousel = document.querySelector('.carousel');

var cells = carousel.querySelectorAll('.carousel_cell');
//number of images in the carousel
var cellCount = 9;

var selectedIndex = 0;

var cellWidth = carousel.offsetWidth;

var cellHeight = carousel.offsetHeight;

var isHorizontal = true;

var rotateFn = isHorizontal ? 'rotateY' : 'rotateX';

var radius, theta;

//var lightbox = document.getElementById('lightbox');

function rotateCarousel(){

  var angle = theta * selectedIndex * -1;

  carousel.style.transform = 'translateZ(-385px)' + rotateFn +'(' + angle + 'deg)';

}
////////////////////////////////////////////////////////////
var prevButton = document.querySelector('.viewPreviousCaro');

function previousCar(){
  /*
  if(lightbox.classList.contains('active'))
  {

    var lit = lightbox.lastChild.src;

    var begin = lightbox.lastChild.src.substring(0, lightbox.lastChild.src.lastIndexOf("/"));

    begin = begin.concat("/min");

    begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("/"), lightbox.lastChild.src.lastIndexOf(".")));

    begin = begin.concat("Min");

    begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("."), lightbox.lastChild.src.length));

    //console.log(begin);

    var node = 0;

    for (var i = 0; i < cells.length; i++) {
      if(cells[i].firstChild.src === begin)
      {
        if((i-1) != -1)
        {
          node = i-1;
        }else{
          node = cells.length-1;
        }
        break;
      }
    }

    var bigger = cells[node].firstChild.src.replace("Min", "");
    bigger = bigger.replace("/min", "");
    //console.log(node);
    var splay = document.createElement('img');
    splay.src = bigger;

    //console.log(bigger);
    while(lightbox.childElementCount >= 2){

      lightbox.removeChild(lightbox.lastChild);

    }

    lightbox.appendChild(splay);


  }
  */
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
  /*
  if(lightbox.classList.contains('active'))
  {

    var lit = lightbox.lastChild.src;

    var begin = lightbox.lastChild.src.substring(0, lightbox.lastChild.src.lastIndexOf("/"));

    begin = begin.concat("/min");

    begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("/"), lightbox.lastChild.src.lastIndexOf(".")));

    begin = begin.concat("Min");

    begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("."), lightbox.lastChild.src.length));

    var node = 0;

    for (var i = 0; i < cells.length; i++) {
      if(cells[i].firstChild.src === begin)
      {
        if((i+1) > cells.length-1){
          node = 0;
        }else{
          node = i+1;
        }
        break;
      }
    }

    var bigger = cells[node].firstChild.src.replace("Min", "");
    bigger = bigger.replace("/min", "");
    //console.log(node);
    var splay = document.createElement('img');
    splay.src = bigger;

    while(lightbox.childElementCount >= 2){

      lightbox.removeChild(lightbox.lastChild);

    }

    lightbox.appendChild(splay);


  }
  */
    selectedIndex++;


  changeCarousel();
  //console.log(selectedIndex + "Next");

}

nextButton.addEventListener('click', function(){

  nextCar();

});

function swipeDir(dir){

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

function changeCarousel(){

  theta = 360 / cellCount;

  var cellSize = isHorizontal ? cellWidth : cellHeight;

  radius = Math.round( (cellSize / 2) / Math.tan( Math.PI / cellCount ) );

  for( var i = 0; i < cells.length; i++){

    var cell = cells[i];

    if(i < cellCount){

      cell.style.opacity = 1;

      var cellAngle = theta * i;

      //cell.style.transform = rotateFn + '(' + cellAngle + 'deg); translateZ(' + radius + 'px);';

      cell.style.transform = rotateFn + '(' + cellAngle + 'deg); ';

    }else{

      cell.style.opacity = 0;

      cell.style.transform = 'none';

    }

  }

  rotateCarousel();

}
