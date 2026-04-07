<?php
require 'conexao.php';
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id=:id");
    $stmt->execute([':id'=>$id]);
}
header("Location: listar.php");
exit;
?>
