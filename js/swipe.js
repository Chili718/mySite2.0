//
//
//File which contains the function to add swipe detection to an element
//
//

function detectSwipe(el,func){
  //create an object to hold the starting and ending position of the x and y axis
  swipe_det = new Object();
  swipe_det.sX = 0;
  swipe_det.sY = 0;
  swipe_det.eX = 0;
  swipe_det.eY = 0;

  var min_x = 45;  //min x swipe for horizontal swipe
  var max_x = 40;  //max x difference for vertical swipe
  var min_y = 40;  //min y swipe for vertical swipe
  var max_y = 200;  //max y difference for horizontal swipe
  var direc = "";


  ele = document.getElementById(el);
  //get the initial xy for the starting touch
  ele.addEventListener('touchstart',function(e){
    var t = e.touches[0];
    swipe_det.sX = t.screenX;
    swipe_det.sY = t.screenY;
    //document.body.style.overflow = "hidden";
  },false);
  //continuosly update the coordinates as the user moves the swipe
  ele.addEventListener('touchmove',function(e){
    //e.preventDefault();
    var t = e.touches[0];
    swipe_det.eX = t.screenX;
    swipe_det.eY = t.screenY;

  },false);

  ele.addEventListener('touchend',function(e){
    //horizontal detection calculation
    if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y))))
    {

      if((swipe_det.eX > swipe_det.sX) && ((swipe_det.eX !== 0) && (swipe_det.sX !== 0)))
      {

        direc = "r";

      }
      else if((swipe_det.eX !== 0) && (swipe_det.sX !== 0))
      {

        direc = "l";

      }

    }
    //document.body.style.overflow = "scroll";

    //vertical detection calculation
    if ((((swipe_det.eY - min_y > swipe_det.sY) || (swipe_det.eY + min_y < swipe_det.sY)) && ((swipe_det.eX < swipe_det.sX + max_x) && (swipe_det.sX > swipe_det.eX - max_x)))) {

      if((swipe_det.eY > swipe_det.sY) && ((swipe_det.eY !== 0) && (swipe_det.sY !== 0)))
      {

        direc = "d";

      }
      else if((swipe_det.eY !== 0) && (swipe_det.sY !== 0))
      {

        direc = "u";

      }

    }


    if (direc !== ""){
      //if the parameter passed is a function then the direction will be passed
      if(typeof func == 'function')
      {

        func(direc);

      }

    }
    //reset all of the variables
    direc = "";
    swipe_det.sX = 0;
    swipe_det.sY = 0;
    swipe_det.eX = 0;
    swipe_det.eY = 0;
  },false);
}
