function uploadAndResizeImage() {

    //special thanks from tuanitpro on codepen for this function, slight changes were made
    //but the original fucntion can be found here:
    //https://codepen.io/tuanitpro/pen/wJZJbp?editors=1010
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var filesToUploads = document.getElementById('image').files;
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


                  dataurl = canvas.toDataURL(file.type);
                  //console.log(dataurl);

                  //document.getElementById('test').src = dataurl;

                  var fd = new FormData(document.getElementById('frm'));

                  var fileName = file.name.substring(0, file.name.lastIndexOf('.')) + "Min" + file.name.substring(file.name.lastIndexOf('.'));

                  //console.log(fileName);

                  fetch(dataurl)
                  .then(res => res.blob())
                  .then(blob => {
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
                            document.getElementById('confirm').innerHTML = "Image Uploaded Successfully!";
                            setTimeout(function(){document.getElementById('confirm').innerHTML = '';}, 3000);
                            break;
                          case "fail":
                            document.getElementById('validateTXT').innerHTML = "Image and or name already exists!";
                            setTimeout(function(){document.getElementById('validateTXT').innerHTML = '';}, 3000);
                            break;
                          case "dbf":
                            document.getElementById('validateTXT').innerHTML = "Whoops its either me or the internet!";
                            setTimeout(function(){document.getElementById('validateTXT').innerHTML = '';}, 3000);
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

    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
}


function checkUpload(){

  var image = document.getElementById('image').value;
  var image_name = document.getElementById('imageNme').value;
  var image_des = document.getElementById('imageDes').value;

  //console.log(image);

  if(image_name == '' || image == '' || image_des == '')
  {
    document.getElementById('validateTXT').innerHTML = 'Please complete all fields!';

    setTimeout(function(){
      document.getElementById('validateTXT').innerHTML = '';
    }, 3000);

    return false;

  }
  else
  {
    var extension = document.getElementById('image').value.split('.').pop().toLowerCase();
    //console.log(extension);
    if (!['gif', 'png', 'jpg', 'jpeg'].includes(extension))
    {
      document.getElementById('validateTXT').innerHTML = 'Invalid File Type!';

      setTimeout(function(){
        document.getElementById('validateTXT').innerHTML = '';
      }, 3000);

      document.getElementById('image').value = '';
      return false;
    }
  }

  uploadAndResizeImage();

}
