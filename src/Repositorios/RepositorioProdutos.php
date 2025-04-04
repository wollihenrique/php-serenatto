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
            $objeto['preco'],
            $objeto['imagem'],
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

    public function deletar($id): void
    {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();
    }

    public function salvar(Produto $produto)
    {
        $sql = "INSERT INTO produtos (tipo, nome, descricao, imagem, preco) VALUES (?,?,?,?,?);";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getImagem());
        $statement->bindValue(5, $produto->getPreco());
        $statement->execute();
    }

    public function buscar(int $id): Produto
    {
        $sql = "SELECT * FROM produtos WHERE id = ?;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);
        return $this->formarObjeto($dados);
    }

    public function editar(Produto $produto): void
    {
        $sql = "UPDATE produtos SET tipo = :tipo, nome = :nome, descricao = :descr, imagem = :img, preco = :preco WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(":tipo", $produto->getTipo());
        $statement->bindValue(":nome", $produto->getNome());
        $statement->bindValue(":descr", $produto->getDescricao());
        $statement->bindValue(":img", $produto->getImagem());
        $statement->bindValue(":preco", $produto->getPreco());
        $statement->bindValue(":id", $produto->getId());
        $statement->execute();

        if($produto->getImagem() !== 'logo-serenatto.png'){
            
            $this->atualizarFoto($produto);
        }
    }

    private function atualizarFoto(Produto $produto)
    {
        $sql = "UPDATE produtos SET imagem = ? WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getImagem());
        $statement->bindValue(2, $produto->getId());
        $statement->execute();
    }
    
}