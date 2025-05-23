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
        //salva o email na sessão
        session_start();
        $_SESSION['email'] = $emailInserido;
        header('Location: manifestacoes.html'); //TEMPORÁRIO, TODO: @guilhermebm64 criar página de perfil
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