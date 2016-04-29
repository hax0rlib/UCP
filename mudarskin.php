<html>
<title>UCP SA-MP - Mudar Skin</title>
<body align = "center">
<font face = "Verdana">
<?php

include "autoload.php";

if (isset($_SESSION['username'])) {
    if (isset($_POST['confirmar'])) {
        if (IsValidSkin($_POST['novaskin'])) {
            $nome = $_SESSION['username'];
            $stmt = $db->prepare("SELECT * FROM player_info WHERE name = ?");
            $stmt = $db->bindParam(1, $nome);
            $stmt = execute();

            $dado      = $stmt->fetch(PDO::FETCH_ASSOC);
            $skinAtual = $dado['skin'];
            $skinNova  = $_POST['novaskin'];

            if ($skinAtual != $skinNova) {
                $stmt = prepare("UPDATE player_info SET skin = :skinnova WHERE name = :nome");
                $stmt->execute(array(
                    ':nome'     => $nome,
                    ':skinnova' => $skinNova,
                ));

                header('location: perfil.php');
            } else {
                echo "Erro: Nova skin igual à atual.<br>";
            }

        } else {
            echo "Erro: Skin inválida.<br>";
        }

    } else if (isset($_POST['cancelar'])) {
        header('location: perfil.php');
    }
    $form =
        "<form method = 'post' action = ''>
                Nova Skin:<br><input type = 'text' name = 'novaskin'><br>
                <input type = 'submit' name = 'confirmar' value = 'Alterar'><br>
                <input type = 'submit' name = 'cancelar' value = 'Cancelar'>
        </form>";
    echo $form;
} else {
    header('location: login.php');
}

function IsValidSkin($s)
{
    return $s >= 0 && $s <= 299;
}
?>
</font>
</body>
</html>
