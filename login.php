<?php
// 1. Início da Sessão e Lógica de Redirecionamento
session_start();

// Se o usuário já estiver logado (sessão ativa), redireciona direto para o Dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// 2. Inclusão do Header (contém o Tailwind e Fontes)
require_once __DIR__ . '/partial/header.php';
?>

<body class="flex items-center justify-center min-h-screen bg-[#F5F7FA]"> <div class="card p-8 w-full max-w-md bg-white rounded-xl shadow-lg"> <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-[#1A202C] rounded-full flex items-end overflow-hidden shadow-sm"> <div class="w-full h-1/2 bg-[#2DAAA5]"></div> </div>
            <h1 class="text-2xl font-bold text-[#1A202C] font-[Lexend]">MindFlow</h1> <p class="text-gray-500 text-sm">Gestão Psicológica Inteligente</p>
        </div>

        <form id="loginForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1 text-[#1A202C]">E-mail</label>
                <input type="email" name="email" id="email" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none transition-all"
                    placeholder="exemplo@clinica.com">
            </div>
            
            <div>
                <label class="block text-sm font-medium mb-1 text-[#1A202C]">Senha</label>
                <input type="password" name="senha" id="password" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none transition-all"
                    placeholder="••••••••">
            </div>

            <div id="loginAlert" class="hidden p-3 bg-orange-100 text-[#F6AD55] text-sm rounded-lg border border-[#F6AD55]"> </div>

            <button type="submit" class="w-full btn-primary py-3 rounded-lg font-semibold mt-4 shadow-md hover:translate-y-[-1px] transition-all">
                Entrar
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="cadastro_consultorio.php" class="text-xs text-gray-400 hover:text-[#2DAAA5] transition-colors">
                Não possui conta? Cadastre seu Consultório
            </a>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const alertBox = document.getElementById('loginAlert');
            const formData = new FormData(e.target);
            
            try {
                // Enviamos para o processador de autenticação
                const response = await fetch('auth_handler.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    window.location.href = 'dashboard.php';
                } else {
                    // Feedback visual em Focus Amber caso falhe 
                    alertBox.textContent = result.message || 'Erro ao entrar.';
                    alertBox.classList.remove('hidden');
                }
            } catch (error) {
                console.error("Erro no fluxo:", error);
                alertBox.textContent = 'Erro de conexão com o servidor.';
                alertBox.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>