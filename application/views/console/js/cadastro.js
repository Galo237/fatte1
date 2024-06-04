const form = document.getElementById("formulario");
const campos = document.querySelectorAll(".required");
const spans = document.querySelectorAll(".span-required");
const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
const senhaRegex = /^(?=.\d)(?=.[a-z])(?=.[A-Z])(?=.[$&@#])[0-9a-zA-Z$&@#]{8,}$/;

function setError(index) {
    campos[index].style.border = '2px solid #e63636';
    spans[index].style.display = 'block';
}

function removeError(index) {
    campos[index].style.border = '';
    spans[index].style.display = 'none';
}

function emailValidate() {
    if (!emailRegex.test(campos[0].value)) {
        setError(0);
    } else {
        removeError(0);
    }
}

function confirmEmailValidate() {
    if (campos[0].value !== campos[1].value) {
        setError(1);
    } else {
        removeError(1);
    }
}

function mainPasswordValidate() {
    if (campos[2].value.length < 8) {
        setError(2);
    } else {
        removeError(2);
    }
}

function confirmPasswordValidate() {
    if (campos[2].value !== campos[3].value) {
        setError(3);
    } else {
        removeError(3);
    }
}