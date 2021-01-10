function checkIfEmailIsMatch(){
    const email = document.getElementById('email');
    const emailConfirm = document.getElementById('confirmEmail');
    const submit = document.getElementById('submitBtn');
    // check if not empty
    if(email.value !== '' && emailConfirm.value !== '') {
        // check if password matches or not
        if(email.value === emailConfirm.value) {
            document.getElementById('message-response').innerHTML = "Email matches!"
            submit.disabled = false
        }
        else {
            document.getElementById('message-response').innerHTML = "Email doest not match!"
            submit.disabled = false
        }
    } 
    else {
        document.getElementById('message-response').innerHTML = ""
        submit.disabled = false
    }
}

// download the file generated as json
function download(filename, text) {
    let element = document.createElement('a');
    // character encoding to json format is not supported by the internet explorer version 9 - 11
    // please choose another browser that has an ES6 support for javascript [all browser except IE will do]
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
    let radioSize = document.getElementsByName('shirtSize');
    let shirtValue="";
    for (let i = 0, length = radioSize.length; i < length; i++) {
        if (radioSize[i].checked) {
            shirtValue = radioSize[i].value;
            break;
        }
    }
    if ((document.getElementById("email").value === document.getElementById("confirmEmail").value)) {
        let input = {
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
