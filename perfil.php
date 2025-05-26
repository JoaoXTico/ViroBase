<?php
session_start();
if (!isset($_SESSION["cpf"])) {
    header("Location: login.html"); // redireciona se não estiver logado
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="virobase.css">
</head>
<body>
    <header>
        <div id="logo"> 
            <a href="index.html">
            <img src="imagens/logo_virobase.png" id="imglogo"></div>
            </a>
        <nav id="menu">
            <ul>
                <li> <a href="info.html"> Informações </a></li>
                <li> <a href="aconselhamentos.html"> Aconselhamentos </a></li>
                <li> <a href="sintomas.html"> Sintomas </a></li>
                <li> <a href="cadastro.html"> Cadastro </a></li>
                <li> <a href="login.html">Fazer Login</a></li>
                <li> <a href="perfil.php">Perfil</a></li>
            </ul>
        </nav>
     </header>
    <div class="container" id="esc">
        <div id="divindex">
            <p id="nomeUsuario">Olá, usuário!</p>
            <p id="index">Veja aqui suas respostas no formulário de pesquisa:</p>
            <div id="dados-usuario">
                <p id="subindex"><b>Carregando...</b></p><br>
            </div>
            <button id="botao">Sair da conta</button>
        </div>
     </div>
     <br><br><br><br><br><br><br><br>

     <footer id="footer">
        <p><b>Desenvolvido por:
        Guilherme Felipe,
        João Pedro Marques e
        Lucas de Morais</b>
        </p>
        </footer>

    <script>
        window.onload = () => {
            // atribuindo sistema de logout ao botão
            document.getElementById("botao").addEventListener("click", () => {
            window.location.href = "logout.php";
            });

            // inserindo o nome do usuário
            fetch("buscar_usuario.php")
            .then(response => response.json())
            .then(data => {
            if (data.sucesso) {
                document.querySelector("#nomeUsuario").innerHTML = `Olá, ${data.nome}!`;
            }
            });
            // inserindo as respostas do usuário
            fetch("buscar_dados.php")
            .then(response => response.json())
            .then(data => {
            const container = document.getElementById("dados-usuario");
            const divIndex = document.getElementById("divindex");
            if (data.sucesso) {
                container.innerHTML = `
                <p><strong>Local de contaminação:</strong> ${data.localContaminado}</p>
                <p><strong>Febre:</strong> ${data.febre ? "Sim" : "Não"}</p>
                <p><strong>Fadiga:</strong> ${data.fadiga ? "Sim" : "Não"}</p>
                <p><strong>Dor no corpo:</strong> ${data.dorCorpo ? "Sim" : "Não"}</p>
                <p><strong>Dor de garganta:</strong> ${data.dorGarganta ? "Sim" : "Não"}</p>
                <p><strong>Tosse:</strong> ${data.tosse ? "Sim" : "Não"}</p>
                <p><strong>Espirros:</strong> ${data.espirros ? "Sim" : "Não"}</p>
                <p><strong>Diarreia:</strong> ${data.diarreia ? "Sim" : "Não"}</p>
                <p><strong>Náusea:</strong> ${data.nausea ? "Sim" : "Não"}</p>
                <p><strong>Vômitos:</strong> ${data.vomitos ? "Sim" : "Não"}</p>
                <p><strong>Dor abdominal:</strong> ${data.dorAbdominal ? "Sim" : "Não"}</p>
                <p><strong>Falta de apetite:</strong> ${data.faltaApetite ? "Sim" : "Não"}</p>
                <p><strong>Mal-estar:</strong> ${data.malEstar ? "Sim" : "Não"}</p>
                <p><strong>Desidratação:</strong> ${data.desidratacao ? "Sim" : "Não"}</p>
                    `;
            } else {
                divIndex.innerHTML = `
                <p id="index">Você não pode ver seu perfil pois não está logado.</p>
                <a href="login.html"><p id="index">Clique aqui para logar</p></a>
                <a href="cadastro.html"><p id="index">Clique aqui para cadastrar-se</p></a>
                `;
            }
            });
        };
        
    </script>
</body>
</html>