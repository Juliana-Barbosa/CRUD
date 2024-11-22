<?php
class Usuario {
    private $pdo; 
    public $msgErro = ""; 

    public function conectar($host, $usuario, $senha) {
        try {
            // conectando 
            $this->pdo = new PDO("mysql:dbname=cadastroturma32;host=".$host, $usuario, $senha);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erro) {
            $this->msgErro = $erro->getMessage();
            die("Erro ao conectar com o banco de dados: ".$erro->getMessage());
        }
    }

    // instância do PDO
    public function getPDO() {
        return $this->pdo;
    }

    // verifica se o email já está cadastrado e registrar o usuário
    public function cadastrar($nome, $telefone, $email, $senha) {
        try {

            $sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :m");
            $sql->bindValue(":m", $email);
            $sql->execute();
            
            if ($sql->rowCount() > 0) { // Se o email já estiver cadastrado
                return false;
            } else {
                // inserir o novo usuario
                $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
                $sql = $this->pdo->prepare("INSERT INTO usuarios(nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", $senhaCriptografada);
                return $sql->execute(); 
            }
        } catch (PDOException $e) {
            $this->msgErro = $e->getMessage();
            return false;
        }
    }

    //  fazer login 
    public function logar($email, $senha) {
        try {
            //  email e a senha estão corretos
            $sql = $this->pdo->prepare("SELECT id_usuario, senha FROM usuarios WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();
            
            if ($sql->rowCount() > 0) {
                $dados = $sql->fetch();
                if (password_verify($senha, $dados['senha'])) {
                    session_start();
                    $_SESSION['id_usuario'] = $dados['id_usuario'];
                    return true;
                }
            }
            return false;
        } catch (PDOException $e) {
            $this->msgErro = $e->getMessage();
            return false;
        }
    }
}

// teste
require_once 'Usuario.php';

$usuario = new Usuario();
$usuario->conectar('localhost', 'seu_usuario', 'sua_senha'); // Ajuste o usuário e senha aqui

if (!empty($usuario->msgErro)) {
    die("Erro ao conectar: " . $usuario->msgErro);
}

// teste cadastro
if ($usuario->cadastrar('Juliana Barbosa', '987654321', 'juliana@teste.com', '12345')) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Falha ao cadastrar. Email já existe ou outro problema.";
}
?>
