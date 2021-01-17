// variables
// -- inputs
var customerName = document.getElementById('customerName')
var address = document.getElementById('address')
var contactName = document.getElementById('contactName')
var telNum = document.getElementById('telNum')
var mobileNum = document.getElementById('mobileNum')
var email = document.getElementById('email')

// -- form
var customerForm = document.getElementById('customerForm')
var root = document.getElementById('root-msg')

// special script to check the browser type -- result - iE11
var isIE = /*@cc_on!@*/false || !!document.documentMode;

if(isIE) {
    var elementDis = document.getElementById('wb-ie11-append-dis')
    var elementPos = document.getElementById('wb-ie11-append-pos')

    elementDis.classList.add('ie11-append-dis')
    elementPos.classList.add('ie11-append-pos')
}

function checkIfEmpty(value){
    if(value !== '') return true
    return false
}

// discard function
function discardPurchase() {
    customerName.value = ''
    address.value = ''
    contactName.value = ''
    telNum.value = ''
    mobileNum.value = ''
    email.value = ''

    // scroll upward to forms
    // clear form
    customerForm.scrollIntoView(true)
    root.innerHTML = ''
    root.classList.remove('error')
    root.classList.remove('success')
}

// try to purchase item
function sendPurchase() {
    // check inputs if it is not filled up
    var hasCustomerName = checkIfEmpty(customerName.value)
    var hasTelNum =  checkIfEmpty(telNum.value)
    var hasMobileNum = checkIfEmpty(mobileNum.value)
    var hasEmail = checkIfEmpty(email.value)

    if(!hasCustomerName && !hasTelNum && !hasMobileNum  && !hasEmail ){
        root.innerHTML = 'Oops! Please check your credential in order to proceed.'
        root.classList.add('error');
        // Add a class to the input field
        customerName.classList.add('input-err')
        mobileNum.classList.add('input-err')
        telNum.classList.add('input-err')
        email.classList.add('input-err')
        // scroll to the top form
        customerForm.scrollIntoView(true);
    }else {
        root.innerHTML = 'Hooray! Your purchase has been submitted.'
        root.classList.remove('error');
        root.classList.add('success');
        // remove input error
        customerName.classList.remove('input-err')
        mobileNum.classList.remove('input-err')
        telNum.classList.remove('input-err')
        email.classList.remove('input-err')
        // scroll to the top form
        customerForm.scrollIntoView(true);
    }
}

// NOTE: Internet Explorer does not support JSX syntax and causes unwanted behavior
// functionName = () => {} // not applicable
// function functionName(){} // accepted
