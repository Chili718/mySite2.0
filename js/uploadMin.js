function uploadAndResizeImage() {

    //special thanks from tuanitpro on codepen for this function, slight changes were made
    //but the original fucntion can be found here:
    //https://codepen.io/tuanitpro/pen/wJZJbp?editors=1010
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        //getting all the files selected but only the first one will be used for obvious purposes
        var filesToUploads = document.getElementById('image').files;
        //the first file
        var file = filesToUploads[0];
        if(file){

            var reader = new FileReader();
            // Set the image once loaded into file reader
            reader.onload = function(e) {

                var img = document.createElement("img");
                img.src = e.target.result;

                img.onload = function(e){

                  var canvas = document.createElement("canvas");
                  var ctx = canvas.getContext("2d");
                  ctx.drawImage(img, 0, 0);

                  var MAX_WIDTH = 400;
                  var MAX_HEIGHT = 400;
                  var width = img.width;
                  var height = img.height;
                  //selecting the orienation of the image so it wont be squished
                  if (width > height) {
                      if (width > MAX_WIDTH) {
                          height *= MAX_WIDTH / width;
                          width = MAX_WIDTH;
                      }
                  } else {
                      if (height > MAX_HEIGHT) {
                          width *= MAX_HEIGHT / height;
                          height = MAX_HEIGHT;
                      }
                  }

                  canvas.width = width;
                  canvas.height = height;
                  var ctx = canvas.getContext("2d");

                  ctx.drawImage(img, 0, 0, width, height);

                  //converting the canvas image to a file types that can be sent through post
                  dataurl = canvas.toDataURL(file.type);
                  //console.log(dataurl);

                  //document.getElementById('test').src = dataurl;

                  var fd = new FormData(document.getElementById('frm'));
                  //appending min to the file name to keep a standard which will be send to the proper min folder 
                  var fileName = file.name.substring(0, file.name.lastIndexOf('.')) + "Min" + file.name.substring(file.name.lastIndexOf('.'));

                  //console.log(fileName);

                  fetch(dataurl)
                  .then(res => res.blob())
                  .then(blob => {
                    //appending the new min image to the existing file data that was submitted
                    fd.append("min", blob, fileName);

                    //const file = new File([blob], 'dot.png', blob)
                    /*
                    for (var [key, value] of fd.entries()) {
                      console.log(key, value);
                    }
                    */

                    $.ajax({

                      url:'php/upload.php',
                      type:'post',
                      data: fd,
                      processData: false,
  				            contentType: false,
                      success:function(php_result){

                        //document.getElementById('validateTXT').innerHTML = php_result;

                        switch(php_result){

                          case "success":
                            document.getElementById('successTxt').innerHTML = "Image Uploaded Successfully!";
                            setTimeout(function(){document.getElementById('successTxt').innerHTML = '';}, 6000);
                            break;
                          case "fail":
                            document.getElementById('errorTxt').innerHTML = "Image and or name already exists!";
                            setTimeout(function(){document.getElementById('errorTxt').innerHTML = '';}, 6000);
                            break;
                          case "dbf":
                            document.getElementById('errorTxt').innerHTML = "Whoops its either me or the internet!";
                            setTimeout(function(){document.getElementById('errorTxt').innerHTML = '';}, 6000);
                            break;
                          default:

                        }

                      },
                      error: function(xhr){

                      }

                    });

                  });
                }

            }
            reader.readAsDataURL(file);

        }

    }
    else
    {
      document.getElementById('errorTxt').innerHTML = "The File APIs are not fully supported in this browser.";
      setTimeout(function(){document.getElementById('errorTxt').innerHTML = '';}, 6000);
    }

}


function checkUpload(){
  //remove any existing messages from a previous attempt
  removeMsgs();

  var image = document.getElementById('image').value;
  var image_name = document.getElementById('imageNme').value;
  var image_des = document.getElementById('imageDes').value;
  var image_rating = document.getElementById('rating').value;

  //console.log(image);
  //checking if the user gave all the required fields upon function call
  if(image_name == '' || image == '' || image_des == '' || image_rating == '')
  {
    document.getElementById('errorTxt').innerHTML = 'Please complete all fields!';

    setTimeout(function(){
      document.getElementById('errorTxt').innerHTML = '';
    }, 6000);

    return false;

  }
  else
  {//getting the file extension of the given file to check if a proper file type was given
    var extension = document.getElementById('image').value.split('.').pop().toLowerCase();
    //console.log(extension);
    if (!['gif', 'png', 'jpg', 'jpeg'].includes(extension))
    {
      document.getElementById('errorTxt').innerHTML = 'Invalid File Type!';

      setTimeout(function(){
        document.getElementById('errorTxt').innerHTML = '';
      }, 6000);

      document.getElementById('image').value = '';
      return false;
    }
  }
  //after the file has been verified a smaller version of the file will be created for the gallery
  //squares icon for a much faster loading time
  uploadAndResizeImage();

}
