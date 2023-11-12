<?php
require_once "models/Database.php";

session_start();

if( (!isset($_SESSION["csfr_token"]) )  or
    (!empty($_POST) and $_POST["token"] != $_SESSION["csfr_token"] )
)
{   // o formulário não tem o token válido.
    header("Location: index.php");
    exit();

}

if (!empty($_POST))
{ // o formulário é válido

    Database::adicionarRegistro($_POST);

    header("Location: index.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="br">
    <head>
        <title>Registro</title>

        <link rel="stylesheet" href="css/main.css">

        <link rel="stylesheet" href="modulos/flatpickr-master/estilos.css">
        <script src="modulos/flatpickr-master/script.js"></script>
    </head>

    <body>

        <section class="container" >
        <div class="cabecario" >
            <a href="index.php" class="button" style="margin-right: 2rem">
                <div class="icone esquerda" >

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                    </svg>

                </div>
                Voltar
            </a>

            <div class="texto" style="margin-right: 1rem;"> Registrar </div>
        </div>

            <form id="registro" action="registro.php" method="post" >

                <div class="entradas">
                    <input type="hidden" name="token" value="<?php echo $_SESSION["csfr_token"]; ?>">

                    <label class="nome" for="nome">
                        <div>Nome</div>
                        <input required name="nome" type="text">
                    </label>

                    <label class="data" for="dt_nascimento">
                        <div>Dt Nascimento</div>
                        <input required id="dt_nascimento" name="dt_nascimento" type="text"  />
                    </label>
                </div>

                <label for="submit" style="justify-self: start; align-self: flex-start; margin-left: 4rem; margin-top: 2rem;">
                    <input class="button" type="submit" value="Cadastrar">
                </label>


            </form>
    </section>

    </body>

    <script>
        // originalmente utilizaria o input type=date, mas isso depende do sistema operacional do usuário.
        // e como queria que o projeto ficasse "bonitinho", optei por utilizar uma livraria pronta.
        flatpickr("#dt_nascimento", {
            dateFormat: "d/m/Y",
        });
    </script>

</html>