<?php 
class Usuario {
    private $pdo; 
    public $msgErro = ""; 

    // conecta ao banco de dados
    public function conectar($cadastroturma32, $host, $usuario, $senha) {
        try {
            // conectando 
            $this->pdo = new PDO("mysql:dbname=".$cadastroturma32.";host=".$host, $usuario, $senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexão com o banco de dados estabelecida!";
        } catch (PDOException $erro) {
            $this->msgErro = $erro->getMessage();
            die("Erro ao conectar com o banco de dados: ".$erro->getMessage());
        }
    }

    // cadastra o usuário
    public function cadastrar($nome, $telefone, $email, $senha) {
        try {
            // remover espaços em branco 
            $email = trim($email);
            
            // mostrar o e-mail que está sendo verificado
            echo "E-mail a ser verificado: " . $email . "<br>";
    
            // Preparar a consulta SQL
            $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
            $sql->bindValue(":e", $email);

            echo "Consulta SQL: " . $sql->queryString . "<br>";
            
            $sql->execute();

            echo "Número de registros encontrados: " . $sql->rowCount() . "<br>";
    
            if ($sql->rowCount() > 0) {
                 ?>

                                <!-- essa area vai ser o html -->
                                    <div id="msn-sucesso">
                                        Cadastro com Sucesso.
                                        Clique <a href="cadastro.php">aqui</a> 
                                        para logar.
                                    </div>
                                    <!-- fim da area do html -->
                                
                                <?php
            } else {
                // se nao: inserir no banco de dados
                $sql = $this->pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", password_hash($senha, PASSWORD_DEFAULT));
                $sql->execute();
    
                echo "Usuário cadastrado com sucesso!<br>";
                return true;
            }
        } catch (PDOException $e) {
            echo "Erro no método cadastrar: " . $e->getMessage() . "<br>";
            return false;
        }
    }
    
    
    
    
    // login do usuário
    public function logar($email, $senha) {
        try {
            // verifica email e senha 
            $verificarEmailSenha = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
            $verificarEmailSenha->bindValue(":e", $email);
            $verificarEmailSenha->bindValue(":s", md5(md5($senha)));
            $verificarEmailSenha->execute();
    
            if ($verificarEmailSenha->rowCount() > 0) {
                $dados = $verificarEmailSenha->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id_usuario'];
                
                // redireciona para a página de área privada
                header("Location:areaprivada.php");
                exit; //garantir que o redirecionamento ocorra imediatamente
            } else {
                header("Location:areaprivada.php");
            }
        } catch (PDOException $e) {
            // mensagem de erro
            echo "Erro ao tentar logar: " . $e->getMessage() . "<br>";
            return false;
        }
    }
}    
?>
