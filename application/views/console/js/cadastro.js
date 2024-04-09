const senhaInput = document.getElementById('password');
const confirmarSenhaInput = document.getElementById('confirmPassword');
const mensagem = document.getElementById('message');
const continueButton = document.getElementById('continue-button');

function verificarSenha() {
    const senha = senhaInput.value;
    const confirmarSenha = confirmarSenhaInput.value;

        if (senha == confirmarSenha) {
            mensagem.textContent = '';
            continueButton.disabled = false;
        } else {
            mensagem.textContent = 'As senhas não conferem';
            mensagem.style.backgroundColor = 'red';
            continueButton.disabled = true;
        }
}

senhaInput.addEventListener('input', verificarSenha);
confirmarSenhaInput.addEventListener('input', verificarSenha);
continueButton.addEventListener("click", verificarSenha);