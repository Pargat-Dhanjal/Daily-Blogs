function checkPasswordMatch() {
    var password = document.getElementsByName("password")[0].value;
    console.log(document.getElementsByName("password")[0].value)
    var confirmPassword = document.getElementsByName("confirmpassword")[0].value;
    console.log(confirmPassword)
    if (password == confirmPassword) {
        alert("Ban gya bahi account");
        return true;
    }
    else {
        alert("Passwords do not match.");
        return false;
    }
}