<?php

    require_once 'usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    
</head>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .cadastro {
            background-image: url(../img/fundo.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .box {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 3%;
        }

        .form-box {
            background-color: rgba(0, 0, 0, 0.267);
            backdrop-filter: blur(40px);
            padding: 30px 40px;
            border-radius: 20px;
        }

        .form-box h2 {
            font-size: 50px;
            text-align: center;
            color: black;
            margin-top: 8%;
        }

        .form-box p {
            font-size: 18px;
            color: #ffffffa2;
            text-align: right;
            font-weight: bold;
        }

        .form-box p a {
            text-decoration: none;
            color: rgb(66, 1, 1);
        }

        .form-box input {
            width: 100%;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.418);
            outline: none;
            border: 2px solid transparent;
            padding: 15px;
            font-size: 15px;
            color: #3d3d3d;
            transition: all 0.4s ease;
        }

        .form-box input::placeholder {
            color: rgba(255, 0, 0, 0.555);
        }

        .form-box input:focus {
            border-color: rgba(150, 19, 19, 0.637);
        }

        .input-group{
            margin-top: 4%;
        }

        .input-group-botoes button{
            margin-top: 4%;
            color: rgba(255, 0, 0, 0.505);
            background-color: gray;
            width: 30%;
        }

        .input-group-botoes{
            display: flex;
            justify-content: right;
            align-items: center;
            gap: 3%;
        }
    </style>

<body>
    <div class="box">
        <div class="form-box">
            <p>Ainda não tem uma conta? <a href="cadas.php">Cadastrar</a></p>
            <h2>LOGIN</h2>
            <form action="#" method="post">
                <div class="input-group">
                    <label>E-mail</label>
                    <input type="email" name="email" placeholder="Digite seu E-mail" required>
                </div>
                <div class="input-group">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Digite uma senha" required>
                </div>
                <div class="input-group-botoes">
                    <button>CANCELAR</button>
                    <button>LOGAR</button>
                </div>
            </form>
        </div>
    </div>

    <?php
        // verifica se o formulario foi enviado
        if(isset($_POST['email'])) {
            // pega o email e a senha do formulario
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            // checa se o email e senha nao estao vazios
            if(!empty($email) && !empty($senha)) {
                // tenta conectar no banco de dados
                $usuario->conectar("cadastroturma32", "localhost", "root", "");
                
                // verifica se a conexao foi bem-sucedida
                if ($usuario->msgErro == "") {
                    // tenta logar com as credenciais fornecidas
                    if ($usuario->logar($email, $senha)) {
                        // redireciona para a area privada se o login for certo
                        header("Location:areaprivada.php");
                        exit; // impede a continuacao do script apos o redirecionamento
                    } else {
                        // exibe erro se o login falhar
                        ?>
                        <div id="msn-sucesso">
                            e-mail ou senha incorretos.
                        </div>
                        <?php
                    }
                } else {
                    // mostra erro de conexao caso exista
                    echo $usuario->msgErro;
                }
            }
        }
    ?>

</body>
</html>