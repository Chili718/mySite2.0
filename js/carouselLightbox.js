//
//
//File that contains the functions for the carousel lightbox
//
//


var lightbox = document.getElementById('lightbox');

var x = document.querySelector('.closeButton');
//previous lightbox button
var previous = document.querySelector(".viewPrevious");
//next lightbox button
var next = document.querySelector(".viewNext");

var carousel = document.querySelector('.carousel');

var cells = carousel.querySelectorAll('.carousel_cell');
//variable for the last version of the image title
var lastVal = "";

var showHideButton = document.querySelector(".showHideButton");

//
//Function for moving to the previous image in the gallery
//
function goPrevious(){


  if(lightbox.classList.contains('active'))
  {

    var lit = lightbox.lastChild.src;
    //creating the min version of the path to find the current cell then the next one
    var begin = lightbox.lastChild.src.substring(0, lightbox.lastChild.src.lastIndexOf("/"));
    begin = begin.concat("/min");
    begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("/"), lightbox.lastChild.src.lastIndexOf(".")));
    begin = begin.concat("Min");
    begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("."), lightbox.lastChild.src.length));

    //console.log(begin);

    var node = 0;
    //find the right cell that is next in line
    for (var i = 0; i < cells.length; i++) {
      if(cells[i].lastChild.src === begin)
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
    //create the bigger images file path
    var bigger = cells[node].lastChild.src.replace("Min", "");
    bigger = bigger.replace("/min", "");

    var splay = document.createElement('img');
    splay.src = bigger;
    //change the title to the previous images
    lightbox.lastChild.previousSibling.innerHTML = cells[node].firstChild.innerHTML;

    //remove the previous image and append the new one
    lightbox.removeChild(lightbox.lastChild);
    lightbox.appendChild(splay);


  }

    selectedIndex--;


  //console.log(selectedIndex + "Prev");

  changeCarousel();


}

//
//Function for moving to the next image in the gallery
//
function goNext(){


  if(lightbox.classList.contains('active'))
  {

    var lit = lightbox.lastChild.src;
    //creating the min version of the path to find the current cell then the next one
    var begin = lightbox.lastChild.src.substring(0, lightbox.lastChild.src.lastIndexOf("/"));
    begin = begin.concat("/min");
    begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("/"), lightbox.lastChild.src.lastIndexOf(".")));
    begin = begin.concat("Min");
    begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("."), lightbox.lastChild.src.length));

    var node = 0;
    //find the right cell that is next in line
    for (var i = 0; i < cells.length; i++) {
      if(cells[i].lastChild.src === begin)
      {
        if((i+1) > cells.length-1){
          node = 0;
        }else{
          node = i+1;
        }
        break;
      }
    }
    //create the bigger images file path
    var bigger = cells[node].lastChild.src.replace("Min", "");
    bigger = bigger.replace("/min", "");

    var splay = document.createElement('img');
    splay.src = bigger;
    //change the title to the next images
    lightbox.lastChild.previousSibling.innerHTML = cells[node].firstChild.innerHTML;

    //remove the previous image and append the new one
    lightbox.removeChild(lightbox.lastChild);
    lightbox.appendChild(splay);


  }

    selectedIndex++;


  changeCarousel();
  //console.log(selectedIndex + "Next");

}
//event listener for the previous button
previous.addEventListener('click', function(){

  goPrevious();

});
//event listener for the next button
next.addEventListener('click', function(){

    goNext();

});
//
//function for giving the proper reaction to which way the user swipes
//
function swipeDir(dir){
  //console.log(dir);
  if(dir == 'l')//previous image
  {

    goNext();

  }
  else if(dir == 'r')//next image
  {

    goPrevious();

  }else if(dir == 'u' || dir == 'd'){//up or down will close the lightbox

    lightbox.classList.remove('active');


    //document.body.classList.remove('noScroll');
    enableScroll();

  }

}


//pressing escape will also remove the lightbox from the screen
document.body.onkeyup = function(e){
    if(e.keyCode == 27 && lightbox.classList.contains('active')){
      lightbox.classList.remove('active');


      //document.body.classList.remove('noScroll');
      enableScroll();
    }
}

detectSwipe('lightbox', swipeDir);

//when clicking off the image the lightbox will be removed
lightbox.addEventListener('click', e => {
  if(e.target !== e.currentTarget) return;

  lightbox.classList.remove('active');


  //document.body.classList.remove('noScroll');
  enableScroll();


});
//also clicking or tapping off the image will remove the lightbox
x.addEventListener('click', e => {

  lightbox.classList.remove('active');

  //document.body.classList.remove('noScroll');
  enableScroll();

});

//
//
//Event listener for the button that shows and hides the icons for the lightbox
//
//
showHideButton.addEventListener('click', e => {

  if(showHideButton.innerHTML.includes('eye-off-outline')){

    showHideButton.innerHTML = "<ion-icon name='eye-outline'></ion-icon>";
    next.classList.toggle("hide");
    previous.classList.toggle("hide");
    x.classList.toggle("hide");
    if(lightbox.contains(document.getElementById('deleteButton'))){
      document.getElementById('deleteButton').classList.toggle("hide");
    }
    document.querySelector('.viewTitle').classList.toggle("hide");

  }
  else
  {

    showHideButton.innerHTML = "<ion-icon name='eye-off-outline'></ion-icon>";
    next.classList.toggle("hide");
    previous.classList.toggle("hide");
    x.classList.toggle("hide");
    if(lightbox.contains(document.getElementById('deleteButton'))){
      document.getElementById('deleteButton').classList.toggle("hide");
    }
    document.querySelector('.viewTitle').classList.toggle("hide");

  }

});


//
//Function for obtaining the lightboxes title to be used in comparision when the user
//changes the title or doesn't
//
function checkChange(){

  lastVal = lightbox.lastChild.previousSibling.innerHTML;

  //console.log(lastVal);

}
//
//Function for adding the lightbox event listener to all of the images
//
function addLB(){
  var images = carousel.querySelectorAll('.carousel_cell');

  //console.log(images);

  images.forEach(image => {

    image.addEventListener('click', e => {

      showHideButton.innerHTML = "<ion-icon name='eye-off-outline'></ion-icon>";

      //must clone node or else when we remove the child on close it will remove
      //the actual sibling node
      var title = image.firstChild.cloneNode(true);//.textContent;

      lightbox.classList.add('active');
      //get the larger files path from the min version
      const splay = document.createElement('img');
      var bigger = image.lastChild.src.replace("Min", "");
      bigger = bigger.replace("/min", "");
      splay.src = bigger;

      //remove the title and picture of the previous image that was in the lb
      if(lightbox.childElementCount >= 6){

        lightbox.removeChild(lightbox.lastChild);
        lightbox.removeChild(lightbox.lastChild);

      }

      //adding the lb title css to the newly created element
      title.classList.add('viewTitle');

      //append the title of the picture to the lightbox
      lightbox.appendChild(title);
      //append image to the lightbox
      lightbox.appendChild(splay);

      //document.body.classList.add('noScroll');

      //remove all of the possible hidden elements
      next.classList.remove("hide");
      previous.classList.remove("hide");
      x.classList.remove("hide");

      disableScroll();


    });

  });

}

addLB();
