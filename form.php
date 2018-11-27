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
  define("FNAME_REQUIRED", "Imię jest wymagane!");
  define("LNAME_REQUIRED", "Nazwisko jest wymagane!");
  define("EMAIL_REQUIRED", "Adres email jest wymagany!");

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
  $errors = [];

  function checkIfString($name) {
    return preg_match('/^([a-z])+$/i', $name);
  };

  function checkPhoneNumberCorrect($phone) {
    return preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{3}$/', $phone); # ^ początek, $ koniec stringa
  };

  $specialchars = 'Is your name O\'Reilly?';

  if (empty($_POST["fname"])) {
    $errors[] = FNAME_REQUIRED;
  } else {
    $fname = $_POST["fname"];
  }

  if (empty($_POST["lname"])) {
    $errors[] = LNAME_REQUIRED;
  } else {
    $lname = $_POST["lname"];
  }

  if (empty($_POST["email"])) {
    $errors[] = EMAIL_REQUIRED;
  } else {
    $email = $_POST["email"];
  }

  $phone = $_POST["phonenumber"];

  if (!empty($_POST["bday"]) && !empty($_POST["bmonth"]) && !empty($_POST["byear"])) {
    $day = $_POST["bday"];
    $month = $months[$_POST["bmonth"]];
    $year = $_POST["byear"];
    $bdate = $day . "-" . $month . "-" . $year;
    $age = round((time() - strtotime($bdate)) / (3600 * 24 * 365.25));
  }

  $ip = $_SERVER['REMOTE_ADDR'];
  $user_info = $_SERVER['HTTP_USER_AGENT'];


  if (!(checkIfString($fname) && checkIfString($lname))) {
    $errors[] = NAME_ERROR;
  }
  if (!empty($phone) && !checkPhoneNumberCorrect($phone)) {
    $errors[] = PHONE_ERROR;
  }

  if ($errors){
    echo "<div class='error'>";
    echo "Wystąpiły ".count($errors)." błędy: <br/>";
    foreach ($errors as $error)
      echo(" - ".$error."<br/>");
    echo "</div>";
  } else {
    echo SUCCESS_MESSAGE."</br>";
    echo "  ";
    echo "Twoje dane: <br/>";
    echo "Imię: ".$fname."<br/>";
    echo "Nazwisko: ".$lname."<br/>";
    echo "Email: ".$email."<br/>";

    if (empty($phone)) {
      echo "Telefon: Nie podano"."<br/>";
    } else {
      echo "Telefon: ".$phone."<br/>";
    }

    if (!empty($age)) {
      echo "Twój wiek: ".$age."<br/>";
    }
  }

  ?>
</div>

<script src="js/main.js"></script>

</body>
</html>