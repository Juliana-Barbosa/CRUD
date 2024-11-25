<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <style>
        *{
            text-decoration: none;
        }
        body { 
            font-family: Arial, sans-serif; 
            background-color: white; 
            text-decoration: none;
            margin: 0; 
            padding: 0;
            align-items: center;
            margin-left: 15%; 
            margin-top: 8%;
            justify-content: center;
        }
        .container { 
            width: 80%; 
            padding: 20px; 
            align-items: center;
            justify-content: center;
            box-shadow: 20px 24px 28px rgba(0, 0, 0, 0.5); 
            box-sizing: border-box;
        }
        h1 { 
            /* text-align: center;   */
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
        table { 
            width: 100%; 
            border-collapse: collapse;
            margin: 20px 0; 
        }
        table th, table td { 
            border: 1px;
            padding: 10px; 
            /* text-align: center;  */
            text-align: left; 
            
        }
        table th { 
            background-color: rgba(255, 0, 0, 0.505); 
            color: #fff; 
        }
        table tr:nth-child(even) { 
            /* background-color: #f9f9f9;  */
        }
        table tr:hover { 
            /* background-color: #f1f1f1;  */
        }
        .actions { 
            display: flex; 
            gap: 20px; 
        }
        .btn { 
            padding: 5px 10px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            color: #fff; 
        }
        .btn-edit { 
            background-color: green; 
        }
        .btn-delete { 
            background-color: red; 
        }
        .btn-edit:hover { 
            background-color: rgba(0, 128, 0, 0.363); 
        }
        .btn-delete:hover { 
            background-color: rgba(255, 0, 0, 0.505); 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Lista de Usuários</h1>
        <?php
        session_start();

        // usuário está logado?:
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: login.php");
            exit;
        }

        try {
            // conexao banco de dados
            $conexao = new PDO('mysql:host=localhost;dbname=cadastroturma32', 'root', '');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // consulta os usuarios
            $sql = "SELECT * FROM usuarios";
            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            // exiberesultados 
            $usuarios = $stmt->fetchAll();
            if (count($usuarios) > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr>";
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($usuario['id_usuario']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                    echo "<td class='actions'>
                            <a href='editar_usuario.php?id=" . $usuario['id_usuario'] . "' class='btn btn-edit'>Editar</a>
                            <a href='excluir_editar.php?id=" . $usuario['id_usuario'] . "' class='btn btn-delete'>Deletar</a>
                          </td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "Nenhum usuário encontrado.";
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
        ?>
    </div>
</body>
</html>
