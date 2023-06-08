// ẩn hiện mật khẩu
var check_login = true;
var check_signup = true;
var confirm_check_signup = true;
var check_profile = true;
var confirm_check_profile = true;

function changeTypeInput(input, type, icon) {
    switch (type) {
        case "text":
            document.getElementById(input).setAttribute("type", type);
            document.getElementById(icon).setAttribute("class", "fas fa-times");
            break;
        case "password":
            document.getElementById(input).setAttribute("type", type);
            document.getElementById(icon).setAttribute("class", "fas fa-eye");
            break;
    }
}
// show or hidden password in page profile
function show_hidden_password_profile() {
    if (check_profile) {
        changeTypeInput("pass-Profile", "text","iconProfile");
        check_profile = false;
    } else {
        changeTypeInput("pass-Profile", "password","iconProfile");
        check_profile = true;
    }
}
function confirm_show_hidden_password_profile() {
    if (confirm_check_profile) {
        changeTypeInput("checkPass-Profile", "text","iconCProfile");
        confirm_check_profile = false;
    } else {
        changeTypeInput("checkPass-Profile", "password","iconCProfile");
        confirm_check_profile = true;
    }
}
// show or hidden password in page login

function show_hidden_password_login() {
    if (check_login) {
        changeTypeInput("passwordLogin", "text","iconLogin");
        check_login = false;
    } else {
        changeTypeInput("passwordLogin", "password","iconLogin");
        check_login = true;
    }
}

// show or hidden password in page register
function confirm_show_hidden_password() {
    if (confirm_check_signup) {
        changeTypeInput("checkPassRegister", "text","iconCRegister");
        confirm_check_signup = false;
    } else {
        changeTypeInput("checkPassRegister", "password","iconCRegister");
        confirm_check_signup = true;
    }
}
function show_hidden_password() {
    if (check_signup) {
        changeTypeInput("passRegister", "text","iconRegister");
        check_signup = false;
    } else {
        changeTypeInput("passRegister", "password","iconRegister");
        check_signup = true;
    }
}
