<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function limpar($dado) {
        return htmlspecialchars(trim($dado), ENT_QUOTES, 'UTF-8');
    }

    $nome = limpar($_POST["nome"] ?? '');
    $email = limpar($_POST["email"] ?? '');
    $senha = limpar($_POST["senha"] ?? '');
    $mensagem = limpar($_POST["mensagem"] ?? '');

    $erros = [];

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

    if (!empty($erros)) {
        echo "<h3>Erros:</h3>";
        foreach ($erros as $erro) {
            echo "<p style='color:red;'>$erro</p>";
        }
        exit;
    }

    // Hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Conexão PDO
    $dsn = "mysql:host=localhost;dbname=cadastro_db;charset=utf8";
    $user = "root";
    $pass = "";

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparando a query
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, mensagem) VALUES (:nome, :email, :senha, :mensagem)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':mensagem', $mensagem);

        $stmt->execute();

        echo "<h2>Dados cadastrados com sucesso!</h2>";
        echo "<p><strong>Nome:</strong> $nome</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Mensagem:</strong> $mensagem</p>";

    } catch (PDOException $e) {
        echo "Erro ao salvar: " . $e->getMessage();
        exit;
    }
}
?>

    echo "<h2>Dados cadastrados com sucesso!</h2>";
    echo "<p><strong>Nome:</strong> $nome</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Mensagem:</strong> $mensagem</p>";
}
?>
