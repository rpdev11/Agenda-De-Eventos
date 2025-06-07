<h2 class="text-primary mb-4">Novo Evento</h2>

<form action="?page=salvar" method="POST" class="needs-validation" novalidate>
    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label for="nome" class="form-label">Evento</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
        <div class="invalid-feedback">Por favor, insira o nome do evento.</div>
    </div>

    <div class="mb-3">
        <label for="local" class="form-label">Local</label>
        <input type="text" name="local" id="local" class="form-control" required>
        <div class="invalid-feedback">Por favor, informe o local do evento.</div>
    </div>
  
    <div class="mb-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" name="data" id="data" class="form-control" required>
        <div class="invalid-feedback">Por favor, selecione a data.</div>
    </div>

    <div class="mb-3">
        <label for="hora" class="form-label">hora</label>
        <input type="time" name="hora" id="hora" class="form-control" required>
        <div class="invalid-feedback">Por favor, selecione o horario.</div>
    </div>

    <div class="mb-3">
        <label for="tema" class="form-label">Tema</label>
        <input type="text" name="tema" id="tema" class="form-control" required>
        <div class="invalid-feedback">Por favor, insira o tema do evento.</div>
    </div>

    <button type="submit" class="btn btn-outline-primary">Agendar</button>
</form>

<script>

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