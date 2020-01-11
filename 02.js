function usernameValidity(username) {
    username.match(/^([\w]{5,12})$/) ? console.log("true") : console.log("false");
}

function passwordValidity(password) {
    password.match(/^[A-Z0-9!@#$%^&*_.]{7}$/) ? console.log("true") : console.log("false");
}