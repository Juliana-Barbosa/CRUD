<?php
// verifica se a variavel 'id' foi passada pela URL
if (isset($_GET['id'])) {
    try {
        // cria a conexao com o banco de dados
        $conexao = new PDO('mysql:host=localhost;dbname=cadastroturma32', 'root', '');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // pega o id da URL e converte para inteiro
        $id = (int) $_GET['id'];

        // prepara a consulta para buscar o usuario pelo id
        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // armazena o resultado da consulta
        $usuario = $stmt->fetch();

        // verifica se o usuario foi encontrado
        if ($usuario) {
            // verifica se o formulario foi enviado
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // pega os dados do formulario
                $nome = $_POST['nome'];
                $email = $_POST['email'];

                // prepara a consulta para atualizar os dados do usuario
                $update = $conexao->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id_usuario = :id");
                $update->bindParam(':nome', $nome);
                $update->bindParam(':email', $email);
                $update->bindParam(':id', $id, PDO::PARAM_INT);
                $update->execute();

                // redireciona para a pagina de usuarios após a atualização
                header("Location: areaprivada.php");
                exit; // garante que o redirecionamento aconteca logo após a atualização
            }
        } else {
            // caso o usuario nao seja encontrado
            echo "usuario nao encontrado.";
        }
    } catch (PDOException $erro) {
        // caso ocorra algum erro na conexao ou consulta
        echo "erro: " . $erro->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <!-- formulario para editar os dados do usuario -->
    <form method="POST">
        <!-- campo para editar o nome -->
        <label>Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>

        <!-- campo para editar o email -->
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

        <!-- botao para salvar as alteracoes -->
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
