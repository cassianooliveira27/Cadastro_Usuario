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

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "cadastro_db");

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, mensagem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $senhaHash, $mensagem);

    if (!$stmt->execute()) {
        echo "Erro ao salvar: " . $stmt->error;
        exit;
    }

    $stmt->close();
    $conn->close();

    echo "<h2>Dados cadastrados com sucesso!</h2>";
    echo "<p><strong>Nome:</strong> $nome</p>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Mensagem:</strong> $mensagem</p>";
}
?>