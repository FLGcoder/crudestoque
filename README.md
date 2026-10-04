  Sistema de Gestao de Estoque (Mercado)

Sistema desenvolvido para controle de produtos no estoque de um mercado, contemplando as operacoes de CRUD com suporte a Prepared Statements em PHP.

   Tecnologias Utilizadas
- PHP
- MySQL (MySQLi)
- HTML

   Requisitos e Configuracao
- Crie o banco de dados e a tabela executando o script `db.sql`.
- Configure a conexao no arquivo `infra/conexao.php`.
- Inicie o servidor local (XAMPP/WAMP) e acesse a pasta do projeto via `localhost`.

   Estrutura do Banco de Dados
Tabela `produtos`:
- `id` (INT, Primary Key, Auto Increment)
- `nome` (VARCHAR)
- `categoria` (VARCHAR)
- `descricao` (VARCHAR)
- `preco` (DECIMAL)
- `quantidade` (INT)
- `data_validade` (DATE)