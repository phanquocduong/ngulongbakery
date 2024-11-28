function openLoginForm() {
    const loginForm = document.getElementById('loginForm');
    const forgotPassForm = document.getElementById('forgotPassForm');
    forgotPassForm.classList.remove('forgot-pass-form--active');
    loginForm.classList.add('login-form--active');
}

function openForgotPassForm() {
    const loginForm = document.getElementById('loginForm');
    const forgotPassForm = document.getElementById('forgotPassForm');
    loginForm.classList.remove('login-form--active');
    forgotPassForm.classList.add('forgot-pass-form--active');
}

const loginForm = new Validator('#loginForm');
const forgotPassForm = new Validator('#forgotPassForm');

function togglePassword(id, elm) {
    var passwordField = document.getElementById(id);
    var type = passwordField.type === 'password' ? 'text' : 'password';
    passwordField.type = type;
    if (passwordField.type === 'password') {
        elm.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
    } else {
        elm.innerHTML = '<i class="fa-solid fa-eye"></i>';
    }
}
