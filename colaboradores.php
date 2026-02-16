<?php
require_once __DIR__ . '/partial/header.php';
?>
<style>
    /* Tipografia e Cores MindFlow */
    body { font-family: 'Inter', sans-serif; background-color: #F5F7FA; color: #1A202C; } /* [cite: 4, 8] */
    h2 { font-family: 'Lexend', sans-serif; } /* [cite: 7] */
    .btn-primary { background-color: #2DAAA5; color: white; transition: all 0.3s; } /* [cite: 4] */
    .btn-primary:hover { background-color: #248a86; transform: translateY(-1px); }
    .card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); } /* [cite: 12] */
</style>

<body class="flex items-center justify-center min-h-screen p-6">
    <div class="card p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto mb-4 bg-[#1A202C] rounded-full flex items-end overflow-hidden shadow-sm">
                <div class="w-full h-1/2 bg-[#2DAAA5]"></div>
            </div>
            <h2 class="text-2xl font-bold text-[#1A202C]">Novo Colaborador</h2>
            <p class="text-gray-500 text-sm">Registre os dados técnicos e de contato.</p>
        </div>

        <form action="flow-handler.php" method="POST" class="space-y-4">
            
            <input type="hidden" name="form_type" value="cadastro_colaborador">

            <div>
                <label class="block text-sm font-medium mb-1">Nome Completo</label>
                <input type="text" name="nome" id="nome" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">E-mail Profissional</label>
                <input type="email" name="email" id="email" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Telefone</label>
                <input type="tel" name="telefone" id="telefone_colab" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none" 
                    placeholder="(00) 00000-0000">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Endereço Residencial</label>
                <input type="text" name="endereco" id="endereco_colab" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Função</label>
                <select name="role" id="role" 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none bg-white appearance-none">
                    <option value="psicologo">Psicólogo</option>
                    <option value="secretario">Secretário(a)</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>

            <button type="submit" class="w-full btn-primary py-3 rounded-lg font-semibold shadow-md mt-4">
                Cadastrar Colaborador
            </button>
            
            <a href="dashboard.php" class="block text-center text-xs text-gray-400 mt-4 hover:underline">
                Voltar ao Painel
            </a>
        </form>
    </div>
</body>
</html>