
//for check validation 
$(document).ready(function(){
    $("#username").hide();
    $("#useremail").hide();
    $("#usernumber").hide();

   var user_name=false;
   var user_email=false;
   var user_number=false;

   $("#name").keyup(function(){
         username_check();
   });
   function username_check(){
       var name =$("#name").val();
       if(name.length == ''){
         $("#username").show();
         $("#username").html("*Please fill username.");
         $("#username").focus();
         $("#username").css("color","red");
         user_name=false;
         return false;
       }else if((name.length < 3) || (name.length > 15)){
        $("#username").show();
        $("#username").html("*Username must be greater than 3 character and less than 15.");
        $("#username").focus();
        $("#username").css("color","red");
        user_name=false;
        return false;
      }else{
       $("#username").hide(); 
      }
   }
    $("#email").keyup(function(){
        useremail_check();
  });
  function useremail_check(){
     var email_check = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var email =$("#email").val();
      if(email.length == '' ){
        $("#useremail").show();
        $("#useremail").html("*Please fill email-id");
        $("#useremail").focus();
        $("#useremail").css("color","red");
        user_email=false;
        return false;
      }else if(email.match(email_check)){
       $("#useremail").hide(); 
      }else{
        $("#useremail").show();
        $("#useremail").html("*Email-id not valid");
        $("#useremail").focus();
        $("#useremail").css("color","red");
        user_email=false;
        return false; 
      }
   }
   $("#mobile").keyup(function(){
    usermobile_check();
});
function usermobile_check(){
  var valid_number= /^[0-9]{10}$/ 
  var mobile =$("#mobile").val();
  if(mobile.length == ''){
    $("#usernumber").show();
    $("#usernumber").html("*Please fill mobile number");
    $("#usernumber").focus();
    $("#usernumber").css("color","red");
    user_number=false;
    return false;
  }else if(mobile.match(valid_number)){
    $("#usernumber").hide(); 
  }else{
    $("#usernumber").show();
    $("#usernumber").html("*Mobile number is not valid");
    $("#usernumber").focus();
    $("#usernumber").css("color","red");
    user_number=false;
    return false;
  }
}
   $("#submitform").click(function(){
     user_name=true;
     user_email=true;
     user_number=true;
     username_check();
     useremail_check();
     usermobile_check();

     if(user_name==true && user_email==true && user_number==true){
         return true;
     }else{
         return false;
     }
   })

});
