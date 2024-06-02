# Projeto PDO

Este é um projeto PHP que demonstra o uso do PDO (PHP Data Objects) para interagir com um banco de dados SQLite. Este repositório contém exemplos de CRUD (Create, Read, Update, Delete) de alunos em um banco de dados.

## Estrutura do Projeto

- **alunos-with-cellphone.php**: Script PHP para listar alunos com telefone.
- **buscar-aluno.php**: Script PHP para buscar um aluno específico.
- **composer.json**: Arquivo de configuração do Composer.
- **conexao.php**: Script PHP para criar a conexão com o banco de dados.
- **cria-turma.php**: Script PHP para criar uma nova turma.
- **exclui-aluno.php**: Script PHP para excluir um aluno.
- **inserir-aluno.php**: Script PHP para inserir um novo aluno.
- **projeto-inicial.php**: Script PHP inicial do projeto.
- **src/Domain/Model**: Contém as classes de domínio, como `Phone.php` e `Student.php`.
- **src/Domain/Repository**: Contém a interface do repositório de estudantes.
- **src/Infrastructure/Persistence**: Contém a classe `ConnectionCreator.php` para criar a conexão com o banco de dados.
- **src/Infrastructure/Repository**: Contém a implementação do repositório `PDOStudentRepository.php`.
- **banco.sqlite**: Arquivo do banco de dados SQLite.

## Pré-requisitos

- PHP >= 7.4
- Composer
- Extensão PDO_SQLite habilitada

## Instalação

1. Clone o repositório:

    ```sh
    git clone https://github.com/seu-usuario/PDO.git
    ```

2. Navegue até o diretório do projeto:

    ```sh
    cd PDO
    ```

3. Instale as dependências do Composer:

    ```sh
    composer install
    ```

## Uso

### Executar o Servidor PHP Embutido

Para executar o servidor PHP embutido, use o seguinte comando:

```sh
php -S localhost:8000
```

## Agradecimentos

Este projeto foi desenvolvido com o apoio da Alura na formação PHP para WEB.
