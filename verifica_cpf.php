<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cpf"])) {
    $cpf = preg_replace('/\D/', '', $_POST["cpf"]);
    $token = "36d7e9f1c3d3434411746df470d13faf0fe9d68ac5b815207d54999f1d6764fd";
    $url = "https://api.receitaws.com.br/v2/cpf/$cpf?token=$token";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
}
?>

