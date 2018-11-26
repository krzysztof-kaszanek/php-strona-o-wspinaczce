<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <title>Wspinaczka</title>
</head>
<body>
<nav class="navbar">
    <a href="index.html">Strona główna</a>
    <a href="teren.html">Teren wspinaczkowy</a>
    <a href="skale.html">Skale trudności</a>
    <a href="kontakt.html">Formularz kontaktowy</a>
    <a href="rodzaje.html">Profil</a>
    <a id="nick">
        <button id="loginButton">Logowanie</button>
    </a>
</nav>

<div class="content">
  <?php

  define("SUCCESS_MESSAGE", "Udało się poprawnie wysłać formularz!");
  define("NAME_ERROR", "W imieniu i nazwisku mogą wystepować jedynie litery!");
  define("PHONE_ERROR", "Nieprawidłowy format numeru telefonu!");


  $months = [
    "styczeń" => 1,
    "luty" => 2,
    "marzec" => 3,
    "kwiecień" => 4,
    "maj" => 5,
    "czerwiec" => 6,
    "lipiec" => 7,
    "sierpień" => 8,
    "wrzesień" => 9,
    "październik" => 10,
    "listopad" => 11,
    "grudzień" => 12,
  ];

  $bdate = "";
  $age = "";


  function checkIfString($name) {
    return preg_match('/^([a-z])+$/i', $name);
  };

  function checkPhoneNumberCorrect($phone) {
    return preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3}$/', $phone); # ^ początek, $ koniec stringa
  };

//  echo "<h2>".SUCCESS_MESSAGE."</h2>";

  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $phone = $_POST["phonenumber"];
  $day = $_POST["bday"];
  $year = $_POST["byear"];

  if ($_POST["bmonth"]) {
    $month = $months[$_POST["bmonth"]];
    $bdate = $day . "-" . $month . "-" . $year;
    $age = round((time() - strtotime($bdate)) / (3600 * 24 * 365.25));
  }

  $ip = $_SERVER['REMOTE_ADDR'];
  $user_info = $_SERVER['HTTP_USER_AGENT'];

  $errors = [];

  if (!(checkIfString($fname) && checkIfString($lname))) {
    $errors[] = NAME_ERROR;
  }
  if (!checkPhoneNumberCorrect($phone)) {
    $errors[] = PHONE_ERROR;
  }

  if ($errors){
    echo "Wystąpiły ".count($errors)." błędy: <br/>";
    foreach ($errors as $error)
      echo(" - ".$error."<br/>");
  } else {
    echo "<h2 class='success'>".SUCCESS_MESSAGE."</h2>";
  }

  ?>
</div>

<script src="js/main.js"></script>

</body>
</html>