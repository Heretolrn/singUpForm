let form = document.forms["myform"];
let username = form.elements["username"];
let fullname = form.elements["fullname"];
let age = form.elements["age"];
let email = form.elements["email"];
let password = form.elements["password"];
let signupbtn = document.querySelector("#signupbtn");
let errorm = document.querySelector(".errorm");
let errorm2 = document.querySelector(".errorm2");

console.log("hello");
let errorborder = "1px solid red";

signupbtn.addEventListener("click", function (e) {
  e.preventDefault();
  if (username.value.length < 4) {
    username.style.border = errorborder;
    username.style.color = "red";
    errorm2.innerText = "username should not be less than 4 characters";
  } else if (fullname.value.length < 8) {
    fullname.style.border = errorborder;
    fullname.style.color = "red";
    errorm2.innerText = "fullname should not be less than 8 characters";
  } else if (password.value.length < 8) {
    password.style.border = errorborder;
    password.style.color = "red";
    errorm2.innerText = "password length should not be less than 8";
  } else {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/valid.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onload = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          console.log(this.responseText);
          if (this.responseText == "username exist") {
            errorm.innerText = "Username Already Exist";
            username.style.border = errorborder;
            username.style.color = "red";
          } else if (this.responseText == "email exist") {
            errorm.innerText = "Email Already Exist";
            email.style.border = errorborder;
            email.style.color = "red";
          } else if (this.responseText == "Data successfully inserted") {
            errorm.style.color = "lightgreen";
            errorm.innerText = "Sign up successful";
            username.value = "";
            fullname.value = "";
            age.value = "";
            email.value = "";
            password.value = "";
          }
        } else {
          console.log("error occurred");
        }
      } else {
        console.log("request is pending");
      }
    };

    let data = {
      username: username.value,
      fullname: fullname.value,
      age: age.value,
      email: email.value,
      password: password.value,
    };
    xhr.send(JSON.stringify(data));
  }
});

window.addEventListener("click", function (e) {
  if (e.target.getAttribute("id") !== "signupbtn") {
    username.style.border =
      fullname.style.border =
      password.style.border =
        "1px solid black";
    username.style.color =
      fullname.style.color =
      password.style.color =
        "black";
    errorm.innerText = "";
    errorm2.innerText = "";
  }
});
