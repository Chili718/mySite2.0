//
//
//File that contains the functions for the lightbox on the view page and carousel
//
//


var lightbox = document.getElementById('lightbox');

var x = document.querySelector('.closeButton');
//previous lightbox button
var previous = document.querySelector(".viewPrevious");
//next lightbox button
var next = document.querySelector(".viewNext");
//contains all of the images in their divs
var boxes = document.querySelector(".grid").children;
//variable for the last version of the image title
var lastVal = "";

var showHideButton = document.querySelector(".showHideButton");

//
//Function for moving to the previous image in the gallery
//
function goPrevious(){

  var lit = lightbox.lastChild.src;
  //creating the min version of the path to find the previous node
  var begin = lightbox.lastChild.src.substring(0, lightbox.lastChild.src.lastIndexOf("/"));
  begin = begin.concat("/min");
  begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("/"), lightbox.lastChild.src.lastIndexOf(".")));
  begin = begin.concat("Min");
  begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("."), lightbox.lastChild.src.length));

  var node = 0;
  //find the correct node that is the image
  for (var i = 0; i < boxes.length; i++) {
    //checking if boxes[i] is the correct node
    if(boxes[i].lastChild.src === begin)
    {
      //determining if the users is at the end of the box list in which case it will start over
      if((i-1) != -1)
      {
        node = i-1;
      }else{
        node = boxes.length-1;
      }
      break;
    }
  }

  //it will scroll it into view so when the users leaves the lightbox that image will be there
  boxes[node].scrollIntoView();
  //change the images title
  lightbox.lastChild.previousSibling.innerHTML = boxes[node].firstChild.innerHTML;

  lit = boxes[node].lastChild.src;

  //relacing the min path obtained from boxes and getting the actual image
  var bigger = lit.replace("Min", "");
  bigger = bigger.replace("/min", "");
  //console.log(node);
  const splay = document.createElement('img');
  splay.src = bigger;

  //removing the image and then replacing it with splay
  lightbox.removeChild(lightbox.lastChild);

  lightbox.appendChild(splay);

}

