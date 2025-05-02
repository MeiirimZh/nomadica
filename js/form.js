const signUpForm = document.querySelector(".sign-up-form");
const signInForm = document.querySelector(".sign-in-form");
const changeFormBtn = document.querySelector(".changeFormBtn");

let currentForm = "sign-in";

function validateForm() {
    let error_msg = document.querySelector(".form-error");
    let password = document.forms["sign-up"]["password"].value;
    let repeat_password = document.forms["sign-up"]["repeat_password"].value;

    if (password != repeat_password) {
        error_msg.innerHTML = "Пароли не совпадают!";
        return false;
    }
}

function changeForm() {
    if (currentForm == "sign-up") {
        signInForm.style.display = "flex";
        signUpForm.style.display = "none";
        changeFormBtn.innerHTML = "Зарегистрироваться";

        currentForm = "sign-in";
    }
    else {
        signUpForm.style.display = "flex";
        signInForm.style.display = "none";
        changeFormBtn.innerHTML = "Войти";

        currentForm = "sign-up";
    }
}