<?php
$emailInserido = $_REQUEST['emailLogin'];
$senhaInserida = $_REQUEST['senhaLogin'];

//ver se o usuário preencheu os campos
if (empty($emailInserido) || empty($senhaInserida)) {
    echo "<script>alert('Preencha todos os campos!');</script>";
    echo "<script>window.location.href = 'login.html';</script>";
}

include 'conexao.php';

// Verifica se o usuário existe no banco de dados
$query = "SELECT senha FROM contas WHERE email = '$emailInserido'";
$resultadoSenha = mysqli_query($con, $query);

//verifica se há algum resultado
if (mysqli_num_rows($resultadoSenha) > 0) {
    //pega a senha do banco de dados (hash) e faz o hash da senha inserida
    $linha = mysqli_fetch_assoc($resultadoSenha);
    $senhaBancoHash = $linha['senha'];
    $senhaInseridaHash = hash("sha256", $senhaInserida);

    //verifica se os dois hashes correspondem
    if ($senhaBancoHash === $senhaInseridaHash) {
        $query = "SELECT cpf FROM contas WHERE email = '$emailInserido'";
        $resultadoCPF = mysqli_query($con, $query);
        $linha = mysqli_fetch_assoc($resultadoCPF);
        $CPF = $linha['cpf'];
        //salva o cpf na sessão
        session_start();
        $_SESSION['cpf'] = $CPF;
        header('Location: perfil.php');
        exit();
    } else if ($senhaBancoHash !== $senhaInseridaHash) {
        echo "<script>alert('Senha incorreta!');</script>";
		echo "<script>window.location.href = 'login.html';</script>";
    } 
} else {
    echo "<script>alert('Usuário não encontrado!');</script>";
    echo "<script>window.location.href = 'login.html';</script>";
}
?>