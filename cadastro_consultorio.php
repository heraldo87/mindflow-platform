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
                [cite_start]<div class="w-full h-1/2 bg-[#2DAAA5]"></div> /* [cite: 10] */
            </div>
            <h2 class="text-2xl font-bold text-[#1A202C]">Cadastre seu Consultório</h2>
            <p class="text-gray-500 text-sm">Inicie a gestão inteligente com clareza.</p>
        </div>

        <form action="flow-handler.php" method="POST" class="space-y-4">
            
            <input type="hidden" name="form_type" value="cadastro_clinica">

            <div>
                <label class="block text-sm font-medium mb-1">Nome Fantasia</label>
                <input type="text" name="nome_fantasia" id="nome_fantasia" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">CNPJ ou CPF</label>
                <input type="text" name="documento" id="documento" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Telefone de Contato</label>
                <input type="tel" name="telefone" id="telefone" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none" 
                    placeholder="(00) 00000-0000">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Endereço Completo</label>
                <input type="text" name="endereco" id="endereco" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none"
                    placeholder="Rua, nº, Bairro, Cidade - UF">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">E-mail Administrativo</label>
                <input type="email" name="email_admin" id="email_admin" required 
                    class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
            </div>

            <button type="submit" class="w-full btn-primary py-3 rounded-lg font-semibold shadow-md mt-4">
                Concluir Cadastro
            </button>
            
            <a href="login.php" class="block text-center text-xs text-gray-400 mt-4 hover:underline">
                Já possui conta? Entrar
            </a>
        </form>
    </div>
</body>
</html>