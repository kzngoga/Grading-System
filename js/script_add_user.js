// Input Fields
const lname = document.getElementById("lname");
const fname = document.getElementById("fname");
const email = document.getElementById("email");
const address = document.getElementById("address");
const phone = document.getElementById("phone");
const gender = document.getElementById("gender");
const role = document.getElementById("role");

//Form

const form = document.getElementById("myForm");

//Validation colors

const green = "#4CAF50";
const red = "#F44336";

//Handle Form

form.addEventListener("submit", function(event) {
  if (
    validatelastName() &&
    validatefirstName() &&
    validateEmail() &&
    validateAddress() &&
    validateGender() &&
    validateRole() &&
    validateMobile()
  ) {
  } else {
    alert("Correct Errors");
    event.preventDefault();
  }
});

//Validators
function validateGender() {
  if (selectIsEmpty(gender)) return;
  return true;
}

function validateRole() {
  if (selectIsEmpty(role)) return;
  return true;
}

function validatelastName() {
  //check if is empty
  if (checkIfEmpty(lname)) return;
  //check if has only letters
  if (!checkIfOnlyLetters(lname)) return;
  return true;
}

function validatefirstName() {
  //check if is empty
  if (checkIfEmpty(fname)) return;
  //check if has only letters
  if (!checkIfOnlyLetters(fname)) return;
  return true;
}

function validateAddress() {
  if (selectIsEmpty(address)) return;
  return true;
}

function validateMobile() {
  //check if is empty
  if (checkIfEmpty(phone)) return;
  //check if has only numbers
  if (!checkIfOnlyNumbers(phone)) return;
  //check if has 10 Digits
  if (!digLength(phone, 10)) return;
  return true;
}

function validateEmail() {
  if (checkIfEmpty(email)) return;
  if (!containsCharacters(email, 5)) return;
  return true;
}

// Utility Functions

function selectIsEmpty(field) {
  if (SisEmpty(field.value.trim())) {
    //set field invalid
    setInvalid(field, `Field must not be empty`);
    return true;
  } else {
    //set field valid
    setValid(field);
    return false;
  }
}

function SisEmpty(value) {
  if (value === "0") return true;
  return false;
}

function checkIfEmpty(field) {
  if (isEmpty(field.value.trim())) {
    //set field invalid
    setInvalid(field, `Field must not be empty`);
    return true;
  } else {
    //set field valid
    setValid(field);
    return false;
  }
}

function isEmpty(value) {
  if (value === "") return true;
  return false;
}

function setInvalid(field, message) {
  field.className = "invalid";
  field.nextElementSibling.innerHTML = message;
  field.nextElementSibling.style.color = red;
  field.style.border = "1px solid #F44336";
  field.style.borderRadius = "4px";
  field.style.paddingLeft = "10px";
  field.style.outline = "none !important";
}

function setValid(field) {
  field.className = "valid";
  field.nextElementSibling.innerHTML = "";
  field.style.border = "1px solid #4CAF50";
  field.style.borderRadius = "4px";
  field.style.paddingLeft = "10px";
  field.style.outline = "none !important";
}

function checkIfOnlyLetters(field) {
  if (/^[a-zA-Z ]+$/.test(field.value)) {
    setValid(field);
    return true;
  } else {
    setInvalid(field, `Field Must Contain Only letters`);
    return false;
  }
}

function checkIfOnlyNumbers(field) {
  if (/^[-+]?\d*$/.test(field.value)) {
    setValid(field);
    return true;
  } else {
    setInvalid(field, `Field Must Contain Only numbers`);
    return false;
  }
}

function digLength(field, maxi) {
  if (field.value.length >= maxi) {
    setValid(field);
    return true;
  } else {
    setInvalid(field, `Field Must Contain At least 10 Digits`);
    return false;
  }
}

function checkExtension(field) {
  var file = document.querySelector("#file");
  if (/\.(pdf)$/i.test(file.files[0].name) === false) {
    setInvalid(field, `Please Upload only pdf files`);
    return false;
  } else {
    setValid(field);
    return true;
  }
}

function meetLength(field, minLength, maxLength) {
  if (field.value.length >= minLength && field.value.length < maxLength) {
    setValid(field);
    return true;
  } else if (field.value.length < minLength) {
    setInvalid(field, `Field must be at least ${minLength} characters Long`);
    return false;
  } else {
    setInvalid(field, `Field must be at shorter than ${maxLength} characters`);
    return false;
  }
}

function containsCharacters(field, code) {
  let regEx;
  switch (code) {
    case 1:
      //Letters
      regEx = /(?=.*[a-zA-Z])/;
      return matchWithRegEx(regEx, field, "Must Contain At least one letter");
    case 2:
      //Letters and Numbers
      regEx = /(?=.*\d)(?=.*[a-zA-Z])/;
      return matchWithRegEx(
        regEx,
        field,
        "Must Contain At least one letter and one number"
      );
    case 3:
      //Uppercase, Lowercase and Numbers
      regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
      return matchWithRegEx(
        regEx,
        field,
        "Must Contain At least one uppercase, one Lowercase letters and one number"
      );

    case 4:
      //Uppercase, Lowercase, Numbers and special char.
      regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/;
      return matchWithRegEx(
        regEx,
        field,
        "Must Contain At least 1 uppercase, 1 Lowercase letters, 1 number and 1 special character"
      );

    case 5:
      //Uppercase, Lowercase, Numbers and special char.
      regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return matchWithRegEx(
        regEx,
        field,
        "Please Enter A valid E-mail address"
      );

    default:
      return false;
  }
}

function matchWithRegEx(regEx, field, message) {
  if (field.value.match(regEx)) {
    setValid(field);
    return true;
  } else {
    setInvalid(field, message);
    return false;
  }
}
