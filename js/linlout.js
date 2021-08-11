function login(){

  var xhr = new XMLHttpRequest();
  var data = new FormData(document.querySelector("form"));
  xhr.open("POST", "php/login.php", true);
  xhr.addEventListener("readystatechange", function(){
    if (xhr.readyState === 4 && xhr.status === 200){
      //alert(xhr.responseText);
      if (xhr.responseText === "true") {
        window.location = "index.php";
      }else {
        if(xhr.responseText === "notVer")
        {
          document.getElementById('validateTXT').innerHTML = 'You must verify your account before you can login, please check your email.';
        }
        else if (xhr.responseText === "DBF")
        {
          document.getElementById('validateTXT').innerHTML = 'Looks like its the internet, or me though.';
        }
        else
        {
          document.getElementById('validateTXT').innerHTML = 'Invalid Username or Password';
        }

        setTimeout(function(){
          document.getElementById('validateTXT').innerHTML = '';
        }, 5000);
      }
    }
  });
  xhr.send(data);
}


function logout(){
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../php/logout.php", true);
  xhr.addEventListener("readystatechange", function(){
    if (xhr.readyState === 4 && xhr.status === 200){

        window.location = "https://jonticedesigns.com/login.php";

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
            location.href = 'php/logout.php';
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
