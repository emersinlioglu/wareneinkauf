<?php
if (isset($data['success'])) {
    echo "<h4>Erfolgreich aktualisiert:</h4>";
    echo implode(', ', $data['success']);
}
if (isset($data['error'])) {
    echo "<h4>Error:</h4>";
    echo implode(', ', $data['error']);
}
if (isset($data['missing'])) {
    echo "<h4>Datenblatt hat keinen Abschlag mit der ausgewählten Nummer:</h4>";
    echo implode(', ', $data['missing']);
}
if (isset($data['mail_gesendet'])) {
    echo "<h4>Abschlag-Mails für die folgenden Datenblätter wurden bereits versendet:</h4>";
    echo implode(', ', $data['mail_gesendet']);
}
?>

