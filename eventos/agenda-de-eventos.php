<h2 class="text-center text-primary mb-4">Agenda de Eventos</h2>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require '../conexao/config.php';

$ID_usuario = $_SESSION['ID_usuario'];

$sql = "SELECT * FROM agendas WHERE ID_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ID_usuario);
$stmt->execute();
$res = $stmt->get_result();
$qtd = $res->num_rows;

if ($qtd > 0) {
    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-hover align-middle'>";
    echo "<thead class='table-primary text-center'>";
    echo "<tr>";
    echo "<th>Evento</th>";
    echo "<th>Data</th>";
    echo "<th>Horario</th>";
    echo "<th>Local</th>";
    echo "<th>Descrição</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = $res->fetch_object()) {
        echo "<tr>";
        echo "<td>{$row->nome}</td>";
        echo "<td>" . date('d/m/Y', strtotime($row->data)) . "</td>";
        echo "<td>". date('H:i', strtotime($row->hora))."</td>";
        echo "<td>{$row->local}</td>";
        echo "<td>{$row->tema}</td>";
        echo "<td class='text-center'>";
        echo "<div class='d-flex gap-2 justify-content-center'>";
        echo "<a href='?page=editar&ID_evento={$row->ID_evento}' class='btn btn-sm btn-outline-success'>Editar</a>";
        echo "<button onclick=\"if(confirm('Tem certeza que deseja excluir o evento?')){location.href='?page=salvar&acao=excluir&ID_evento={$row->ID_evento}'}\" class='btn btn-sm btn-outline-danger'>Excluir</button>";
        echo "</div>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
} else {
    echo "<div class='alert alert-warning text-center'>Nenhum evento encontrado para sua conta.</div>";
}
?>
