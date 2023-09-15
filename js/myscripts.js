function validateName() {
    var letters = /^[A-Za-z\s]+$/;

    var name= document.getElementById("uname");
    var lblError = document.getElementById("lblErrorName");    
   
      if(name.value.match(letters))
      {
        lblError.innerHTML="";
        
        return true;
      }
     
        lblError.innerHTML="Name field required only alphabet characters";
        
        return false;
      
  }
  
  function validateEmail(){
    var email= document.getElementById("email").value; 
    var lblError = document.getElementById("lblErrorEmail");
      lblError.innerHTML = "";
      var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
     if(email==""){
      lblError.innerHTML="Email is required";
      
      return false;
     }
     if (!expr.test(email)) {
          lblError.innerHTML = "Invalid email address.";
          
          return false;
      }
    
        lblError.innerHTML="";
        
        return true;
      
  }
  
  function validatePhone(){
    var phone=document.getElementById("phone").value;
    var lblError=document.getElementById("lblErrorPhone");
    lblError.innerHTML = "";
    const phonePattern = /^[6-9]\d{9}$/;
    if(phone==""){
      lblError.innerHTML="Mobile number is required";
      
      return false;
     }
     if (!phonePattern.test(phone)){
      lblError.innerHTML="Enter a valid mobile number (10 digits)";
      return false;
     }
     if(phone.length>10){
      lblError.innerHTML="Only 10 digit is possible";
      return false;
     }
     lblError.innerHTML="";
        
     return true;
   

  }

  function validatePassword(){
    var pwd= document.getElementById("pwd").value;
    var lblError = document.getElementById("lblErrorPass");
          pattern= /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;
           if(pwd==" ")
          {
              lblError.innerHTML="Please enter Password";
             
              return false;
          }
          if(!pattern.test(pwd))
          {
            lblError.innerHTML="Feild should conatin one special charater and one number";
            
            return false;
          }
           if(document.getElementById("pwd").value.length < 6)
          {
            lblError.innerHTML="Password minimum length is 6 ";
           
            return false;
          }
           if(document.getElementById("pwd").value.length > 12)
          {
            lblError.innerHTML="Password max length is 12";
            
            return false;
          }
          
            lblError.innerHTML=" ";
            
            return true;
          
  }
  function validateRepeatPassword(){
    var pwd= document.getElementById("pwd").value;
    var rpwd= document.getElementById("repeat-pwd").value;
    var lblError = document.getElementById("lblErrorRepeatPass");
    if(rpwd==""){
      lblError.innerHTML="Enter confirm password";
     
      return false;
    }
     if(pwd!=rpwd){
      lblError.innerHTML="Password not matched";
      
      return false;
    }
    
      lblError.innerHTML=" ";
     
      return true;
    
  }
  
  function validatePincode(){
    var pin = document.getElementById("pincode").value;
    var lblError= document.getElementById("lblErrorPincode");
    var postPattern = /^[1-9][0-9]{5}$/;
    if(pin==""){
      lblError.innerHTML="Pincode is required";
      return false;
    }
    else if (!postPattern.test(pin)){
      lblError.innerHTML="enter valid pin";
      return false;
     }
     else{    
      lblError.innerHTML=" ";
     
      return true;
     }

  }

  function validateFlat(){
    var flat = document.getElementById("flat").value;
    var lblError= document.getElementById("lblErrorFlat");

    if(flat==""){
      lblError.innerHTML="The feild is required";
      return false;
    }
    else{
      lblError.innerHTML=" ";  
      return true;
    }

  }

  function validateArea(){
    var area = document.getElementById("area").value;
    var lblError= document.getElementById("lblErrorArea");

    if(area==""){
      lblError.innerHTML="The feild is required";
      return false;
    }
    else{
      lblError.innerHTML=" ";  
      return true;
    }

  }

  function validateRegister(){
    var letters = /^[A-Za-z\s]+$/;
    var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    pattern= /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;

    var name= document.getElementById("uname");
    var lblErrorName = document.getElementById("lblErrorName"); 
    if(name.value.match(letters))
    {
      lblErrorName.innerHTML="";
      
      return true;
    }
   
      lblErrorName.innerHTML="Name field required only alphabet characters";
      
      return false;   
   
  }
