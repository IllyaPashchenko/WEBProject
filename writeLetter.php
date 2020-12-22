<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Кладовка игр</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<div id="write">
    <label for="receiver">Отримувач:</label>
    <input type="text" id="receiver">
    <input id="sender" value="<?= $_SESSION["login"] ?>" type="hidden">
    <textarea id="text"></textarea>
    <button id="send">Отправить</button>
</div>

<script>
    $login="<?php echo $_SESSION["login"]?>";
    $.ajax({
        type: "GET",
        url: "data.xml",
        dataType: "xml",
        complete: function (xml) {
            window.xml = xml;
            const mail = [...xml.responseXML.getElementsByTagName("letter")]
            mail.forEach(function (elem) {
                $sender = elem.getElementsByTagName("sender")[0].textContent;
                $receiver = elem.getElementsByTagName("receiver")[0].textContent;
                $text = elem.getElementsByTagName("text")[0].textContent;
                if ($sender === $login) {
                    document.getElementById("sended").innerText += "Отримувач:" + $receiver;
                    document.getElementById("sended").innerHTML += "<br>"
                    document.getElementById("sended").innerHTML += "Текст листа:" + $text;
                    document.getElementById("sended").innerHTML += "<br>"
                    document.getElementById("sended").innerText += "\n";
                } else if ($receiver === $login) {
                    document.getElementById("received").innerText += "Відправник:" + $sender;
                    document.getElementById("received").innerHTML += "<br>"
                    document.getElementById("received").innerHTML += "Текст листа:" + $text;
                    document.getElementById("received").innerHTML += "<br>"
                    document.getElementById("received").innerText += "\n";
                }
            })
        }
    })
    document.addEventListener("DOMContentLoaded", function () {
        var button = document.getElementById('send');
        button.addEventListener("click", function () {
            var receiver = document.getElementById('receiver').value;
            var sender = document.getElementById('sender').value;
            var text = document.getElementById('text').value;
            var params = 'receiver=' + receiver + "&sender=" + sender + "&text=" + text;
            var request = new XMLHttpRequest();
            request.open('POST', 'mails.php', true);
            request.addEventListener('readystatechange', function () {
                if ((request.readyState === 4) && (request.status === 200)) {
                    console.log(request);
                    console.log(request.responseText);
                    var sended = document.getElementById('sended');
                    var received = document.getElementById('received');
                    if (request.responseText !== "0") {
                        received.innerHTML="";
                        sended.innerHTML="";
                        $.ajax({
                            type: "GET",
                            url: "data.xml",
                            dataType: "xml",
                            complete: function (xml) {
                                window.xml = xml;
                                const mail = [...xml.responseXML.getElementsByTagName("letter")]
                                mail.forEach(function (elem) {
                                    $sender = elem.getElementsByTagName("sender")[0].textContent;
                                    $receiver = elem.getElementsByTagName("receiver")[0].textContent;
                                    $text = elem.getElementsByTagName("text")[0].textContent;
                                    if ($sender === $login) {
                                        document.getElementById("sended").innerText += "Отримувач:" + $receiver;
                                        document.getElementById("sended").innerHTML += "<br>"
                                        document.getElementById("sended").innerHTML += "Текст листа:" + $text;
                                        document.getElementById("sended").innerHTML += "<br>"
                                        document.getElementById("sended").innerText += "\n";
                                    } else if ($receiver === $login) {
                                        document.getElementById("received").innerText += "Відправник:" + $sender;
                                        document.getElementById("received").innerHTML += "<br>"
                                        document.getElementById("received").innerHTML += "Текст листа:" + $text;
                                        document.getElementById("received").innerHTML += "<br>"
                                        document.getElementById("received").innerText += "\n";
                                    }
                                })
                            }
                        })
                    }
                }
            });
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
            request.send(params);
        });
    });
</script>
<h1>Мої листи</h1>
<h2>Надіслані листи</h2>
<div id="sended"></div>
<h2>Отримані листи</h2>
<div id="received"></div>
</body>
</html>