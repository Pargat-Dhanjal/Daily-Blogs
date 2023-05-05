document.getElementById('register').addEventListener('click', validation);

function checkEmail(email) {
  var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (re.test(email)) return true;
  else {
    alert('Please enter a valid email!');
    return false;
  }
}

function checkPassword(password) {
  var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;
  if (re.test(password)) return true;
  else {
    alert('Please enter a strong password!');
    return false;
  }
}

function checkPasswordMatch() {
  var password = document.getElementsByName('password')[0].value;
  var confirmPassword = document.getElementsByName('confirmpassword')[0].value;
  if (password !== confirmPassword) {
    alert('Passwords do not match.');
    return false;
  }
  return true;
}

function validation(event) {
  var email = document.getElementsByName('email')[0].value;
  var password = document.getElementsByName('password')[0].value;

  if (checkEmail(email) && checkPassword(password) && checkPasswordMatch()) {
    alert('Account Created Successfully');
    return true;
  } else {
    event.preventDefault();
    return false;
  }
}
