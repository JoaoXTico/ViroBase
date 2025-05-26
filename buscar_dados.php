<?php
header('Content-Type: application/json');
include("conexao.php");

$CPF = $_SESSION["cpf"];
if (empty($CPF)) {
    echo "Erro ao localizar o CPF do usuário";
}

$sql = "SELECT localContaminado, febre, fadiga, dorCorpo, dorGarganta, tosse, espirros, diarreia, nausea, vomitos, dorAbdominal, faltaApetite, malEstar, desidratacao FROM manifestacoes WHERE cpf = ? ORDER BY cpf DESC LIMIT 1";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $CPF);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  echo json_encode([
    "sucesso" => true,
    "localContaminado" => $row["localContaminado"],
    "febre" => (bool)$row["febre"],
    "fadiga" => (bool)$row["fadiga"],
    "dorCorpo" => (bool)$row["dorCorpo"],
    "dorGarganta"=> (bool)$row["dorGarganta"],
    "tosse"=> (bool)$row["tosse"],
    "espirros"=> (bool)$row["espirros"],
    "diarreia"=> (bool)$row["diarreia"],
    "nausea"=> (bool)$row["nausea"],
    "vomitos"=> (bool)$row["vomitos"],
    "dorAbdominal"=> (bool)$row["dorAbdominal"],
    "faltaApetite"=> (bool)$row["faltaApetite"],
    "malEstar"=> (bool)$row["malEstar"],
    "desidratacao"=> (bool)$row["desidratacao"]
  ]);
} else {
  echo json_encode(["sucesso" => false]);
}   
?>
