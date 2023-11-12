
<?php
require "models/Tabela.php";

// mais uma questão de segurança, para impedir que seja reenviado o mesmo formulário
// de bonus impede ataques externos.
session_start();
$_SESSION["csfr_token"] = bin2hex(random_bytes(32));

?>
<!DOCTYPE html>
<html lang="br">

    <head>
        <title>Lista pessoas</title>

        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="stylesheet" href="css/main.css">
    </head>

    <body>

        <section class="container">
            <div class="cabecario">
                <div class="texto">Pessoas</div>

                <a href="registro.php?token=<?php echo $_SESSION["csfr_token"]?>" class="button">
                    Registrar
                    <div class="icone direita">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                        </svg>
                    </div>
                </a>
            </div>

            <div class="output">
                <?php Tabela::MostrarTabela(); ?>
            </div>

        </section>

    </body>
</html>