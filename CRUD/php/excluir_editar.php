<?php
if (isset($_GET['id'])) {
    try {
        $conexao = new PDO('mysql:host=localhost;dbname=cadastroturma32', 'root', '');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = (int) $_GET['id']; // numero
        $stmt = $conexao->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: areaprivada.php"); // volta para lista
        exit;
    } catch (PDOException $erro) {
        header("Location: areaprivada.php");
    }
}
?>
