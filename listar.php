<?php
require 'conexao.php';
$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Lista de Usuários</title>
<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
<h2>Lista de Usuários</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Mensagem</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($usuarios as $user): ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['nome']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['mensagem']; ?></td>
        <td>
            <a href="editar.php?id=<?php echo $user['id']; ?>">Editar</a> |
            <a href="deletar.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<a href="cadastro.php">Cadastrar Novo Usuário</a>
</div>
</body>
</html>
