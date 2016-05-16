/**
 * @author : Umut M. Dabager <dabager@outlook.com>
 * Hospital Appointment System - GlobalScript.js
 * Written for the Cmpe 321 Assignment 3
 */

/**
 * @param id, Field Id of the validating field.
 */

function validateData(id)
{
    var error = "";
    var isvalid = false;
    var minLength = 0;
    var maxLength = 0;
    var fieldName = "";
    var control = document.getElementById(id);

    switch(id)
    {
        case "txt_editBranchname":
        case "txt_branchname":
            minLength = 4;
            maxLength = 25;
            fieldName = "Branch name";
            break;
        
        case "txt_name":
            minLength = 2;
            maxLength = 50;
            fieldName = "Name";
            break;

        case "txt_surname":
            minLength = 2;
            maxLength = 100;
            fieldName = "Surname";
            break;

        case "txt_username":
            minLength = 4;
            maxLength = 50;
            fieldName = "Username";
            break;

        case "txt_password":
            minLength = 8;
            maxLength = 50;
            fieldName = "Password";
            break;
    }

    if(control.value.length < minLength || control.value.length > maxLength )
    {
        error = fieldName + " must be between " + minLength + " and " + maxLength + " characters long.";
        control.className = control.className.replace(" borderless", " error");
        isvalid = false;
    }
    else
    {
        control.className = control.className.replace(" error", " borderless");
        isvalid = true;
    }

    document.getElementById(id.replace("txt","lbl")).innerHTML = error;

    return isvalid;
}

function validateRegistrationForm()
{
    var ageControl = document.getElementById("txt_age");
    var isvalid = true;

    if(!validateData("txt_name")) isvalid = false;
    if(!validateData("txt_surname")) isvalid = false;
    if(!validateData("txt_username")) isvalid = false;
    if(!validateData("txt_password")) isvalid = false;
    
    if(ageControl.value == "")
    {
        document.getElementById("lbl_password").innerHTML += "Please enter age!";
        ageControl.className = ageControl.className.replace(" borderless", " error");
        isvalid = false;
    }
    else
    {
        ageControl.className = ageControl.className.replace(" error", " borderless");
    }
    
    if(isvalid) return true;
    else return false;
}

function validateLoginForm()
{
    var isvalid = true;

    if(!validateData("txt_username")) isvalid = false;
    if(!validateData("txt_password")) isvalid = false;

    if(isvalid) return true;
    else return false;
}

function validateBranch(id)
{
    var isvalid = true;

    if(!validateData(id)) isvalid = false;

    if(isvalid) return true;
    else return false;
}

function comboboxToTextbox()
{
    var combobox = document.getElementById("cmb_branches");
    var textbox = document.getElementById("txt_editBranchname");
    
    textbox.value = combobox.options[combobox.selectedIndex].text;
}