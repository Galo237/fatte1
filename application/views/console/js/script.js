//Menu Toggle
const btnMobile = document.getElementById('btn-mobile');

function toggleMenu(event) {
  if (event.type === 'touchstart') event.preventDefault();
  const nav = document.getElementById('nav');
  nav.classList.toggle('active');
  const active = nav.classList.contains('active');
  event.currentTarget.setAttribute('aria-expanded', active);
  if (active) {
    event.currentTarget.setAttribute('aria-label', 'Fechar Menu');
  } else {
    event.currentTarget.setAttribute('aria-label', 'Abrir Menu');
  }
}

btnMobile.addEventListener('click', toggleMenu);
btnMobile.addEventListener('touchstart', toggleMenu);


// Função para confirmar logout
function confirmLogout(event) {
    event.preventDefault();
    var userConfirmed = confirm("Você realmente deseja se deslogar?");
    if (userConfirmed) {
        window.location.href = "?logout";
    }
}

//Chatbot
document.addEventListener("DOMContentLoaded", function() {
    const chatWindow = document.getElementById('chat-window');
    const userInput = document.getElementById('user-input');
    const sendButton = document.getElementById('send-button');
    const chatbotPopup = document.getElementById('chatbot');
    const openChatbotButton = document.getElementById('open-chatbot');
    const closeChatbotButton = document.getElementById('close-chatbot');
    const feedbackSection = document.getElementById('feedback-section');
    const feedbackText = document.getElementById('feedback-text');
    const sendFeedbackButton = document.getElementById('send-feedback');
    const cancelFeedbackButton = document.getElementById('cancel-feedback');

    const steps = [
        {
            message: "Olá, como posso ajudá-lo(a) hoje?<br>1. Realização do Pagamento<br>2. Carrinho de compras<br>3. Disponibilidade de produtos<br>4. Realização de cadastro ou login<br>5. Nenhuma das dúvidas acima<br>6. Enviar feedback de experiência.",
            options: {
                '1': 1,
                '2': 2,
                '3': 3,
                '4': 4,
                '5': 5,
                '6': 'feedback'
            }
        },
        {
            message: "Qual seu problema com o pagamento?<br>1. Problemas com a inserção dos dados de cartão de crédito<br>2. Métodos de pagamento aceitos no site<br>3. Dificuldades ao finalizar pagamento<br>4. Nenhuma das dúvidas acima",
            options: {
                '1': "- Verifique se inseriu os dados do cartão corretamente<br>- Se os dados estão inseridos correatamente e o erro ainda persistir, verifique os métodos de pagamento aceitos no site<br>- Se o erro ainda persistir você será redirecionado a um de nossos suportes. ",
                '2': "Os métodos de pagamento aceitos no site são:<br>- PayPal<br>- Boleto<br>- Pix<br>- Cartão de crédito(Visa, Mastercard, Elo, Itaú, Bradesco, Caixa)<br>- Cartão de débito(Visa, Mastercard, Elo, Itaú, Bradesco, Caixa)",
                '3': "Para dificuldades ao finalizar o pagamento, tente limpar o cache do navegador ou use outro navegador.",
                '4': "Por favor, entre em contato com nosso suporte para mais assistência."
            }
        },
        {
            message: "Qual seu problema com o carrinho de compras?<br>1. Itens não são adicionados ao carrinho<br>2. Erro ao visualizar carrinho de compra<br>3. Carrinho não é atualizado ao adicionar ou remover itens dele<br>4. Nenhuma das dúvidas acima",
            options: {
                '1': "- Atualize a página e tente adicionar os itens novamente, às vezes isso resolve problemas de conexão<br>- Limpe o cache do navegador ou use um navegador diferente<br>- Entrar contato com suporte",
                '2': "- Atualize a página e acesse o carrinho novamente<br>- Limpe o cache do navegador ou use um navegador diferente<br>- Entre em contato com o suporte",
                '3': "- Limpe o cache do navegador e tente novamente<br>- Tente adicionar ou remover os itens em um navegador diferente<br>- Entre em contato com o suporte",
                '4': "Nenhuma das dúvidas acima"
            }
        },
        {
            message: "Qual seu problema com a disponibilidade de produtos?<br>1. Informações desatualizadas<br>2. Produto fora de estoque<br>3. Problemas de exibição<br>4. Nenhuma das opções acima",
            options: {
                '1': "Produto listado está como disponível, mas falta no estoque<br>- Resposta do chatbot (teste): Verificar o status do produto<br>Estoque esgotado após adicionar item no carrinho<br>- Resposta do chatbot(teste): Gostaria de ser notificado quando o produto estiver disponível(sim/não)",
                '2': "Verificar disponibilidade do produto",
                '3': "Problemas ao visualizar disponibilidade de produtos<br>- Limpe a cache do navegador e atualize-o<br>- Contatar suporte humano",
                '4': "Nenhuma das opções acima"
            }
        },
        {
            message: "Qual seu problema com a realização de cadastro ou login<br>1. Cadastro<br>2. Login",
            options: {
                '1': "Problemas com senha<br> - Sua senha deve conter no mínimo 8 caracteres, uma letra maiúscula, uma minúscula, um número um caractere especial.<br>Email inválido<br> - Certifique-se que o email esteja no formato correto (exemplo@dominio.com)<br>Email ou telefone já cadastrados<br> - Tente usar um email ou telefone diferente<br> - Tente fazer login com email já cadastrado",
                '2': "Credenciais inválidas<br> - Verifique se o email e senha foram digitados corretamente<br> - Redefina sua senha<br>Email não registrado<br> - Verifique se o email foi digitado corretamente<br> - Se o problema persistir faça um novo cadastro<br>Senha incorreta<br> - Verifique se foi digitado corretamente<br> - Redefina sua senha",
                '3': "Nenhuma das opções acima"
            }
        }
    ];

    let currentStep = 0;

    function displayMessage(message, isUser = false) {
        const messageElement = document.createElement('div');
        messageElement.className = isUser ? 'alert alert-primary' : 'alert alert-secondary';
        messageElement.innerHTML = message;  // Use innerHTML to render HTML tags properly
        chatWindow.appendChild(messageElement);
        chatWindow.scrollTop = chatWindow.scrollHeight;
    }

    function handleUserInput() {
        const input = userInput.value.trim();
        if (!input) return;

        displayMessage(`Você: ${input}`, true);
        userInput.value = '';

        const step = steps[currentStep];
        const nextStep = step.options[input];

        if (nextStep !== undefined) {
            if (nextStep === 'feedback') {
                feedbackSection.style.display = 'block';
                chatWindow.style.display = 'none';
                userInput.style.display = 'none';
                sendButton.style.display = 'none';
            } else if (typeof nextStep === 'number') {
                currentStep = nextStep;
                displayMessage(steps[currentStep].message);
            } else {
                displayMessage(nextStep);
                currentStep = 0;  // Reset to initial step after a complete query
                displayMessage(steps[currentStep].message);
            }
        } else {
            displayMessage("Opção inválida. Tente novamente.");
            displayMessage(step.message);
        }
    }

    sendButton.addEventListener('click', handleUserInput);
    userInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            handleUserInput();
        }
    });

    openChatbotButton.addEventListener('click', function() {
        chatbotPopup.style.display = 'block';
        openChatbotButton.style.display = 'none';
        displayMessage(steps[0].message);
    });

    closeChatbotButton.addEventListener('click', function() {
        chatbotPopup.style.display = 'none';
        openChatbotButton.style.display = 'block';
        chatWindow.innerHTML = ''; // Clear chat window
        currentStep = 0; // Reset to initial step
        feedbackSection.style.display = 'none';
        chatWindow.style.display = 'block';
        userInput.style.display = 'block';
        sendButton.style.display = 'block';
    });

    sendFeedbackButton.addEventListener('click', function() {
        const feedback = feedbackText.value.trim();
        if (feedback) {
            alert("Obrigado pelo seu feedback!");
            feedbackText.value = '';
            feedbackSection.style.display = 'none';
            chatWindow.style.display = 'block';
            userInput.style.display = 'block';
            sendButton.style.display = 'block';
            currentStep = 0; // Reset to initial step
            displayMessage(steps[currentStep].message);
        } else {
            alert("Por favor, preencha o campo de feedback.");
        }
    });

    cancelFeedbackButton.addEventListener('click', function() {
        feedbackText.value = '';
        feedbackSection.style.display = 'none';
        chatWindow.style.display = 'block';
        userInput.style.display = 'block';
        sendButton.style.display = 'block';
        currentStep = 0; // Reset to initial step
        displayMessage(steps[currentStep].message);
    });
});