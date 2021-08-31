function detectSwipe(el,func){

  swipe_det = new Object();
  swipe_det.sX = 0;
  swipe_det.sY = 0;
  swipe_det.eX = 0;
  swipe_det.eY = 0;

  var min_x = 45;  //min x swipe for horizontal swipe
  var max_x = 500;  //max x difference for vertical swipe
  var min_y = 100;  //min y swipe for vertical swipe
  var max_y = 500;  //max y difference for horizontal swipe
  var direc = "";

  //document.body.style.overflow = "hidden";
  ele = document.getElementById(el);
  ele.addEventListener('touchstart',function(e){
    var t = e.touches[0];
    swipe_det.sX = t.screenX;
    swipe_det.sY = t.screenY;
  },false);

  ele.addEventListener('touchmove',function(e){
    //e.preventDefault();
    var t = e.touches[0];
    swipe_det.eX = t.screenX;
    swipe_det.eY = t.screenY;

  },false);

  ele.addEventListener('touchend',function(e){
    //horizontal detection
    if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y))))
    {

      if(swipe_det.eX > swipe_det.sX && ((swipe_det.eX != 0) && (swipe_det.sX != 0)))
      {

        direc = "r";

      }
      else if((swipe_det.eX != 0) && (swipe_det.sX != 0))
      {

        direc = "l";

      }

    }

    //vertical detection
    if ((((swipe_det.eY - min_y > swipe_det.sY) || (swipe_det.eY + min_y < swipe_det.sY)) && ((swipe_det.eX < swipe_det.sX + max_x) && (swipe_det.sX > swipe_det.eX - max_x)))) {

      if(swipe_det.eY > swipe_det.sY)
      {

        direc = "d";

      }
      else
      {

        direc = "u";

      }

    }

    if (direc != ""){

      if(typeof func == 'function')
      {

        func(direc);

      }

    }
    direc = "";
    swipe_det.sX = 0;
    swipe_det.sY = 0;
    swipe_det.eX = 0;
    swipe_det.eY = 0;
    //document.body.style.overflow = "scroll";
  },false);
}
