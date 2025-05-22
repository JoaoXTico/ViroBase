<?php
$EMAIL = $_REQUEST["Email"];
$SENHA = $_REQUEST["Senha"];
$CPF = $_REQUEST["CPF"];
$NOME = $_REQUEST["Nome"];

// checando se dados foram enviados, isset() olha se os dados existem 
if (empty($EMAIL) || empty($SENHA) || empty($CPF) || empty($NOME)) {
    // erro pra caso não seja possível conseguir os dados que deveriam ter sido enviados
    exit('Por favor preencha o cadastro completo!');
}

include "conexao.php";

$stmt = $con->prepare('SELECT senha FROM contas WHERE email = ?');
if ($stmt) {
	$stmt->bind_param('s', $EMAIL);
	$stmt->execute();
	// guardando os resultados para checar existência da conta
	$stmt->store_result();
	// checando se a conta já existe

	if ($stmt->num_rows > 0) {
		echo 'Email já utilizado!';
        $stmt->close();
    }
}
$stmt = $con->prepare('SELECT senha FROM contas WHERE cpf = ?');
if ($stmt) {
    // erro na bosta do elseif
	$stmt->bind_param('s', $CPF);
	$stmt->execute();
	// guardando os resultados para checar existência da conta
	$stmt->store_result();
    
	// checando se a conta já existe
	if ($stmt->num_rows > 0) {
		echo 'CPF já utilizado!';
    } else {
		// inserindo nova conta
        $SENHAHASH = hash('sha256',$SENHA,);
        if ($stmt = $con->prepare('INSERT INTO contas (cpf, nome, email, senha) VALUES (?, ?, ?, ?)')) {
	    $stmt->bind_param('ssss', $CPF, $NOME, $EMAIL, $SENHAHASH);
	    $stmt->execute();
	    // Mensagem de sucesso
        
	    header('Location: manifestacoes.html');
    } else {
	echo 'Erro ao enviar para o banco de dados!';
    }
	}
	$stmt->close();
} else {
	echo 'Erro ao enviar para o banco de dados!';
}
$con->close();
$_SESSION['cpf'] = $CPF;
?>