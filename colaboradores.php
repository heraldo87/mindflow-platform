<?php
require_once __DIR__ . '/partial/header.php';

/**
 * ====== CONEXÃO COM O BANCO (mysqli) ======
 * Ajuste as credenciais conforme seu ambiente.
 */
$db_host = "181.215.135.63";
$db_user = "mindflow_user";
$db_pass = "5MajT6zT3hdwLXte";
$db_name = "mindflow_db";

$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
    die("Erro de conexão com o banco: " . $mysqli->connect_error);
}
$mysqli->set_charset("utf8mb4");

/**
 * ====== BUSCA CLÍNICAS ======
 */
$clinicas = [];
$sql = "SELECT id, nome_fantasia FROM clinicas ORDER BY nome_fantasia ASC";
$result = $mysqli->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $clinicas[] = $row;
    }
    $result->free();
}

$temClinicas = (count($clinicas) > 0);
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <style>
      body { font-family: 'Inter', sans-serif; background-color: #F5F7FA; color: #1A202C; }
      h2 { font-family: 'Lexend', sans-serif; }
      .btn-primary { background-color: #2DAAA5; color: white; transition: all 0.3s; }
      .btn-primary:hover { background-color: #248a86; transform: translateY(-1px); }
      .card { background: white; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen p-6">
  <div class="card p-8 w-full max-w-md">
      <div class="text-center mb-8">
          <div class="w-14 h-14 mx-auto mb-4 bg-[#1A202C] rounded-full flex items-end overflow-hidden shadow-sm">
              <div class="w-full h-1/2 bg-[#2DAAA5]"></div>
          </div>
          <h2 class="text-2xl font-bold text-[#1A202C]">Novo Colaborador</h2>
          <p class="text-gray-500 text-sm">Registre os dados técnicos e de contato.</p>
      </div>

      <form id="formColaborador" action="php/processar_cadastro_colaborador.php" method="POST" class="space-y-4">
          <input type="hidden" name="form_type" value="cadastro_colaborador">

          <!-- CLÍNICA -->
          <div>
              <label class="block text-sm font-medium mb-1">Clínica</label>
              <select name="clinica_id" id="clinica_id" required
                  class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none bg-white appearance-none">
                  <option value="" selected disabled>Selecione uma clínica</option>
                  <?php foreach ($clinicas as $c): ?>
                      <option value="<?= htmlspecialchars($c['id'], ENT_QUOTES, 'UTF-8') ?>">
                          <?= htmlspecialchars($c['nome_fantasia'], ENT_QUOTES, 'UTF-8') ?>
                      </option>
                  <?php endforeach; ?>
              </select>

              <?php if (!$temClinicas): ?>
                  <p class="text-xs text-red-500 mt-2">
                      Nenhuma clínica cadastrada. Cadastre uma clínica antes de criar colaboradores.
                  </p>
              <?php endif; ?>
          </div>

          <!-- DADOS -->
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

          <!-- SENHA -->
          <div>
              <label class="block text-sm font-medium mb-1">Senha</label>
              <input type="password" name="senha" id="senha" required minlength="6"
                  class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
              <p class="text-xs text-gray-500 mt-1">Mínimo de 6 caracteres.</p>
          </div>

          <div>
              <label class="block text-sm font-medium mb-1">Confirmar Senha</label>
              <input type="password" name="confirmar_senha" id="confirmar_senha" required minlength="6"
                  class="w-full p-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-[#2DAAA5] outline-none">
              <p id="erro_senha" class="text-xs text-red-500 mt-1 hidden">As senhas não coincidem.</p>
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

          <button
              id="btnSubmit"
              type="submit"
              class="w-full btn-primary py-3 rounded-lg font-semibold shadow-md mt-4"
              <?= (!$temClinicas) ? 'disabled style="opacity:.6; cursor:not-allowed;"' : '' ?>>
              Cadastrar Colaborador
          </button>

          <a href="dashboard.php" class="block text-center text-xs text-gray-400 mt-4 hover:underline">
              Voltar ao Painel
          </a>
      </form>
  </div>

  <script>
    const form = document.getElementById("formColaborador");
    const senha = document.getElementById("senha");
    const confirmar = document.getElementById("confirmar_senha");
    const erro = document.getElementById("erro_senha");

    function validarSenhas() {
      // Se ainda não digitou confirmação, não mostra erro.
      if (confirmar.value === "") {
        erro.classList.add("hidden");
        confirmar.setCustomValidity("");
        return true;
      }

      if (senha.value !== confirmar.value) {
        erro.classList.remove("hidden");
        confirmar.setCustomValidity("Senhas diferentes");
        return false;
      } else {
        erro.classList.add("hidden");
        confirmar.setCustomValidity("");
        return true;
      }
    }

    senha.addEventListener("input", validarSenhas);
    confirmar.addEventListener("input", validarSenhas);

    form.addEventListener("submit", (e) => {
      if (!validarSenhas()) e.preventDefault();
    });
  </script>
</body>
</html>
<?php
$mysqli->close();
?>
