function checkIfEmailIsMatch(){
    const email = document.getElementById('email');
    const emailConfirm = document.getElementById('confirmEmail');
    // check if not empty
    if(email.value !== '' && emailConfirm.value !== '') {
        // check if password matches or not
        if(email.value === emailConfirm.value) {
            document.getElementById('message-response').innerHTML = "Email matches!"
        }
        else {
            document.getElementById('message-response').innerHTML = "Email doest not match!"
        }
    } 
    else {
        document.getElementById('message-response').innerHTML = ""
    }
}

// download the file generated as json
function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}

// set data to JSON file
function saveData() {
    //get radios
    var radioSize = document.getElementsByName('shirtSize');
    var shirtValue="";
    for (var i = 0, length = radioSize.length; i < length; i++) {
        if (radioSize[i].checked) {
            var shirtValue = radioSize[i].value;
            break;
        }
    }
    if ((document.getElementById("email").value === document.getElementById("confirmEmail").value)) {
        var input = {
            "firstName" : document.getElementById("firstName").value,
            "lastName" : document.getElementById("lastName").value,
            "emailAddress" : document.getElementById("email").value,
            "age" : document.getElementById("age").value,
            "plan" : document.getElementById("plans").value,
            "receiveEmail" : document.getElementById("receiveEmail").checked,
            "shirtSize" : shirtValue
        };
        download("registration.json",JSON.stringify(input));
    }
    else{
        alert("Email not the same");
    }
}            
