<?php

$output =$_POST["sender"];

if (isset($_POST["receiver"]) && isset($_POST["text"]) && isset($_POST["sender"])) {
    $lsender = $_POST["sender"];
    $lreceiver = $_POST['receiver'];
    $ltext = $_POST['text'];
    if ($lreceiver == "" || $ltext == "") {
        $output = "0";
    } else {
        $xml = new DomDocument('2.0', 'utf-8');
        $xml->load('data.xml');
        $mail = $xml->documentElement;
        $letter = $mail->appendChild($xml->createElement('letter'));
        $sender = $letter->appendChild($xml->createElement('sender'));
        $sender->appendChild($xml->createTextNode($lsender));
        $receiver = $letter->appendChild($xml->createElement('receiver'));
        $receiver->appendChild($xml->createTextNode($lreceiver));
        $text = $letter->appendChild($xml->createElement('text'));
        $text->appendChild($xml->createTextNode($ltext));
        $xml->formatOutput = true;
        $xml->save('data.xml');
        $output = "1";
    }
}
echo $output;
