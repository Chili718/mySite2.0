function createUser(){

  var xhr = new XMLHttpRequest();

  var data = new FormData(document.querySelector("form"));

  xhr.open("POST", "php/user.php", true);

  xhr.addEventListener("readystatechange", function(){

    if (xhr.readyState === 4 && xhr.status === 200){
      //alert(xhr.responseText);
      if (xhr.responseText === "true") {
        document.getElementById('successTxt').innerHTML = 'User Added Successfully, an email was sent to verify their account!';

        removeSetTimeOut('successTxt');

        document.getElementById('frm').reset();

      }else{
        //starting with the most general case and getting more specific as the if goes on
        if(xhr.responseText === "false"){

          document.getElementById('errorTxt').innerHTML = 'Existing Username or Email';

        }
        else
        {//if all else then this response will show for other responses and DB failures
          document.getElementById('errorTxt').innerHTML = 'Looks like its the internet, or me though.';
        }


        removeSetTimeOut('errorTxt');

      }
    }
  });
  xhr.send(data);
}

function validateData(){

  //remove any existing messages from a previous attempt
  removeMsgs();

  var userNme = document.getElementById('userNME').value;
  var pswrd = document.getElementById('pswrd').value;
  var pswrdR = document.getElementById('pswrdR').value;
  var email = document.getElementById('email').value;

  //reg expression for an email
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  if(userNme == '' || pswrd == '' || pswrdR == '' || email == '')
  {
    document.getElementById('errorTxt').innerHTML = 'Please complete all fields!';

    removeSetTimeOut('errorTxt');

    return false;

  }
  else if(userNme.length < 4)
  {

    document.getElementById('errorTxt').innerHTML = 'Username must be at least 4 characters!';

    removeSetTimeOut('errorTxt');

    return false;

  }
  else if(pswrd != pswrdR)
  {

    document.getElementById('errorTxt').innerHTML = 'Passwords Do Not Match!';

    removeSetTimeOut('errorTxt');

    return false;

  }//I should make you add a special character but I don't want or need to do that for this
  else if(pswrd.length < 8 || pswrd.match(RegExp('(?=.*[0-9])+(?=.*[A-Z])')) == null)
  //regular expression checking for at least one number and capitol letter
  {

    document.getElementById('errorTxt').innerHTML = 'Password length must be at least 8 characters and contain 1 number and 1 capitol letter!';

    removeSetTimeOut('errorTxt');

    return false;


  }
  else if(!regex.test(email))
  {

    document.getElementById('errorTxt').innerHTML = 'Invalid Email Given';

    removeSetTimeOut('errorTxt');

    return false;

  }

  createUser();

}
