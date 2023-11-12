<?php

require_once "Database.php";
class Tabela{

    public static function PegarTabela() : string
    {
        $tabela = "<section class='table'> \n";

        if (!$dados = Database::pegarRegistros())
        {
            $tabela .= "<div class='alerta'> O banco esta vazio ou temos um problema no banco. </div> </section>";

            return $tabela;
        }

        $cabecarios = "<div class='header'> \n";
        $linhas = "";
        // primeiro criamos os cabeçários.
        foreach (array_keys($dados[0]) as $coluna)
        {
            $cabecarios .= "<div>". ucwords($coluna)."</div> \n";

        }
        // colocamos eles na tabela.
        $cabecarios .= "</div>";
        $tabela .= $cabecarios;


        // e agora os dados.
        foreach ($dados as $dado)
        {

            $linhas .= "<div class='row'> \n";
            foreach ($dado as $nome => $valor)
            {
                $linhas .= "<div class=".$nome.">". $valor ."</div> \n";
            }
            $linhas .= "</div>";
        }



        // agora só juntar os valores e mandar para o html.
        // fiz dessa maneira por que caso queiram adicionar um novo elemento no banco de dados, não precisa se preucupar com o código.

        $tabela .=  $linhas . "</section> \n" ;

        return $tabela;
    }

    public static function MostrarTabela() :void {
        echo self::PegarTabela();
        return;
    }
}