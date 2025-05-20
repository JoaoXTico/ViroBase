<?php
// iniciando a sessão
session_start();

// mudança de variáveis para ficar de acordo com o banco de dados
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_SENHA = '';
$DB_NOME = 'virobase';

// tentativa de conexão utilizando as informações
$con = mysqli_connect($DB_HOST, $DB_USER, $DB_SENHA, $DB_NOME);

// checando por erro de conexão
if (mysqli_connect_errno()) {
    // se tiver erro, para o script e mostra erro na tela
    exit('Falha ao conectar ao MySQL: ' . mysqli_connect_error());
}
?>