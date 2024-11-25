/*
name: Stephanie Prystupa-Maule 
student #: 041109739
filename: script.js
date created: Nov. 7th, 2024
purpose: JavaScript Form Validation for Assignment 2 Diary Registration Form
*/

/* Inputs */
let emailInput=document.querySelector("#email");
let usernameInput=document.querySelector("#username");
let passwordInput=document.querySelector("#pass");
let rePasswordInput=document.querySelector("#pass2");
let termsInput=document.querySelector("#terms");


/* Display Error Messages/Warnings */
let emailError=document.createElement('p');
emailError.setAttribute("class","warning");
document.querySelectorAll(".textfield")[0].append(emailError);

let usernameError=document.createElement('p');
usernameError.setAttribute("class","warning");
document.querySelectorAll(".textfield")[1].append(usernameError);

let passwordError=document.createElement('p');
passwordError.setAttribute("class","warning");
document.querySelectorAll(".textfield")[2].append(passwordError);

let rePasswordError=document.createElement('p');
rePasswordError.setAttribute("class","warning");
document.querySelectorAll(".textfield")[3].append(rePasswordError);

let termsError=document.createElement('p');
termsError.setAttribute("class","warning");
document.querySelectorAll(".checkbox")[0].append(termsError);


/* Define Error Messages */
let defaultMsg="";

let emailErrorMsg="Please enter a valid email (format xyz@xyz.xyz)";
let usernameErrorMsg="Please enter a valid username (maximum 29 characters)";
let passwordErrorMsg="Please enter a valid password (mininum 8 characters)";
let rePasswordErrorMsg="Passwords must match";
let termsErrorMsg="You must agree to the terms and conditions before proceeding";


/* Validation Methods for Each Input */
function validateEmail(){
    let email = emailInput.value;
    let regexp=/\S+@\S+\.\S+/; //required format xyz@xyz.xyz
    
    if(regexp.test(email)){
    error = defaultMsg;}
    else {
    error = emailErrorMsg;}
    return error;
}

function validateusername(){
    let username = usernameInput.value;
    let regexp=/\w+/;
    let maxLength=29;
    
    if(regexp.test(username) && (username.length<=maxLength)){
    error = defaultMsg;}
    else {
    error = usernameErrorMsg;}
    return error;
}

function validatePassword(){
    let password = passwordInput.value;
    let minLength=8;
    
    if(password.length>=minLength){
    error = defaultMsg;}
    else {
    error = passwordErrorMsg;}
    return error;
}

function validateRePassword(){
    let password = passwordInput.value;
    let rePassword = rePasswordInput.value;
    let regexp=/[\w\W]+/; //cannot be blank
    
    if(rePassword==password && regexp.test(rePassword)){
    error = defaultMsg;}
    else {
    error = rePasswordErrorMsg;}
    return error;
}

function validateTerms(){
    if(termsInput.checked)
    return defaultMsg;
    else
    return termsErrorMsg;
}


/* Validation on Submit Event */
function validate(){
    let valid = true;

    let emailValidation=validateEmail();
    if(emailValidation!==defaultMsg){
        emailError.textContent = emailValidation;
        valid = false;    
    }

    let usernameValidation=validateusername();
    if(usernameValidation!==defaultMsg){
        usernameError.textContent = usernameValidation;
        valid = false;
    }

    let passwordValidation=validatePassword();
    if(passwordValidation!==defaultMsg){
        passwordError.textContent = passwordValidation;
        valid = false;
    }

    let rePasswordValidation=validateRePassword();
    if(rePasswordValidation!==defaultMsg){
        rePasswordError.textContent = rePasswordValidation;
        valid = false;
    }

    let termsValidation=validateTerms();
    if(termsValidation!==defaultMsg){
        termsError.textContent = termsValidation;
        valid = false;
    }

    return valid;
};


/* Resetting Form Errors */
function resetFormErrors() {
    emailError.textContent=defaultMsg;
    usernameError.textContent=defaultMsg;
    passwordError.textContent=defaultMsg;
    rePasswordError.textContent=defaultMsg;
    termsError.textContent=defaultMsg;
}
document.form.addEventListener("reset",resetFormErrors);


/* Clearing Error Messages after Valid Input */
function resetFormErrors() {
    emailError.textContent=defaultMsg;
    usernameError.textContent=defaultMsg;
    passwordError.textContent=defaultMsg;
    rePasswordError.textContent=defaultMsg;
    termsError.textContent=defaultMsg;
}
document.form.addEventListener("reset",resetFormErrors);
//document.form.addEventListener("reset",resetFormErrors);

emailInput.addEventListener("blur",function(){
    let emailValidation=validateEmail();
    if(emailValidation==defaultMsg){
        emailError.textContent = defaultMsg;
    }
    });

usernameInput.addEventListener("blur",function(){
    let usernameValidation=validateusername();
    if(usernameValidation==defaultMsg){
        usernameError.textContent = defaultMsg;
    }
    });

passwordInput.addEventListener("blur",function(){
    let passwordValidation=validatePassword();
    if(passwordValidation==defaultMsg){
        passwordError.textContent = defaultMsg;
    }
    });

rePasswordInput.addEventListener("blur",function(){
    let rePasswordValidation=validateRePassword();
    if(rePasswordValidation==defaultMsg){
        rePasswordError.textContent = defaultMsg;
    }
    });

termsInput.addEventListener("change",function(){
    if(this.checked){
        termsError.textContent= defaultMSg;
    }
    });
    
    

