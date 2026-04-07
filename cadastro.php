<?php
require 'conexao.php'; 

$mensagemSucesso = '';
$erros = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function limpar($dado) {
        return htmlspecialchars(trim($dado), ENT_QUOTES, 'UTF-8');
    }

    $nome = limpar($_POST["nome"] ?? '');
    $email = limpar($_POST["email"] ?? '');
    $senha = limpar($_POST["senha"] ?? '');
    $mensagem = limpar($_POST["mensagem"] ?? '');

    // validações
    if (strlen($nome) < 3) {
        $erros[] = "Nome inválido.";
    }

    if (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) {
        $erros[] = "Email deve ser Gmail.";
    }

    if (strlen($senha) < 6) {
        $erros[] = "Senha muito curta.";
    }

    if (strlen($mensagem) > 250) {
        $erros[] = "Mensagem excede 250 caracteres.";
    }

    if (empty($erros)) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, mensagem) VALUES (:nome, :email, :senha, :mensagem)");
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senhaHash,
                ':mensagem' => $mensagem
            ]);

            $mensagemSucesso = "Dados cadastrados com sucesso!";
        } catch (PDOException $e) {
            $erros[] = "Erro ao salvar: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container">
    <form method="POST" action="">
        <h2>Cadastro de Usuário</h2>

        <?php if (!empty($erros)): ?>
            <div class="erros">
                <?php foreach ($erros as $erro): ?>
                    <p><?php echo $erro; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($mensagemSucesso): ?>
            <div class="sucesso">
                <p><?php echo $mensagemSucesso; ?></p>
            </div>
        <?php endif; ?>

        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email (somente Gmail)" required>
        <input type="password" name="senha" placeholder="Senha (mín. 6 caracteres)" required>
        <textarea name="mensagem" placeholder="Mensagem (até 250 caracteres)" maxlength="250"></textarea>
        <button type="submit">Cadastrar</button>
    </form>
</div>

</body>
</html>
