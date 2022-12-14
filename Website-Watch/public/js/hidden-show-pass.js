// ẩn hiện mật khẩu
var check_login = true;
var check_signup = true;
var confirm_check_signup = true;

function show_hidden_password_login() {
    console.log(check_login);
    if (check_login) {
        document.getElementById("passwordLogin").setAttribute("type", "text");
        document.getElementById("icon").setAttribute("class", "fas fa-times");
        check_login = false;
    } else {
        document.getElementById("passwordLogin").setAttribute("type", "password");
        document.getElementById("icon").setAttribute("class", "fas fa-eye");
        check_login = true;
    }
}
function confirm_show_hidden_password() {
    console.log(confirm_check_signup);
    if (confirm_check_signup) {
        document.getElementById("checkPassRegister").setAttribute("type", "text");
        document.getElementById("icon").setAttribute("class", "fas fa-times");
        confirm_check_signup = false;
    } else {
        document.getElementById("checkPassRegister").setAttribute("type", "password");
        document.getElementById("icon").setAttribute("class", "fas fa-eye");
        confirm_check_signup = true;
    }
}
function show_hidden_password() {
    console.log(check_signup);
    if (check_signup) {
        document.getElementById("passRegister").setAttribute("type", "text");
        document.getElementById("icon").setAttribute("class", "fas fa-times");
        check_signup = false;
    } else {
        document.getElementById("passRegister").setAttribute("type", "password");
        document.getElementById("icon").setAttribute("class", "fas fa-eye");
        check_signup = true;
    }
}
