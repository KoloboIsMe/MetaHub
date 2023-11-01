const hamburgerButton = document.querySelector(".hamburger")
const navigation = document.querySelector("nav")

hamburgerButton.addEventListener ("click", toggleNav)

function toggleNav() {
    hamburgerButton.classList.toggle("active")
    navigation.classList.toggle("active")
}
function validateForm() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var passwordConfirmation = document.getElementById('password_confirmation').value;
    var passwordConfirmationError = document.getElementById('password_confirmation_error');

    if (username === '' || password === '' || passwordConfirmation === '') {
        passwordConfirmationError.innerHTML = 'il faut remplir tous les champs';
        return false;
    }
    if (password !== passwordConfirmation) {
        passwordConfirmationError.innerHTML = 'Les mots de passe ne correspondent pas';
        return false;
    }

    return true;
}