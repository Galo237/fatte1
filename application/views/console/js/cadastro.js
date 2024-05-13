const senhaInput = document.getElementById('password');
const confirmarSenhaInput = document.getElementById('confirmPassword');
const mensagem = document.getElementById('message');
const confirmMensagem = document.getElementById('message-confirm');
const continueButton = document.getElementById('continue-button');

function confereSenha() {
    const senha = senhaInput.value;
    const confirmarSenha = confirmarSenhaInput.value;
    var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/;

    if (senha.match(regex)) {
        mensagem.innerHTML = "";
        mensagem.style.display = "none";
        if (senha === confirmarSenha) {
            confirmMensagem.innerHTML = "";
            confirmMensagem.style.display = "none"; // Oculta a mensagem de erro
        } else {
            confirmMensagem.innerHTML = "As senhas não correspondem.";
            confirmMensagem.style.display = "block"; // Exibe a mensagem de erro
            confirmMensagem.style.fontSize = "10px"; // Tamanho da fonte
            confirmMensagem.style.color = "red"; // Cor do texto
        }
    } else {
        mensagem.innerHTML = "A senha deve conter pelo menos 8 caracteres, uma letra maiúscula, uma letra minúscula, um número e um caractere especial.";
        mensagem.style.display = "block"; // Exibe a mensagem de erro
        mensagem.style.fontSize = "10px"; // Tamanho da fonte
        mensagem.style.color = "red"; // Cor do texto
        mensagem.style.width="250px";
    }
}

senhaInput.addEventListener('input', confereSenha);
confirmarSenhaInput.addEventListener('input');
confereSenha();