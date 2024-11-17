
//Variable declaration for the form input fields
let title = document.querySelector("#title");
let date = document.querySelector("#date");
let entry = document.querySelector("#entry");
let mood = document.querySelector('input[name=mood]:checked').value;

//Error messages for each input field
let defaultMsg="";
let titleErrorMsg="Please enter a valid title";
let dateErrorMsg="Please choose an entry date";
let entryErrorMsg="Please create a valid entry";
let moodErrorMsg="Please choose your mood for the day";

/*
* Creating the error message elements for each input field
* and appending them to the respective divs
*/

let titleError=document.createElement('p');
titleError.setAttribute("class","warning");
document.querySelectorAll("#title").append(titleError);

let dateError=document.createElement('p');
dateError.setAttribute("class","warning");
document.querySelectorAll("#date").append(dateError);

let entryError=document.createElement('p');
entryError.setAttribute("class","warning");
document.querySelectorAll("#entry").append(entryError);

let moodError=document.createElement('p');
moodError.setAttribute("class","warning");
document.querySelectorAll("#mood_div").append(moodError);

/* 
* Function to validate the form
* Sets an error message for each invalid input
* Prevents form submission until all inputs are valid
*/
function validate(){
    let valid = true;

    if (!validTitle()){
        titleError.textContent = titleErrorMsg;
        valid = false;
    }
    
    if (!validDate()){
        dateError.textContent = dateErrorMsg;
        valid = false;
    }

    if (!validEntry()){
        entryError.textContent = entryErrorMsg;
        valid = false;
    }

    if (!validMood()){
        moodError.textContent = moodErrorMsg;
        valid = false;
    }
    
    return valid;

}

//Function to validate the title field
function validTitle(){
    if (title.value.length > 0){ 
        email.style.border = "1px solid black";
        return true;
    } 
    
    else {    
        title.style.border = "2px solid red"; //changing the border to red if the input is invalid
        return false;
    }
}

//Function to validate the user name field
function validLogin(){
    if (login.value.length > 0 && login.value.length <= 30){ //checking if the input is between 1 and 30 characters
        login.style.border = "1px solid black";
        login.value = login.value.toLowerCase(); //converting the input to lowercase
        return true;
    } 
    
    else {    
        login.style.border = "2px solid red"; 
        return false;
    }

}

//Function to validate the password field
function validPass(){
    if (password.value.length >= 8){ //checking if the input is at least 8 characters long
        password.style.border = "1px solid black";
        return true;
    } 
    
    else {    
        password.style.border = "2px solid red";
        return false;
    }

}

//Function to validate the re-type password field
function validPass2(){
    if (password2.value.length == 0){ //checking if the input is empty
        password2.style.border = "2px solid red";
        return 1; //In this case the password is empty
    }

    else if (!(password.value === password2.value)){ //checking if the input matches the password field
        password2.style.border = "2px solid red";
        return 2; //In this case the passwords do not match
    }

    else{
        password2.style.border = "1px solid black";
        return 0; //In this case the re-typed password is valid
    }
    
}

//Function to validate the terms and conditions checkbox
function validTerms(){
    if (terms.checked){
        return true;
    }

    else{
        return false;
    }
}

/*
* Function to reset the form
* Clears all error messages and resets the border colors
*/
function resetForm() {
    emailError.textContent = defaultMsg;
    email.style.border = "1px solid black";

    loginError.textContent = defaultMsg;
    login.style.border = "1px solid black";

    passError.textContent = defaultMsg;
    password.style.border = "1px solid black";

    pass2Error.textContent = defaultMsg;
    password2.style.border = "1px solid black";
    
    newsWarning.textContent = defaultMsg;
    termsError.textContent = defaultMsg;
}

//Event listeners for the form fields
let form = document.querySelector("form");
form.addEventListener("reset", resetForm); //Calls reset function when the reset button is clicked

//Revalidates the email input each time it's changed
email.addEventListener("blur",()=>{ 
    if (validEmail()){
        emailError.textContent = defaultMsg;
    } 
    else{
        emailError.textContent = emailErrorMsg;
    }
});

//Revalidates the user name input each time it's changed
login.addEventListener("blur",()=>{
    if (validLogin()){
        loginError.textContent = defaultMsg;
    }
    else{
        loginError.textContent = loginErrorMsg;
    }
});

//Revalidates the password input each time it's changed
password.addEventListener("blur",()=>{
    if (validPass()){
        passError.textContent = defaultMsg;
    }
    else{
        passError.textContent = passErrorMsg;
    }
});

//Revalidates the re-type password input each time it's changed
password2.addEventListener("blur",()=>{
    if (validPass2() == 1){
        pass2Error.textContent = pass2EmptyMsg;
    }

    else if (validPass2() == 2){
        pass2Error.textContent = pass2ErrorMsg;
    }

    else{
        pass2Error.textContent = defaultMsg;
    }

});

//Activated the pop-up alert when the newsletter checkbox is checked
newsletter.addEventListener("change", function(){
    if(this.checked){
        newsWarning.textContent= newsMsg;
        window.alert("Please note you may receive spam.");
    }

    else{
        newsWarning.textContent = defaultMsg;
    }
});

//Revalidates the terms and conditions checkbox each time it's changed
terms.addEventListener("change", function(){
    if(validTerms()){
        termsError.textContent = defaultMsg;
    }
    
    else{
        termsError.textContent = termsErrorMsg;
    }
});