//
//Function for moving to the next image in the gallery
//
function goNext(){

  var lit = lightbox.lastChild.src;
  //creating the min version of the path to find the previous node
  var begin = lightbox.lastChild.src.substring(0, lightbox.lastChild.src.lastIndexOf("/"));
  begin = begin.concat("/min");
  begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("/"), lightbox.lastChild.src.lastIndexOf(".")));
  begin = begin.concat("Min");
  begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("."), lightbox.lastChild.src.length));

  //console.log(begin);

  var node = 0;
  //find the correct node that is the image
  for (var i = 0; i < boxes.length; i++) {
    //checking if boxes[i] is the correct node
    if(boxes[i].lastChild.src === begin)
    {
      //determining if the users is at the end of the box list in which case it will start over
      if((i+1) > boxes.length-1){
        node = 0;
      }else{
        node = i+1;
      }
      break;
    }
  }

  boxes[node].scrollIntoView();
  //change the images title
  lightbox.lastChild.previousSibling.innerHTML = boxes[node].firstChild.innerHTML;

  lit = boxes[node].lastChild.src;
  //relacing the min path obtained from boxes and getting the actual image
  var bigger = lit.replace("Min", "");
  bigger = bigger.replace("/min", "");

  const splay = document.createElement('img');
  splay.src = bigger;
  //removing the image and then replacing it with splay
  lightbox.removeChild(lightbox.lastChild);

  lightbox.appendChild(splay);

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
//user function for removing an image from the gallery
//
function deleteIm(){

  var confirmAction = confirm("Are you sure you would like to delete this image forever?");

  if(confirmAction)
  {

    //var xhr = new XMLHttpRequest();
    var data = lightbox.lastChild.src;

    var path = data.substring(data.lastIndexOf("photoshopWork"), data.length);

    //console.log(path);

    $.ajax({

      url:'php/delete.php',
      type:'post',
      data:{
        path: path
      },
      success:function(php_result){

        //alert(php_result);

        lightbox.classList.remove('active');
        document.body.classList.remove('noScroll');

        //document.querySelectorAll('.grid div').innerHTML = "";
        document.querySelector('.grid').innerHTML = "";

        var filters = document.getElementsByName('filter');
        //find the current filter the users is on to load the right first 20 images
        for (var i = 0, length = filters.length; i < length; i++) {
          if (filters[i].checked) {

            //reload all of the images on the page minus the one just deleted
            $.ajax({

              url: 'php/view.php',
              type: 'POST',
              data: {count: 0,
                    filter: filters[i].value},
              success: function(response){

                if(response == "dbf" || response == "fail"){

                  document.getElementById('errorTxt').innerHTML = 'Looks like its the internet, or me though.';

                  removeSetTimeOut('errorTxt');

                }else{

                  $(".grid").prepend(response).show().fadeIn("slow");

                  addLB();

                  document.getElementById('successTxt').innerHTML = php_result;

                  removeSetTimeOut('successTxt');

                }

              }

            });


          }
        }


      },
      error: function(xhr){

        //console.log(xhr.responseText);

      }

    });

  }

}
//
//User function for updating the images title on the gallery
//
function updateIMTitle(){

  var data = lightbox.lastChild.src;

  var path = data.substring(data.lastIndexOf("photoshopWork"), data.length);

  var name = lightbox.lastChild.previousSibling.innerHTML;

  if(name != lastVal){

    $.ajax({

      url:'php/updateTitle.php',
      type:'post',
      data:{
        path: path,
        name: name
      },
      success:function(php_result){

        //alert(php_result);
        /*
        lightbox.classList.remove('active');
        document.body.classList.remove('noScroll');
        */
        //document.querySelectorAll('.grid div').innerHTML = "";
        document.querySelector('.grid').innerHTML = "";

        while(document.querySelector('.grid').firstChild){

          document.querySelector('.grid').removeChild(document.querySelector('.grid').firstChild);

        }

        var filters = document.getElementsByName('filter');
        //find the current filter the users is on to load the right first 20 images
        for (var i = 0, length = filters.length; i < length; i++) {
          if (filters[i].checked) {

            //reload all of the images on the page minus the one just deleted
            $.ajax({

              url: 'php/view.php',
              type: 'POST',
              data: {count: 0,
                    filter: filters[i].value},
              success: function(response){

                if(response == "dbf" || response == "fail"){

                  document.getElementById('errorTxt').innerHTML = 'Looks like its the internet, or me though.';

                  removeSetTimeOut('errorTxt');

                }else{

                  $(".grid").prepend(response).show().fadeIn("slow");

                  addLB();

                  document.getElementById('successTxt').innerHTML = php_result;

                  removeSetTimeOut('successTxt');

                }

              }

            });


          }
        }
      },
      error: function(xhr){

        //console.log(xhr.responseText);

      }

    });

  }

}
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
  var images = document.querySelectorAll(".psW");

  //console.log(images);

  images.forEach(image => {

    image.addEventListener('click', e => {

      //must clone node or else when we remove the child on close it will remove
      //the actual sibling node
      var title = image.previousSibling.cloneNode(true);//.textContent;

      lightbox.classList.add('active');
      //get the larger files path from the min version
      const splay = document.createElement('img');
      var bigger = image.src.replace("Min", "");
      bigger = bigger.replace("/min", "");
      splay.src = bigger;

      if(lightbox.contains(document.getElementById('deleteButton'))){

        //adding the user function of being able to edit the images title
        title.contentEditable = 'true';
        title.addEventListener("focus", checkChange);
        //title.addEventListener("blur", updateIM);
        title.addEventListener("blur", updateIMTitle);

      }
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
      if(lightbox.contains(document.getElementById('deleteButton'))){
        document.getElementById('deleteButton').classList.remove("hide");
      }
      document.querySelector('.viewTitle').classList.remove("hide");

      disableScroll();

    });

  });

}
