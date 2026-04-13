// Confirmação ao retirar veículo
document.addEventListener("DOMContentLoaded", () => {

    const botoesRetirar = document.querySelectorAll(".btn-retirar");

    botoesRetirar.forEach(btn => {
        btn.addEventListener("click", (e) => {
            const confirmacao = confirm("Deseja realmente retirar o veículo?");
            
            if (!confirmacao) {
                e.preventDefault();
            }
        });
    });

    // Auto esconder mensagens
    const mensagens = document.querySelectorAll(".mensagem");

    mensagens.forEach(msg => {
        setTimeout(() => {
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }, 3000);
    });

});