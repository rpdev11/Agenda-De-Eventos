<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require '../conexao/config.php';

$ID_usuario = $_SESSION['ID_usuario'];

switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        $nome = $_POST["nome"];
        $data = $_POST["data"];
        $hora = $_POST["hora"];
        $local = $_POST["local"];
        $tema = $_POST["tema"];

        $stmt = $conn->prepare("INSERT INTO agendas (nome, data, hora, local, tema, ID_usuario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $nome, $data, $hora, $local, $tema, $ID_usuario);

        if ($stmt->execute()) {
            echo "<script>alert('Agendamento realizado com sucesso.'); location.href='?page=listar';</script>";
        } else {
            echo "<script>alert('Erro ao realizar o agendamento.'); location.href='?page=listar';</script>";
        }
        break;

    case "editar":
        $ID_evento = $_REQUEST["ID_evento"];
        $nome = $_POST["nome"];
        $data = $_POST["data"];
        $hora = $_POST["hora"];
        $local = $_POST["local"];
        $tema = $_POST["tema"];

        // Verifica se o evento pertence ao usuário logado
        $verifica = $conn->prepare("SELECT ID_evento FROM agendas WHERE ID_evento = ? AND ID_usuario = ?");
        $verifica->bind_param("ii", $ID_evento, $ID_usuario);
        $verifica->execute();
        $resultado = $verifica->get_result();

        if ($resultado->num_rows === 1) {
            $stmt = $conn->prepare("UPDATE agendas SET nome = ?, data = ?, hora = ?, local = ?, tema = ? WHERE ID_evento = ?");
            $stmt->bind_param("sssssi", $nome, $data, $hora, $local, $tema, $ID_evento);
            if ($stmt->execute()) {
                echo "<script>alert('Evento editado com sucesso.'); location.href='?page=listar';</script>";
            } else {
                echo "<script>alert('Erro ao editar evento.'); location.href='?page=listar';</script>";
            }
        } else {
            echo "<script>alert('Você não tem permissão para editar este evento.'); location.href='?page=listar';</script>";
        }
        break;

    case "excluir":
        $ID_evento = $_REQUEST["ID_evento"];

        // Verifica se o evento pertence ao usuário logado
        $verifica = $conn->prepare("SELECT ID_evento FROM agendas WHERE ID_evento = ? AND ID_usuario = ?");
        $verifica->bind_param("ii", $ID_evento, $ID_usuario);
        $verifica->execute();
        $resultado = $verifica->get_result();

        if ($resultado->num_rows === 1) {
            $stmt = $conn->prepare("DELETE FROM agendas WHERE ID_evento = ?");
            $stmt->bind_param("i", $ID_evento);
            if ($stmt->execute()) {
                echo "<script>alert('Evento excluído com sucesso.'); location.href='?page=listar';</script>";
            } else {
                echo "<script>alert('Erro ao excluir evento.'); location.href='?page=listar';</script>";
            }
        } else {
            echo "<script>alert('Você não tem permissão para excluir este evento.'); location.href='?page=listar';</script>";
        }
        break;

    default:
        echo "<script>alert('Ação inválida.'); location.href='?page=listar';</script>";
        break;
}
?>
