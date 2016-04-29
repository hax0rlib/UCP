<html>
<title>UCP SA-MP - Perfil</title>
<body align = "center">
<font face = "Verdana">
<?php

include "autoload.php";

session_start();

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $stmt = $db->prepare("SELECT * FROM player_info WHERE name = ?");
    $stmt = $db->bindParam(1, $username);
    $stmt->execute();

        while($row = $stmt->fetch())
        {
            $skin     = $row['skin'];
            $matou    = $row['kills'];
            $morreu   = $row['kills'];
            $score    = $row['score'];
            $dinheiro = $row['money'];

            $html =
            "<table border = '1' cellspacing = '0' align = 'center'>
                <tr><td>$username</td></tr>
                <tr><td>Matou: $matou</td></tr>
                <tr><td>Morreu: $morreu</td></tr>
                <tr><td>Nível: $score</td></tr>
                <tr><td>Dinheiro: $dinheiro</td></tr>
                <tr><td><img src = 'http://weedarr.wikidot.com/local--files/skinlistc/$skin.png'></img></td></tr>
                </table>";
                echo $html;
        }
} else {
    header('location: login.php');
}
?>
<br>
<br>
<br>
<a href = 'mudarskin.php'>Trocar skin</a><br>
<a href = 'logout.php'>Logout</a>
</font>
</body>
</html>
