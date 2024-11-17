
//Variable declaration for the form input fields
let title = document.querySelector("#title");
let date = document.querySelector("#date");
let entry = document.querySelector("#entry");


let dateCheck = /^(0[1-9]|1[0-2])\/(0[1-9]|1[0-2])\/\d{4}$/; //regex used for date validaiton

//Error messages for each input field
let defaultMsg="";
let titleErrorMsg="Please enter a valid title";
let dateErrorMsg="Please choose an entry date";
let entryErrorMsg="Please create a valid entry";


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
   
    return valid;

}

//Function to validate the title field
function validTitle(){
    if (title.value.length > 0){ 
        title.style.border = "1px solid black";
        return true;
    } 
    
    else {    
        title.style.border = "2px solid red"; //changing the border to red if the input is invalid
        return false;
    }
}

//Function to validate the date field
function validDate(){
    if (dateCheck.test(date.value)){ 
        date.style.border = "1px solid black";
        return true;
    } 
    
    else {    
        date.style.border = "2px solid red"; //changing the border to red if the input is invalid
        return false;
    }
}

function validEntry(){
    if (entry.value.length > 0){ 
        entry.style.border = "1px solid black";
        return true;
    } 
    
    else {    
        entry.style.border = "2px solid red"; //changing the border to red if the input is invalid
        return false;
    }
}


//Revalidates the title input each time it's changed
title.addEventListener("blur",()=>{ 
    if (validTitle()){
        titleError.textContent = defaultMsg;
    } 
    else{
        titleError.textContent = titleErrorMsg;
    }
});

//Revalidates the date input each time it's changed
date.addEventListener("blur",()=>{ 
    if (validDate()){
        dateError.textContent = defaultMsg;
    } 
    else{
        dateError.textContent = dateErrorMsg;
    }
});

//Revalidates the entry input each time it's changed
entry.addEventListener("blur",()=>{ 
    if (validEntry()){
        entryError.textContent = defaultMsg;
    } 
    else{
        entryError.textContent = entryErrorMsg;
    }
});
