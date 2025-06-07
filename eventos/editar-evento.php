<h2 class="text-primary mb-4">Editar Evento</h2>

<?php
// Verifica se o ID_evento foi passado
if (!isset($_REQUEST["ID_evento"])) {
    echo "<div class='alert alert-danger'>ID do evento não especificado!</div>";
    exit;
}

$ID_evento = intval($_REQUEST["ID_evento"]);

// Consulta segura (pode usar prepared statements para mais segurança)
$sql = "SELECT * FROM agendas WHERE ID_evento = $ID_evento";
$res = $conn->query($sql);

if ($res && $res->num_rows > 0) {
    $row = $res->fetch_object();
} else {
    echo "<div class='alert alert-warning'>Evento não encontrado.</div>";
    exit;
}
?>

<form action="?page=salvar" method="POST" class="needs-validation" novalidate>
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="ID_evento" value="<?= $row->ID_evento ?>">

    <div class="mb-3">
        <label for="nome" class="form-label">Evento</label>
        <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($row->nome) ?>" class="form-control" required>
        <div class="invalid-feedback">Por favor, insira o nome do evento.</div>
    </div>

    <div class="mb-3">
        <label for="local" class="form-label">Local</label>
        <input type="text" name="local" id="local" value="<?= htmlspecialchars($row->local) ?>" class="form-control" required>
        <div class="invalid-feedback">Por favor, informe o local do evento.</div>
    </div>

    <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" name="data" id="data" value="<?= htmlspecialchars($row->data) ?>" class="form-control" required>
        <div class="invalid-feedback">Por favor, selecione a data.</div>
    </div>

    <div class="mb-3">
        <label for="hora" class="form-label">hora</label>
        <input type="time" name="hora" id="hora" required step="60" value="<?= htmlspecialchars(date('H:i', strtotime($row->hora))) ?>" class="form-control">
        <div class="invalid-feedback">Por favor, selecione o horario.</div>
    </div>

    <div class="mb-3">
        <label for="tema" class="form-label">Tema</label>
        <input type="text" name="tema" id="tema" value="<?= htmlspecialchars($row->tema) ?>" class="form-control" required>
        <div class="invalid-feedback">Por favor, insira o tema do evento.</div>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    <a href="?page=listar" class="btn btn-secondary ms-2">Cancelar</a>
</form>

<script>
// Exemplo simples de validação Bootstrap 5
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
