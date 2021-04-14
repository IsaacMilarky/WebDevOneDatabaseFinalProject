function verifyAllFields() {
    var fieldAlert = document.getElementsByClassName("verify");
    for(var iter = 0; iter < fieldAlert.length; iter++)
    {
        if(fieldAlert[iter].value.trim() == "")
        {
            alert("Please Fill Out All Fields!");
            return false;
        }
    }
    return true;
}

