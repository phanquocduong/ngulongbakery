const form1 = new Validator('.change-password-form.active');
const form2 = new Validator('.reset-password-form.active');

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
