<?php
require_once __DIR__ . '/partial/header.php';
?>
<body class="flex items-center justify-center min-h-screen">
    <div class="card p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-16 h-16 mx-auto mb-4 bg-[#1A202C] rounded-full flex items-end overflow-hidden">
                <div class="w-full h-1/2 bg-[#2DAAA5]"></div>
            </div>
            <h1 class="text-2xl font-bold">MindFlow</h1>
            <p class="text-gray-500 text-sm">Gestão Psicológica Inteligente</p>
        </div>

        <form id="loginForm" class="space-y-4" action="processar.php" method="POST">
            <div>
                <label class="block text-sm font-medium mb-1">E-mail</label>
                <input type="email" id="email" name="email" required class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Senha</label>
                <input type="password" id="password" name="senha" required class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
            </div>
            <button type="submit" class="w-full btn-primary py-3 rounded-lg font-semibold mt-4">Entrar</button>
        </form>
    </div>
</body>
</html>