// Input Fields

const password = document.getElementById('password');
const confPassword = document.getElementById('confPassword');

//Form

const form = document.getElementById('myForm');

//Validation colors

const green = '#4CAF50'
const red = '#F44336'


//Handle Form

form.addEventListener('submit', function(event){
		if(
		validatePassword() && 
		validateConfirmPassword()
	){

		alert("Success");
	}
	
	else{
		alert("Correct Errors");
		// window.open("reset_password.php","_self");
	}
});


//Validators

function validatePassword(){
	//Empty Check
    if(checkIfEmpty(password)) return;
    //Length of Pwd
	if(!(meetLength(password, 4, 15))) return;
	// check password against character set
	// 1= a
	// 2- a 1
	// 3- A a 1
	// 4- A a 1 @
	if(!(containsCharacters(password,1)))return;
	return true;
}

function validateConfirmPassword(){
	if(password.className != 'valid'){
		setInvalid(confPassword, 'Password Must be valid');
		return;
	} 
	
	//If they match
	if(password.value != confPassword.value){
		setInvalid(confPassword, 'Passwords Must Match');
	}
	
	else{
		setValid(confPassword);
		return true;
	}
}

// Utility Functions

function checkIfEmpty(field){
	if(isEmpty(field.value.trim())){
	    //set field invalid
		setInvalid(field, `${field.name} must not be empty`);
		return true;
	}
	
	else{
		//set field valid
		setValid(field);
		return false;
	}
}

function isEmpty(value){
	if(value === '') return true;
	return false;
}

function setInvalid(field, message){
	field.className = 'invalid';
	field.nextElementSibling.innerHTML = message;
	field.nextElementSibling.style.color = red;
	field.style.border = "1px solid #F44336";
	field.style.borderRadius = "4px";
	field.style.paddingLeft = "10px";
	field.style.outline = "none !important";
}

function setValid(field){
	field.className = 'valid';
	field.nextElementSibling.innerHTML = '';
	field.style.border = "1px solid #4CAF50";
	field.style.paddingLeft = "10px";
	field.style.borderRadius = "4px";
	// field.nextElementSibling.style.color = green;
}

function checkIfOnlyLetters(field){
	if(/^[a-zA-Z ]+$/.test(field.value)){
		setValid(field);
		return true;
	}
	
	else{
	setInvalid(field, `${field.name} Must Contain Only letters`);
	    return false;
	}
}

function checkIfOnlyNumbers(field){
	if(/^[-+]?\d*$/.test(field.value)){
		setValid(field);
		return true;
	}
	
	else{
	setInvalid(field, `${field.name} Must Contain Only numbers`);
	    return false;
	}
}

function digLength(field, maxi){
	if(field.value.length >= maxi){
		setValid(field);
		return true;
	}
	
	else{
		setInvalid(field, `${field.name} Must Contain At least 10 Digits`);
	    return false;
	}
}

function checkExtension(field){	
  var file = document.querySelector('#file');
  if(/\.(pdf)$/i.test(file.files[0].name) === false) 
  { 
    setInvalid(field, `Please Upload only pdf files`);
	return false;   
  }
  
  else{
 	    setValid(field);
	    return true;
	}
}

function meetLength(field, minLength,maxLength){
	if((field.value.length >= minLength) && (field.value.length < maxLength)){
		setValid(field);
		return true;
	}
	
	else if(field.value.length < minLength){
		setInvalid(field, `${field.name} must be at least ${minLength} characters Long`);
		return false;
	}
    else{
        setInvalid(field, `${field.name} must be at shorter than ${maxLength} characters`);
		return false;
	}
}

function containsCharacters(field, code){
	let regEx;
	switch(code){
		case 1:
		//Letters 
		regEx = /(?=.*[a-zA-Z])/;
		return matchWithRegEx(regEx, field, 'Must Contain At least one letter');
		case 2:
		//Letters and Numbers
		regEx = /(?=.*\d)(?=.*[a-zA-Z])/;
		return matchWithRegEx(regEx, field, 'Must Contain At least one letter and one number');
		case 3:
		//Uppercase, Lowercase and Numbers
		regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
		return matchWithRegEx(regEx, field, 'Must Contain At least one uppercase, one Lowercase letters and one number');
		
		case 4:
		//Uppercase, Lowercase, Numbers and special char.
		regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/;
		return matchWithRegEx(regEx, field, 'Must Contain At least 1 uppercase, 1 Lowercase letters, 1 number and 1 special character');
		
		case 5:
		//Uppercase, Lowercase, Numbers and special char.
        regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return matchWithRegEx(regEx, field, 'Please Enter A valid E-mail address');
		
		default:
		return false;
	}
}

function matchWithRegEx(regEx, field, message){
    if(field.value.match(regEx)){
	    setValid(field);
		return true;
    }	
	else{
		setInvalid(field, message);
		return false;
	}
}

