<?php
session_start();
$CPF = $_SESSION["cpf"];
if (empty($CPF)) {
    echo "Erro ao localizar o CPF do usuário";
}
$LOCAL = $_REQUEST["local_contaminado"];
$FEBRE = isset($_REQUEST["febre"]) ? 1 : 0;
$FADIGA = isset($_REQUEST["fadiga"]) ? 1 : 0;
$DOR_CORPO = isset($_REQUEST["dor_corpo"]) ? 1 : 0;
$DOR_GARGANTA = isset($_REQUEST["dor_garganta"]) ? 1 : 0;
$TOSSE = isset($_REQUEST["tosse"]) ? 1 : 0;
$ESPIRRO = isset($_REQUEST["espirro"]) ? 1 : 0;
$DIARREIA = isset($_REQUEST["diarreia"]) ? 1 : 0;
$NAUSEA = isset($_REQUEST["nausea"]) ? 1 : 0;
$VOMITOS = isset($_REQUEST["vomitos"]) ? 1 : 0;
$DOR_ABDOMINAL = isset($_REQUEST["dor_abdominal"]) ? 1 : 0;
$APETITE = isset($_REQUEST["apetite"]) ? 1 : 0;
$MAL_EST = isset($_REQUEST["mal_est"]) ? 1 : 0;
$DESIDRATACAO = isset($_REQUEST["desidratacao"]) ? 1 : 0;

// checando se o texto de local foi enviado, empty() olha se o dado existe
if (empty($LOCAL)) {
    // erro pra caso não seja possível conseguir os dados que deveriam ter sido enviados
    exit('Por favor preencha o cadastro completo!');
}

include "conexao.php";

$stmt = $con->prepare('SELECT senha FROM contas WHERE cpf = ?');
if ($stmt) {
    // erro na bosta do elseif
	$stmt->bind_param('s', $CPF);
	$stmt->execute();
	// guardando os resultados para checar existência da conta
	$stmt->store_result();
	// checando se a conta já existe
	if ($stmt->num_rows > 0) {
        // inserindo dados no DB
        if ($stmt = $con->prepare('INSERT INTO manifestacoes (cpf, localContaminado, febre, fadiga, dorCorpo, dorGarganta, tosse, espirros, diarreia, nausea, vomitos, dorAbdominal, faltaApetite, malEstar, desidratacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)')) {
	    $stmt->bind_param('ssiiiiiiiiiiiii', $CPF, $LOCAL, $FEBRE, $FADIGA, $DOR_CORPO, $DOR_GARGANTA, $TOSSE, $ESPIRRO, $DIARREIA, $NAUSEA, $VOMITOS, $DOR_ABDOMINAL, $APETITE, $MAL_EST, $DESIDRATACAO);
	    $stmt->execute();
	    // Mensagem de sucesso
        echo 'Sucesso no envio!';
	}
    } else {
	    echo 'O CPF não existe no banco de dados!';
    }
	$stmt->close();
} else {
	echo 'Erro ao enviar para o banco de dados!';
}
$con->close();
?>