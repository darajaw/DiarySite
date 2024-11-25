
//Variable declaration for the form input fields
let title = document.querySelector("#entry_title");
let date = document.querySelector("#entry_date");
let entry = document.querySelector("#entry");
let mood = document.querySelector('input[name="mood"]:checked');

let dateCheck = /^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/; //regex used for date validaiton

//Error messages for each input field
let defaultMsg="";
let titleErrorMsg="Please enter a valid title";
let dateErrorMsg="Please choose an entry date";
let entryErrorMsg="Please create a valid entry";
let moodErrorMsg="Please select a mood";


/*
* Creating the error message elements for each input field
* and appending them to the respective divs
*/
let titleError=document.createElement('p');
titleError.setAttribute("class","warning");
document.querySelectorAll(".textfield")[0].append(titleError);

let dateError=document.createElement('p');
dateError.setAttribute("class","warning");
document.querySelectorAll(".textfield")[1].append(dateError);

let entryError=document.createElement('p');
entryError.setAttribute("class","warning");
document.querySelectorAll(".textfield")[2].append(entryError);

let moodError=document.createElement('p');
moodError.setAttribute("class","warning");
document.querySelectorAll("#mood_bar")[0].append(moodError);

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

    console.log(valid);

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

function validMood(){
    let mood = document.querySelector('input[name="mood"]:checked');
    if (mood==null){
        return false;
    }

    else{
        return true;
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

document.querySelectorAll('input[name="mood"]').forEach((radio) => {
    radio.addEventListener("change", () => {
        if (validMood()) {
            moodError.textContent = defaultMsg;
        } else {
            moodError.textContent = moodErrorMsg;
        }
    });
});
