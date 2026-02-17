<?php
// Simulação de sessão (no futuro, validaremos via JWT/PHP Session)
$usuario_nome = "Dr. Heraldo";
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
                        softslate: '#748594'   // Texto secundário (baseado na imagem Branding.png)
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
        /* Ajustes finos de UI */
        body { background-color: #F5F7FA; }
        .card-shadow { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); } /* Sombra leve  */
        .sidebar-link:hover { background-color: rgba(45, 170, 165, 0.1); color: #2DAAA5; border-right: 3px solid #2DAAA5; }
        .sidebar-link.active { background-color: rgba(45, 170, 165, 0.15); color: #2DAAA5; border-right: 3px solid #2DAAA5; font-weight: 600; }
    </style>
</head>

<body class="text-deepnavy font-sans antialiased h-screen flex overflow-hidden">

    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between hidden md:flex z-10 relative card-shadow">
        <div>
            <div class="h-20 flex items-center px-8 border-b border-gray-50">
                <div class="w-8 h-8 bg-deepnavy rounded-full flex items-end overflow-hidden mr-3">
                    <div class="w-full h-1/2 bg-mindteal"></div> </div>
                <span class="font-display font-bold text-xl tracking-tight text-deepnavy">MindFlow</span>
            </div>

            <nav class="mt-6 px-4 space-y-1">
                <a href="#" class="sidebar-link active flex items-center px-4 py-3 text-sm rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Visão Geral
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-3 text-sm text-gray-600 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Agenda Inteligente
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-3 text-sm text-gray-600 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Pacientes
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-3 text-sm text-gray-600 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                    Telemedicina
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-3 text-sm text-gray-600 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    Mind AI Lab <span class="ml-auto bg-focusamber text-white text-[10px] px-2 py-0.5 rounded-full">BETA</span>
                </a>
                <a href="#" class="sidebar-link flex items-center px-4 py-3 text-sm text-gray-600 rounded-lg transition-colors group">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Financeiro
                </a>
            </nav>
        </div>
        
        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-deepnavy"><?php echo $usuario_nome; ?></p>
                    <p class="text-xs text-gray-500">Psicólogo Clínico</p>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-y-auto bg-offwhite relative">
        
<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-20">
            <div class="md:hidden">
                <span class="font-display font-bold text-lg text-deepnavy">MindFlow</span>
            </div>
            
            <div class="hidden md:block">
                <h1 class="font-display text-2xl font-semibold text-deepnavy">Bom dia, <?php echo $usuario_nome; ?></h1>
                <p class="text-sm text-gray-500 font-sans">Sua tecnologia trabalha silenciosamente para você focar no paciente.</p>
            </div>

            <div class="flex items-center space-x-4">
                <button class="bg-mindteal hover:bg-mindteal_hover text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nova Sessão
                </button>
                
                <div class="relative cursor-pointer">
                    <svg class="w-6 h-6 text-gray-400 hover:text-deepnavy transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-focusamber rounded-full border-2 border-white"></span>
                </div>
            </div>
        </header>

        <main class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white rounded-xl p-6 card-shadow border border-gray-50 md:col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-display font-semibold text-lg text-deepnavy">Agenda de Hoje</h3>
                        <a href="#" class="text-sm text-mindteal hover:underline font-medium">Ver calendário completo</a>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-start p-3 hover:bg-offwhite rounded-lg transition-colors border-l-4 border-mindteal cursor-pointer">
                            <div class="w-16 text-center mr-4">
                                <span class="block text-lg font-bold text-deepnavy">09:00</span>
                                <span class="text-xs text-gray-400">AM</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-deepnavy">Ana Silva (Sessão Regular)</h4>
                                <p class="text-xs text-gray-500 flex items-center mt-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    Videochamada • Link gerado
                                </p>
                            </div>
                            <span class="px-2 py-1 bg-green-50 text-green-700 text-xs rounded-full font-medium">Confirmado via Zap</span>
                        </div>

                        <div class="flex items-start p-3 hover:bg-offwhite rounded-lg transition-colors border-l-4 border-focusamber cursor-pointer">
                            <div class="w-16 text-center mr-4">
                                <span class="block text-lg font-bold text-deepnavy">11:00</span>
                                <span class="text-xs text-gray-400">AM</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-deepnavy">Carlos Eduardo</h4>
                                <p class="text-xs text-gray-500 mt-1">Primeira Consulta • Presencial</p>
                            </div>
                            <span class="px-2 py-1 bg-yellow-50 text-yellow-700 text-xs rounded-full font-medium">Aguardando Confirmação</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-deepnavy rounded-xl p-6 card-shadow text-white relative overflow-hidden group">
                        <div class="absolute -right-4 -top-4 w-24 h-24 bg-mindteal opacity-20 rounded-full blur-xl group-hover:opacity-30 transition-opacity"></div>
                        
                        <h3 class="font-display font-semibold text-lg mb-2 z-10 relative">Assistente IA</h3>
                        <p class="text-gray-300 text-sm mb-4 font-sans">O robô está gerenciando 3 conversas no WhatsApp agora.</p>
                        
                        <div class="flex justify-between items-center text-sm border-t border-gray-700 pt-4">
                            <span>2 Confirmados</span>
                            <span class="text-focusamber">1 Remarcação</span>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 card-shadow border border-gray-50">
                        <h3 class="font-display font-semibold text-gray-600 text-sm mb-2">Faturamento (Mês)</h3>
                        <div class="flex items-end gap-2">
                            <span class="text-3xl font-bold text-deepnavy">R$ 12.450</span>
                            <span class="text-xs text-green-600 font-medium mb-1.5 flex items-center">
                                <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                +12%
                            </span>
                        </div>
                        <div class="mt-4 h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full bg-mindteal w-3/4 rounded-full"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Meta: R$ 15.000</p>
                    </div>
                </div>

            </div>

            <h3 class="font-display font-semibold text-lg text-deepnavy mb-4">Ferramentas de Gestão</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                
                <a href="#" class="bg-white p-4 rounded-xl card-shadow border border-gray-50 hover:-translate-y-1 transition-transform group">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center mb-3 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-deepnavy text-sm">Mind AI Lab</h4>
                    <p class="text-xs text-gray-500 mt-1">Pesquisa de abordagens e RAG.</p>
                </a>

                <a href="#" class="bg-white p-4 rounded-xl card-shadow border border-gray-50 hover:-translate-y-1 transition-transform group">
                    <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center mb-3 group-hover:bg-green-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-deepnavy text-sm">Gerador de Guias</h4>
                    <p class="text-xs text-gray-500 mt-1">TISS e Recibos de Convênio.</p>
                </a>
                
                 <a href="#" class="bg-white p-4 rounded-xl card-shadow border border-gray-50 hover:-translate-y-1 transition-transform group">
                    <div class="w-10 h-10 bg-teal-50 text-mindteal rounded-lg flex items-center justify-center mb-3 group-hover:bg-mindteal group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </div>
                    <h4 class="font-semibold text-deepnavy text-sm">Link Consultório</h4>
                    <p class="text-xs text-gray-500 mt-1">Enviar link de agendamento.</p>
                </a>

                <a href="#" class="bg-white p-4 rounded-xl card-shadow border border-gray-50 hover:-translate-y-1 transition-transform group">
                    <div class="w-10 h-10 bg-gray-50 text-gray-600 rounded-lg flex items-center justify-center mb-3 group-hover:bg-deepnavy group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="font-semibold text-deepnavy text-sm">Configurações</h4>
                    <p class="text-xs text-gray-500 mt-1">Clínica e Usuários.</p>
                </a>

            </div>

        </main>
    </div>

</body>
</html>