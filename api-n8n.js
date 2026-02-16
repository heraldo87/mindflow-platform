/**
 * MindFlow API Client - Minimalista e Eficiente
 * Conecta o Frontend ao Backend (n8n)
 */

const N8N_WEBHOOK_URL = 'https://n8n.alunosdamedicina.com/webhook-test/mindflow'; // Ajuste o path conforme seu workflow

async function sendToFlow(data, type) {
    console.log(`[MindFlow] Iniciando fluxo para: ${type}`);
    
    try {
        const response = await fetch(N8N_WEBHOOK_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Action-Type': type // Útil para o n8n rotear (Login, Clínica ou Colaborador)
            },
            body: JSON.stringify(data)
        });

        if (!response.ok) throw new Error('Falha na comunicação com o servidor');

        const result = await response.json();
        return { success: true, data: result };

    } catch (error) {
        console.error('[MindFlow Error]:', error);
        return { success: false, message: error.message };
    }
}