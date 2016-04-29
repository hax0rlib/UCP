<html>
<title>User Control Panel</title>
<body align = "center">
<font face = "Verdana">
<?php

include "autoload.php";

if (isset($_POST['registrar'])) {
    if (IsValidName($_POST['nome'])) {
        if (strlen($_POST['senha']) >= 5 && strlen($_POST['senha']) <= 24) {
            if ($_POST['senha'] == $_POST['senha2']) {
                if (IsValidSkin($_POST['skin'])) {
                    $nome = $_POST['nome'];
                    $stmt = $db->prepare("SELECT * FROM player_info WHERE name = ?");
                    $stmt->bindParam(1, $nome);
                    $stmt->execute();

                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (!$rows) {
                        $senha = $_POST['senha'];
                        $skin  = (int) $_POST['skin'];

                        $query = $db->prepare("INSERT INTO player_info (name, password, skin) VALUES (:nome,':senha',:skin)");
                        $query->bindParam(':nome', $nome);
                        $query->bindParam(':senha', $senha);
                        $query->bindParam(':skin', $skin);
                        $id = $query->lastInsertId();

                        echo "Parabéns $nome, você se registrou com sucesso em nosso site.<br>";
                        echo "Seu id de registro é: $id.<br>";
                        header('location: login.php');
                    } else {
                        echo "Já há um usuário registrado com este nome.<br>";
                        echo "Caso seja você, faça login clicando <a href = 'login.php'>aqui</a>.<br>";
                    }
                } else {
                    echo "Erro: Skin entre 0 e 299.<br>";
                }

            } else {
                echo "Erro: Sua senha deve conter entre 5 e 32 caracteres.<br>";
            }

        } else {
            echo "Erro: Senha e confirmação diferentes.<br>";
        }

    } else {
        echo "Erro: Seu nome está em formato inválido.<br>";
        echo "O nome deve conter entre 5 e 24 caracteres.<br>";
        echo "Ele deve estar no formato Nome_Sobrenome.<br>";
        echo "Por exemplo: Pedro_Miranda<br>";
        echo "Por favor, digite um nome válido.<br>";
    }
}

function IsValidName($n)
{
    $len = strlen($n);
    if ($len < 5 || $len > 24) {
        return 0;
    }

    if ($n[$len - 1] == '_' || $n[0] == '_') {
        return 0;
    }

    $underlines = 0;
    for ($i = 0; $i != $len; ++$i) {
        if ($n[$i] == '_') {
            ++$underlines;
        }
    }
    return $underlines == 1;
}

function IsValidSkin($s)
{
    return $s >= 0 && $s <= 299;
}
?>
<form method = "post" action = "">
        Nome:<br><input type = "text" name = "nome"><br>
        Senha:<br><input type = "password" name = "senha"><br>
        Confirmar senha:<br><input type = "password" name = "senha2"><br>
        Skin:<br><input type = "text" name = "skin"><br>
        <input type = "submit" name = "registrar" value = "Registrar">
</form>
</font>
</body>
</html>
