<?php
// inclui a classe 
include_once 'Usuario.php';

// se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // recebe os dados do formulario
    $nome = $_POST['nome'];
    $telefone = $_POST['tel'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // instância da classe
    $usuario = new Usuario();

    // conecta no banco de dados
    $usuario->conectar("cadastroturma32", "localhost", "root", "");

    // chamar o metodo para cadastrar
    $usuario->cadastrar($nome, $telefone, $email, $senha);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h2>CRIAR CONTA</h2>
            <p>Já é um membro? <a href="cadastro.php">Login</a></p>
            <form action="#" method="post">
                <div class="input-group">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" placeholder="Dite seu nome completo" required>
                </div>
                <div class="input-group">
                    <label>E-mail</label>
                    <input type="email" name="email" placeholder="Digite seu E-mail" required>
                </div>
                <div class="input-group">
                    <label>Telefone</label>  
                   <input type="tel" name="tel" placeholder="Digite seu telefone" required="">
                </div>
                <div class="input-group">
                    <label>Senha</label>
                    <input type="password" name="senha" placeholder="Digite uma senha" required>
                </div>
                <div class="input-group">
                    <label>Confirmar Senha</label>
                    <input type="password" name="confSenha" placeholder="Confirme a senha" required>
                </div>
                <div class="input-group-botoes">
                    <button>CANCELAR</button>
                    <button>CADASTRAR</button>
                </div>
            </form>

        </div>
    </div>    
    <?php
            if(isset($_POST['nome'])) // por meio do metodo post ira guardar dentro da variavel, se tiver o campo nome:
            {
                $nome = $_POST['nome']; // se foi preenchido será executado
                $telefone = $_POST['tel'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $confSenha = addslashes($_POST['confSenha']);

                // verificar se todos os campo estão preenchidos
                if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha)) // condição nao tem ;
                { // empty = preenchido
                    $usuario->conectar("cadastroturma32", "localhost", "root", ""); // usuario tem quatro parâmetros
                    if($usuario->msgErro == "") // se a mensagem de erro estiver vazia:
                    {
                        if($senha == $confSenha) // confirme senha
                        {
                            if($usuario->cadastrar($nome, $telefone, $email, $senha)) // então poderá se cadastrar
                            {
                                ?>

                                <!-- essa area vai ser o html -->
                                    <div id="msn-sucesso">
                                        Cadastro com Sucesso.
                                        Clique <a href="areaprivada.php">aqui</a> 
                                        para logar.
                                    </div>
                                    <!-- fim da area do html -->
                                
                                <?php
                            }
                            else
                            {
                                ?>
                                <!-- essa area vai ser o html -->
                                    <div id="msn-sucesso">
                                        Email já cadastrado
                                    </div>
                                    <!-- fim da area do html -->
                            
                                <?php
                            }
                        }
                        else
                        {
                            ?>

                            <!-- essa area vai ser o html -->
                                <div id="msn-sucesso">
                                        Senha e Confirma senha não conferem
                                </div>
                                <!-- fim da area do html -->
                            
                            <?php
                        }
                    }
                    else
                    {
                        ?>

                            <!-- essa area vai ser o html -->
                                <div id="msn-sucesso">
                                    <?php echo "Erro: ".$usuario->msgErro; ?>
                                </div>
                                <!-- fim da area do html -->
                            
                            <?php
                    }
                }
                else
                {
                    ?>

                            <!-- essa area vai ser o html -->
                                <div id="msn-sucesso">
                                    Preencha todos os campos
                                </div>
                                <!-- fim da area do html -->
                            
                            <?php
                }
            }



            
        ?>


</body>


