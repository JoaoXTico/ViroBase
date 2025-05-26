<?php
header('Content-Type: application/json');
include("conexao.php");

$CPF = $_SESSION["cpf"];
if (empty($CPF)) {
    echo json_encode(["sucesso" => false, "erro" => "CPF não encontrado na sessão"]);
    exit;
}

$sql = "SELECT nome FROM contas WHERE cpf = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $CPF);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        "sucesso" => true,
        "nome" => $row["nome"]
    ]);
} else {
    echo json_encode(["sucesso" => false]);
}
