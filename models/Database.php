<?php

class Database
{
    public static string $Database = "/database/pessoas.json";
    private static function abrirConexao() : array | null
    {
        $arquivo = self::$Database;

        if (!file_exists(__DIR__. $arquivo))
        {
            file_put_contents(__DIR__.$arquivo,"");
        }

        $dados_banco = file_get_contents(__DIR__.$arquivo);


        $dados_banco = json_decode($dados_banco, JSON_UNESCAPED_SLASHES);

        return $dados_banco;

    }
    private static function salvarDados(string | array $dados)
    {
        if (is_array($dados)){
            $dados = json_encode($dados, JSON_PRETTY_PRINT);
        }

        file_put_contents(__DIR__ . self::$Database, $dados );

    }



    // abaixo funções para modificar o banco.

    public static function pegarRegistros() : array | null
    {
        $dados = self::abrirConexao();


        $novoArray = [];
        for ($i = 0 ; isset($dados[$i]); $i++)
        {// calculamos a idade
            $dataAtual = new DateTime( date("Y-m-d") );
            $dataNascimento = new DateTime($dados[$i]["dt_nascimento"]);
            $idade = $dataAtual->diff($dataNascimento)->y;


            $novoArray[] = [
                "cod" => $dados[$i]["id"],
                "nome" => $dados[$i]["nome"],
                "idade" => $idade,
                "data nascimento" => date_create_from_format("Y-m-d", $dados[$i]["dt_nascimento"])->format("d/m/Y"),
            ];
        }

        return $novoArray;
    }

    public static function adicionarRegistro(array $dados) : bool
    {
        unset($dados["token"]);

        $dados["dt_nascimento"] = date_create_from_format("d/m/Y", $dados["dt_nascimento"])->format('Y-m-d');

        $banco = self::abrirConexao();

        $dados["id"] = $banco[count($banco)-1]["id"] ? $banco[count($banco)-1]["id"]+1 : 1; // checa se ja tem entradas no banco, se não tiver usamos 1;
        $banco[] = $dados;

        self::salvarDados($banco);

        return true;
    }




}

