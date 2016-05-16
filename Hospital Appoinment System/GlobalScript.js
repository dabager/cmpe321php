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

function validateRegistrationForm(id)
{
    var ageControl = document.getElementById("txt_age");
    var isvalid = true;

    if(!validateData("txt_name")) isvalid = false;
    if(!validateData("txt_surname")) isvalid = false;
    if(!validateData("txt_username")) isvalid = false;
    if(!validateData("txt_password")) isvalid = false;
    
    if(ageControl.value == "")
    {
        document.getElementById(id).innerHTML += "Please enter age!";
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

function validateCombobox(id,text)
{
    var isvalid = true;
    var combobox = document.getElementById(id);
    var label = document.getElementById(id.replace("cmb","lbl"));
    label.innerHTML = label.innerHTML.replace(text,"");
    if(combobox.value == -1)
    {
        isvalid = false;
        label.innerHTML += text;
        combobox.className = combobox.className.replace(" borderless", " error");
    }
    else
    {
        isvalid = true;
        combobox.className = combobox.className.replace(" error", " borderless");
    }
    return isvalid;
}

function validateAddDoctorForm()
{
    var ageControl = document.getElementById("txt_age");
    var isvalid = true;

    if(!validateCombobox("cmb_branches","Please select branch!")) isvalid = false;
    if(!validateData("txt_name")) isvalid = false;
    if(!validateData("txt_surname")) isvalid = false;

    if(ageControl.value == "")
    {
        var label = document.getElementById("lbl_branches");
        label.innerHTML = label.innerHTML.replace("Please enter age!","");
        label.innerHTML += " Please enter age!";
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