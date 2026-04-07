<?php
require 'conexao.php';

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: listar.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
$stmt->execute([':id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) { header("Location: listar.php"); exit; }

$erros = [];
$mensagemSucesso = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function limpar($dado) { return htmlspecialchars(trim($dado), ENT_QUOTES, 'UTF-8'); }

    $nome = limpar($_POST["nome"] ?? '');
    $email = limpar($_POST["email"] ?? '');
    $senha = limpar($_POST["senha"] ?? '');
    $mensagem = limpar($_POST["mensagem"] ?? '');

    if (strlen($nome) < 3) $erros[] = "Nome inválido.";
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@gmail\.com$/", $email)) $erros[] = "Email deve ser Gmail.";
    if ($senha && strlen($senha) < 6) $erros[] = "Senha muito curta.";
    if (strlen($mensagem) > 250) $erros[] = "Mensagem excede 250 caracteres.";

    if (empty($erros)) {
        $senhaHash = $senha ? password_hash($senha, PASSWORD_DEFAULT) : $user['senha'];
        $stmt = $pdo->prepare("UPDATE usuarios SET nome=:nome,email=:email,senha=:senha,mensagem=:mensagem WHERE id=:id");
        $stmt->execute([':nome'=>$nome, ':email'=>$email, ':senha'=>$senhaHash, ':mensagem'=>$mensagem, ':id'=>$id]);
        $mensagemSucesso = "Usuário atualizado com sucesso!";
        $user = ['nome'=>$nome,'email'=>$email,'senha'=>$senhaHash,'mensagem'=>$mensagem];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Usuário</title>
<link rel="stylesheet" href="css/style.css">
<script src="js/script.js"></script>
</head>
<body>
<div class="container">
<form method="POST" action="">
<h2>Editar Usuário</h2>

<?php if (!empty($erros)): ?>
<div class="erros">
<?php foreach ($erros as $erro) echo "<p>$erro</p>"; ?>
</div>
<?php endif; ?>

<?php if ($mensagemSucesso): ?>
<div class="sucesso"><p><?php echo $mensagemSucesso; ?></p></div>
<?php endif; ?>

<input type="text" name="nome" placeholder="Nome" value="<?php echo $user['nome']; ?>" required>
<input type="email" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" required>
<input type="password" name="senha" placeholder="Nova senha (opcional)" id="senha">
<textarea name="mensagem" maxlength="250"><?php echo $user['mensagem']; ?></textarea>
<input type="checkbox" onclick="mostrarSenha()"> Mostrar Senha
<button type="submit">Atualizar</button>
</form>
<a href="listar.php">Voltar à Lista</a>
</div>
</body>
</html>
