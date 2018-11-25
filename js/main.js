const accounts = [
  {
    nick: "krzysiek",
    password: "krzychu123",
  },
  {
    nick: "przemek",
    password: "haslo123",
  },
]

function showNick(nick) {
  if (nick !== "") {
    document.getElementById("nick").innerHTML =
    "Konto: " + nick;
  }
}

function logowanie() {
  var nick = prompt("Nick", "");
  var password = prompt("Passowrd:", "")

  for(let i = 0; i < accounts.length; i++) {
    if (accounts[i].nick === nick) {
      if (accounts[i].password === password) {
        const probability = Math.random() * 100;
        if (probability > 75) {
          if(passCaptcha()) {
            alert("Logowanie przebiegło pomyślnie!");
            showNick(nick);
          } else {
            alert("Wpisano niepoprawny kod, spróbuj zalogować się ponownie");
          }
        } else {
          showNick(nick);
        }
      } else {
        alert("Błędne hasło!");
      }
    }
  }
}

function passCaptcha() {
  let code = ""
  for(let i = 0; i < 4; i++) {
    code += Math.floor(Math.random()*10)
  }
  const answer = prompt(
    "Udowodnij proszę, że nie jesteś robotem \nPrzepisz kod: " + code);
  return answer === code;
}

document.getElementById("loginButton").addEventListener("click", function(){
  logowanie();
});