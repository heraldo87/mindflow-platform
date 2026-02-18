<?php
session_start();

// Se não houver sessão ativa, redireciona para o login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Define o nome do usuário com um fallback caso a sessão esteja incompleta
$usuario_nome = $_SESSION['user_name'] ?? 'Doutor';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | MindFlow</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Lexend:wght@500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        deepnavy: '#1A202C', // Texto principal e Sidebar 
                        mindteal: '#2DAAA5', // Ações e Botões 
                        mindteal_hover: '#248a86',
                        focusamber: '#F6AD55', // Alertas 
                        offwhite: '#F5F7FA',   // Fundo 
                        softslate: '#748594'   // Texto secundário
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Lexend', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #F5F7FA; }
        .card-shadow { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .sidebar-link:hover { background-color: rgba(45, 170, 165, 0.1); color: #2DAAA5; border-right: 3px solid #2DAAA5; }
        .sidebar-link.active { background-color: rgba(45, 170, 165, 0.15); color: #2DAAA5; border-right: 3px solid #2DAAA5; font-weight: 600; }
    </style>
</head>

<body class="text-deepnavy font-sans antialiased h-screen flex overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between hidden md:flex z-10 relative card-shadow">
        <div>
            <div class="h-20 flex items-center px-8 border-b border-gray-50">
                <div class="w-8 h-8 bg-deepnavy rounded-full flex items-end overflow-hidden mr-3">
                    <div class="w-full h-1/2 bg-mindteal"></div> 
                </div>
                <span class="font-display font-bold text-xl tracking-tight text-deepnavy">MindFlow</span>
            </div>

            <nav class="mt-6 px-4 space-y-1">
                <a href="dashboard.php" class="sidebar-link active flex items-center px-4 py-3 text-sm rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Visão Geral
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-3 text-sm text-gray-600 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z"></path></svg>
                    Agenda Inteligente
                </a>
                <a href="logout.php" class="sidebar-link flex items-center px-4 py-3 text-sm text-red-500 rounded-lg transition-colors group mt-auto">
                    Sair do Sistema
                </a>
            </nav>
        </div>
        
        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-mindteal/10 flex items-center justify-center text-mindteal">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-deepnavy"><?php echo htmlspecialchars($usuario_nome); ?></p>
                    <p class="text-xs text-gray-500">Psicólogo Clínico</p>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-y-auto bg-offwhite relative">
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-20">
            <div>
                <h1 class="font-display text-2xl font-semibold text-deepnavy">Bom dia, <?php echo explode(' ', $usuario_nome)[0]; ?></h1>
                <p class="text-sm text-gray-500 font-sans">A tecnologia MindFlow trabalha silenciosamente para você focar no paciente.</p>
            </div>

            <div class="flex items-center space-x-4">
                <button class="bg-mindteal hover:bg-mindteal_hover text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nova Sessão
                </button>
            </div>
        </header>

        <main class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white rounded-xl p-6 card-shadow border border-gray-50 md:col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-display font-semibold text-lg text-deepnavy">Agenda de Hoje</h3>
                        <a href="#" class="text-sm text-mindteal hover:underline font-medium">Ver calendário</a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-start p-3 hover:bg-offwhite rounded-lg transition-colors border-l-4 border-mindteal cursor-pointer">
                            <div class="w-16 text-center mr-4">
                                <span class="block text-lg font-bold text-deepnavy">09:00</span>
                                <span class="text-xs text-gray-400">AM</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-deepnavy">Ana Silva (Sessão Regular)</h4>
                                <p class="text-xs text-gray-500 mt-1">Videochamada • Link enviado</p>
                            </div>
                            <span class="px-2 py-1 bg-green-50 text-green-700 text-xs rounded-full font-medium">Confirmado via Zap</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-deepnavy rounded-xl p-6 card-shadow text-white relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-mindteal opacity-20 rounded-full blur-xl"></div>
                        <h3 class="font-display font-semibold text-lg mb-2 relative">Mind AI Lab</h3>
                        <p class="text-gray-300 text-sm mb-4">Robô gerenciando 3 conversas no WhatsApp agora.</p>
                        <div class="flex justify-between items-center text-sm border-t border-gray-700 pt-4">
                            <span>2 Confirmados</span>
                            <span class="text-focusamber">1 Remarcação</span>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>