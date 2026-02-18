<?php
session_start();

// 1. LÓGICA CORRETA: Se já estiver logado, joga pro Dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

require_once __DIR__ . '/partial/header.php';
?>

<body class="flex items-center justify-center min-h-screen bg-[#F5F7FA]"> <div class="card p-8 w-full max-w-md bg-white rounded-xl shadow-lg border border-gray-100"> <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-[#1A202C] rounded-full flex items-end overflow-hidden shadow-sm">
                <div class="w-full h-1/2 bg-[#2DAAA5]"></div> </div>
            <h1 class="text-2xl font-bold text-[#1A202C] font-[Lexend]">MindFlow</h1> <p class="text-gray-500 text-sm font-[Inter]">Gestão Psicológica Inteligente</p>
        </div>

        <form id="loginForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1 text-[#1A202C]">E-mail</label>
                <input type="email" name="email" id="email" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none transition-all font-[Inter]"
                    placeholder="exemplo@clinica.com">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1 text-[#1A202C]">Senha</label>
                <input type="password" name="password" id="password" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none transition-all font-[Inter]"
                    placeholder="••••••••">
            </div>

            <div id="loginAlert" class="hidden p-3 bg-orange-50 text-[#d97706] text-sm rounded-lg border border-[#F6AD55]/30 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span id="alertMsg">Erro ao entrar</span>
            </div>

            <button type="submit" class="w-full btn-primary bg-[#2DAAA5] text-white py-3 rounded-lg font-semibold mt-4 shadow-md hover:bg-[#248a86] hover:translate-y-[-1px] transition-all">
                Entrar
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="cadastro_consultorio.php" class="text-xs text-gray-400 hover:text-[#2DAAA5] transition-colors font-[Inter]">
                Não possui conta? Cadastre seu Consultório
            </a>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const alertBox = document.getElementById('loginAlert');
            const alertMsg = document.getElementById('alertMsg');
            const submitBtn = e.target.querySelector('button[type="submit"]');
            
            // Feedback de carregamento
            const originalBtnText = submitBtn.innerText;
            submitBtn.innerText = "Entrando...";
            submitBtn.disabled = true;
            alertBox.classList.add('hidden');

            const formData = new FormData(e.target);
            
            try {
                const response = await fetch('auth_handler.php', {
                    method: 'POST',
                    body: formData
                });
                
                // Verifica se a resposta é JSON válido
                const textResult = await response.text();
                let result;
                try {
                    result = JSON.parse(textResult);
                } catch (err) {
                    throw new Error("Resposta inválida do servidor: " + textResult);
                }
                
                if (result.success) {
                    window.location.href = 'dashboard.php';
                } else {
                    alertMsg.textContent = result.message || 'E-mail ou senha incorretos.';
                    alertBox.classList.remove('hidden');
                }
            } catch (error) {
                console.error("Erro no fluxo:", error);
                alertMsg.textContent = 'Erro de conexão. Verifique o console.';
                alertBox.classList.remove('hidden');
            } finally {
                submitBtn.innerText = originalBtnText;
                submitBtn.disabled = false;
            }
        });
    </script>
</body>
</html>