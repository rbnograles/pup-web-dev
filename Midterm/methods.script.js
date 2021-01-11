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
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}

function saveAs(fileName, file) {
    // force download using js manipulation is not supported by IE thus resulting in creating a conditional 
    // for the IE browser
    // mmsSaveOrOpenBlob is a native support for opening blob file for IE
    if (window.navigator && window.navigator.msSaveOrOpenBlob) {
        var myBlob = new Blob([file], {type: 'application/json'});
        window.navigator.msSaveOrOpenBlob(myBlob, fileName);
    } 
    else {
        // for chrome and other browser that supports force download
        download(fileName, file);
    }
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
        saveAs("registration.json", JSON.stringify(input));
    }
    else{
        alert("Email not the same");
    }
}            
