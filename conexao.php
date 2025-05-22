<?php
// iniciando a sessão
session_start();

//pega a senha do ".env"
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// mudança de variáveis para ficar de acordo com o banco de dados
//olucasfracaro: adicionei o host e senha do MySQL no notebook
$DB_HOST = 'brasa.onthewifi.com';
$DB_USER = 'root';
$DB_SENHA = $_ENV['DB_SENHA'];
$DB_NOME = 'virobase';

// tentativa de conexão utilizando as informações
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_SENHA, $DB_NOME);

// checando por erro de conexão
if (mysqli_connect_errno()) {
    // se tiver erro, para o script e mostra erro na tela
    exit('Falha ao conectar ao MySQL: ' . mysqli_connect_error());
}
?>