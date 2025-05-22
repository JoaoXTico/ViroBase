<?php
// iniciando a sessão
session_start();
// se o usuário estiver logado, ele é redirecionado para o manifestacoes.html
if (isset($_SESSION['account_loggedin'])) {
    header('Location: manifestacoes.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="virobase.css">
</head>
<body>
     <header>
    <div id="logo"> 
        <a href="index.html">
            <img src="imagens/logo_virobase.png" width="50"></div>
            </a>
    <nav id="menu">
        <ul>
            <li> <a href="cadastro.html"> Cadastro </a></li>
            <li> <a href="info.html"> Informações </a></li>
            <li> <a href="aconselhamentos.html"> Aconselhamentos </a></li>
            <li> <a href="sintomas.html"> Sintomas </a></li>
            <li> <a href="login.html">Fazer Login</a></li>
        </ul>
    </nav>
 </header>
    
    <h2 style="padding-left: 20px; padding-right: 30px;">Insira seus dados para realizar o cadastro</h2>
    <form id="dados" method="post" action="cadastrar.php">
        <div>
            
            <br>
            
            <p style="font-weight: bold;">Nome: </p>
            <input type="text" name="Nome" id="nome" placeholder="João Silva">
            <br><br>


            <p style="font-weight: bold;">Email: </p>
            <input type="text" name="Email" id="email" placeholder="fulano@exemplo.com">
            <br><br>

            <p style="font-weight: bold;" >Senha: </p>
            <input type="password" name="Senha" id="senha">
            <br><br>

            <p style="font-weight: bold;">Digite seu CPF: </p>
            <input type="text" name="CPF" id="cpf" placeholder="000.000.000-00" oninput="mascara(this)">
            <br><br>
            

            <button type="submit" id="continua">Continuar</button>

        </div>
     </form>
     <br><br>
     <footer id="footer">
        <p><b>Desenvolvido por:
        Guilherme Felipe,
        João Pedro Marques e
        Lucas de Morais</b>
    </p>
    </footer>
</body>
<script>
    function mascara(i){
        var v = i.value;
        if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
            i.value = v.substring(0, v.length-1);
            return;
        }
        i.setAttribute("maxlength", "14");
        if (v.length == 3 || v.length == 7) i.value += ".";
        if (v.length == 11) i.value += "-";

    }
</script>
</html>
