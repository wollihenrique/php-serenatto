# Serenatto - Sistema de Cafeteria
![Captura de tela 2025-03-30 192145](https://github.com/user-attachments/assets/45e4908a-089a-4f18-9f03-bc60e37ad331)


Este repositório contém um projeto desenvolvido durante o curso de PHP e MySQL da Alura. O sistema simula a gestão de uma cafeteria chamada **Serenatto**.

## Tecnologias Utilizadas

- **PHP** com **PDO** para interação com o banco de dados.
- **MySQL** como banco de dados.
- **HTML, CSS e JavaScript** para o front-end.
- **dompdf** (pacote do Packagist) para geração de PDF do catálogo de produtos.

## Funcionalidades

- Cadastro, edição e exclusão de produtos (CRUD completo).
- Geração de um PDF com o catálogo de produtos da cafeteria.

## Como Rodar o Projeto

1. Clone o repositório:
   ```sh
   git clone https://github.com/seu-usuario/nome-do-repositorio.git
   ```
2. Acesse a pasta do projeto:
   ```sh
   cd nome-do-repositorio
   ```
3. Inicie o servidor embutido do PHP:
   ```sh
   php -S localhost:8080
   ```
4. No navegador, acesse:
   - `` para visualizar a página inicial.
   - `` para acessar a área administrativa onde é possível cadastrar, editar e excluir produtos, além de gerar o PDF.

## Dependências

O projeto utiliza o pacote **dompdf** para geração de PDF. Caso necessário, instale as dependências com o Composer:

```sh
composer install
```

## Status do Projeto

✅ **Projeto concluído**

