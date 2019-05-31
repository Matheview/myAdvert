/*Podstawowa walidacja rejestacji po stronie klienta  */

const signupBtn = document.querySelector("input.submit-btn");
const loginField = document.getElementById("loginInput");
const passwordField = document.getElementById("passwordInput");
const emailField = document.getElementById("emailInput");
const cityField = document.getElementById("cityInput");
const phoneNumberField = document.getElementById("phoneNumberInput");




validateForm = (e) => {

    e.preventDefault()

    if (loginField.value === "" || loginField.value.length < 3) {
        window.alert("Fill login field properly ! Your login must have more than 3 characters!");
        loginField.focus();
        return false;
    }

    if (passwordField.value === "" || passwordField.value.length < 3) {
        window.alert("Fill password field properly ! Your password must have more than 8 characters!");
        passwordField.focus();
        return false
    }

    if (emailField.value.indexOf("@") == -1 || emailField.value.length < 6) {
        window.alert("Fill email field properly !");
        emailField.focus();
        return false
    }

    if (isNaN(phoneNumberField.value) || phoneNumberField.value.length < 9) {
        window.alert("Fill Your phone number corectly !");
        phoneNumberField.focus();
        return false
    }

    if (cityField.value === "") {
        window.alert("Fill city name field properly ! ");
        loginField.focus();
        return false;
    }


    alert("Form submitted. You can now sign in too Your account !");
    return true

}

signupBtn.addEventListener("click", validateForm)