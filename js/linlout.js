var tmeOut;

function login(){

  var xhr = new XMLHttpRequest();

  var data = new FormData(document.querySelector("form"));

  xhr.open("POST", "php/login.php", true);

  xhr.addEventListener("readystatechange", function(){

    if (xhr.readyState === 4 && xhr.status === 200){
      //alert(xhr.responseText);
      if (xhr.responseText === "true") {
        window.location = "index.php";
      }else{
        //starting with the most general case and getting more specific as the if goes on
        if(xhr.responseText === "false"){

          document.getElementById('errorTxt').innerHTML = 'Invalid Username or Password';

        }
        else if(xhr.responseText === "notVer")
        {
          document.getElementById('errorTxt').innerHTML = 'You must verify your account before you can login, please check your email.';
        }
        else
        {//if all else then this response will show for other responses and DB failures
          document.getElementById('errorTxt').innerHTML = 'Looks like its the internet, or me though.';
        }

        if(tmeOut){

          clearTimeout(tmeOut);

        }

        //remove the response text after 10 seconds
        tmeOut = setTimeout(function(){
          document.getElementById('errorTxt').innerHTML = '';
        }, 10000);

      }
    }
  });
  xhr.send(data);
}


function logout(){
  //run the logout script which destroys the session and returns the logged out
  //user to the home page
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php/logout.php", true);
  xhr.addEventListener("readystatechange", function(){
    if (xhr.readyState === 4 && xhr.status === 200){

        window.location = "login.php";

    }
    else {
      console.log(xhr.readyState);
      console.log(xhr.status);
      console.log(xhr.responseText);
    }
  });
  xhr.send();
}


//special thanks to Tim from thisintrestsme.com for the start of this function :)
function activityWatcher(){

    //The number of seconds that have passed
    //since the user was active.
    var secondsSinceLastActivity = Date.now();

    secondsSinceLastActivity = (secondsSinceLastActivity / 1000).toFixed(0);

    var seconds = (Date.now() / 1000).toFixed(0);

    //Five minutes. 60 x 2 = 120 seconds.
    var maxInactivity = (60 * 10);

    //Setup the setInterval method to run
    //every second. 1000 milliseconds = 1 second.
    setInterval(function(){
        //secondsSinceLastActivity++;
        seconds = (Date.now() / 1000).toFixed(0);

        //console.log((seconds - secondsSinceLastActivity) + ' seconds since the user was last active');
        //if the user has been inactive or idle for longer
        //then the seconds specified in maxInactivity
        if((seconds - secondsSinceLastActivity) > maxInactivity){
            console.log('User has been inactive for more than ' + maxInactivity + ' seconds');
            //Redirect them to your logout.php page.
            logout();
            location.href = 'login.php';
        }
    }, 5000);

    //The function that will be called whenever a user is active
    function activity(){
        //reset the secondsSinceLastActivity variable
        //back to 0
        secondsSinceLastActivity = seconds;


    }

    //An array of DOM events that should be interpreted as
    //user activity.
    var activityEvents = [
        'mousedown', 'mousemove', 'keydown',
        'scroll', 'touchstart'
    ];

    //add these events to the document.
    //register the activity function as the listener parameter.
    activityEvents.forEach(function(eventName) {
        document.addEventListener(eventName, activity, true);
    });


}
/*
function logoutMaybe(){
  //temporary fix
  if(!window.location.href.contains(".php")){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "php/logout.php", true);
    xhr.send();
  }
}
*/
