<?php

class RepositorioProdutos
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($objeto)  
    {
        return new Produto(
            $objeto['id'],
            $objeto['tipo'],
            $objeto['nome'],
            $objeto['descricao'],
            $objeto['imagem'],
            $objeto['preco'],
        );
    }

    public function listaCafes(): array{

        $sql = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $cafesSerenatto = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_map(function ($cafe){
            return $this->formarObjeto($cafe);
        }, $cafesSerenatto);

        return $dadosCafe;
    }

    public function listaAlmoco(): array 
    {
        $sql = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $almocoSerenatto = $statement->fetchAll();

        $dadosAlmoco = array_map(function ($almoco){
            return $this->formarObjeto($almoco);
        }, $almocoSerenatto);

        return $dadosAlmoco;
    }

    public function listaProdutos(): array
    {
        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $dados = $statement->fetchAll();

        $todosOsProdutos = array_map(function ($produto){
            return $this->formarObjeto($produto);
        }, $dados);

        return $todosOsProdutos;
    }
}