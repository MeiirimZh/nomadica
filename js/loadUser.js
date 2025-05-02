let userText = document.querySelector(".header-tools__user");

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return null;
}

if (getCookie("user")) {
    userText.textContent = getCookie("user");
}
else {
    userText.textContent = "Гость";
}