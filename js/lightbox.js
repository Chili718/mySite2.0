var lightbox = document.getElementById('lightbox');

var x = document.querySelector('.closeButton');

var previous = document.querySelector(".viewPrevious");

var next = document.querySelector(".viewNext");

var boxes = document.querySelector(".grid").children;

var lastVal = "";

function goPrevious(){

  var lit = lightbox.lastChild.src;

  var begin = lightbox.lastChild.src.substring(0, lightbox.lastChild.src.lastIndexOf("/"));

  begin = begin.concat("/min");

  begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("/"), lightbox.lastChild.src.lastIndexOf(".")));

  begin = begin.concat("Min");

  begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("."), lightbox.lastChild.src.length));

  var node = 0;

  for (var i = 0; i < boxes.length; i++) {
    if(boxes[i].lastChild.src === begin)
    {
      if((i-1) != -1)
      {
        node = i-1;
      }else{
        node = boxes.length-1;
      }
      break;
    }
  }

  boxes[node].scrollIntoView();
  //change the images title
  lightbox.lastChild.previousSibling.innerHTML = boxes[node].firstChild.innerHTML;

  lit = boxes[node].lastChild.src;

  var bigger = lit.replace("Min", "");
  bigger = bigger.replace("/min", "");
  //console.log(node);
  const splay = document.createElement('img');
  splay.src = bigger;

  lightbox.removeChild(lightbox.lastChild);

  lightbox.appendChild(splay);

}

function goNext(){

  var lit = lightbox.lastChild.src;

  var begin = lightbox.lastChild.src.substring(0, lightbox.lastChild.src.lastIndexOf("/"));

  begin = begin.concat("/min");

  begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("/"), lightbox.lastChild.src.lastIndexOf(".")));

  begin = begin.concat("Min");

  begin = begin.concat(lightbox.lastChild.src.substring(lightbox.lastChild.src.lastIndexOf("."), lightbox.lastChild.src.length));

  //console.log(begin);

  var node = 0;

  for (var i = 0; i < boxes.length; i++) {
    if(boxes[i].lastChild.src === begin)
    {
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

  var bigger = lit.replace("Min", "");
  bigger = bigger.replace("/min", "");

  const splay = document.createElement('img');
  splay.src = bigger;

  lightbox.removeChild(lightbox.lastChild);

  lightbox.appendChild(splay);

}

previous.addEventListener('click', function(){

  goPrevious();

});

next.addEventListener('click', function(){

    goNext();

});

function swipeDir(dir){
  console.log(dir);
  if(dir == 'l')
  {

    goNext();

  }
  else if(dir == 'r')
  {

    goPrevious();

  }else if(dir == 'u' || dir == 'd'){

    lightbox.classList.remove('active');


    document.body.classList.remove('noScroll');

  }

}


//pressing escape will also remove the lightbox from the screen
document.body.onkeyup = function(e){
    if(e.keyCode == 27 && lightbox.classList.contains('active')){
      lightbox.classList.remove('active');


      document.body.classList.remove('noScroll');
    }
}

//closeButtondetectSwipe('lightbox', swipeDir);

//when clicking off the image the lightbox will be removed
lightbox.addEventListener('click', e => {
  if(e.target !== e.currentTarget) return;

  lightbox.classList.remove('active');


  document.body.classList.remove('noScroll');


});
//also clicking or tapping off the image will remove the lightbox
x.addEventListener('click', e => {

  lightbox.classList.remove('active');

  document.body.classList.remove('noScroll');

});
//
//user function for removing an image from the gallery
//
function deleteIm(){

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

      $.get( "php/view.php", function( data ) {
          $('.grid').html(data);

          addLB();
      });

    },
    error: function(xhr){

      //console.log(xhr.responseText);

    }

  });

}
//
//User function for updating the images title on the gallery
//
function updateIM(){

  var data = lightbox.lastChild.src;

  var path = data.substring(data.lastIndexOf("photoshopWork"), data.length);

  var name = lightbox.lastChild.previousSibling.innerHTML;

  if(name != lastVal){

    $.ajax({

      url:'php/update.php',
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

        $.get( "php/view.php", function( data ) {
            $('.grid').html(data);

            addLB();
        });
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



      if(lightbox.contains(document.querySelector('deleteButton'))){

        while(lightbox.childElementCount >= 6){

          lightbox.removeChild(lightbox.lastChild);
          lightbox.removeChild(lightbox.lastChild);

        }
        //adding the user function of being able to edit the images title
        title.contentEditable = 'true';
        title.addEventListener("focus", checkChange);
        //title.addEventListener("blur", updateIM);
        title.addEventListener("blur", updateIM);

      }else {
        while(lightbox.childElementCount >= 5){

          lightbox.removeChild(lightbox.lastChild);
          lightbox.removeChild(lightbox.lastChild);

        }
      }
      //adding the lb title css to the newly created element
      title.classList.add('viewTitle');

      //append the title of the picture to the lightbox
      lightbox.appendChild(title);
      //append image to the lightbox
      lightbox.appendChild(splay);

      document.body.classList.add('noScroll');


    });

  });

}
