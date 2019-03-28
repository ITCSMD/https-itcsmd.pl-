<?php
if (count($_POST))
{
	////////// USTAWIENIA //////////
	$email = 'info@itcsmd.pl';	// Adres e-mail adresata
	$subject = 'Zgłoszenie ze strony ITCSMD';	// Temat listu
	$message = header('Location: https://itcsmd.pl/#komunikat');	// Komunikat
	$error = 'Wystąpił błąd podczas wysyłania formularza';	// Komunikat błędu
	$charset = 'utf-8';	// Strona kodowa
	//////////////////////////////

	$head =
		"MIME-Version: 1.0\r\n" .
		"Content-Type: text/plain; charset=$charset\r\n" .
		"Content-Transfer-Encoding: 8bit";
	$body = '';
	foreach ($_POST as $name => $value)
	{
		if (is_array($value))
		{
			for ($i = 0; $i < count($value); $i++)
			{
				$body .= "$name=" . (get_magic_quotes_gpc() ? stripslashes($value[$i]) : $value[$i]) . "\r\n";
			}
		}
		else $body .= "$name=" . (get_magic_quotes_gpc() ? stripslashes($value) : $value) . "\r\n";
	}
	echo mail($email, "=?$charset?B?" . base64_encode($subject) . "?=", $body, $head) ? $message : $error;
}
else
{
?>
<form action="?" method="post">

  <div class="fields">
    <div class="field half">
      <label for="name">Imię*</label>
      <input type="text" name="name" id="name" required="" />
    </div>
    <div class="field half">
      <label for="email ">Email *</label>
      <input type="text" name="email " id="email " required="" />
    </div>
    <div class="field">
      <label for="message">Wiadomość*</label>
      <textarea name="message" id="message" rows="4" required=""></textarea>
      <p></p>
      <label for="usluga">W jakiej sprawie możemy ci pomóc?*</label>
      <div>
        <input type="radio" id="contactChoice1" name="contact" value="serwis_uslugi">
        <label for="contactChoice1">SERWIS I USŁUGI</label>

        <input type="radio" id="contactChoice2" name="contact" value="szkolenia">
        <label for="contactChoice2">SZKOLENIA</label>

        <input type="radio" id="contactChoice3" name="contact" value="grafika">
        <label for="contactChoice3">GRAFIKA</label>

        <input type="radio" id="contactChoice4" name="contact" value="marketing">
        <label for="contactChoice4">MARKETING</label>
      </div>
      <!-- Zgoda rodo-->
      <div>
        <br>
        <input type="checkbox" id="1" name="rodo[]" value="zgoda" required="">
        <label for="1">
          <p align="left">*Wyrażam zgodę na przetwarzanie moich danych osobowych podanych w powyższym formularzu w celach handlowych i marketingowych przez firmę ITCSMD z siedzibą w Gdańsku oraz w celu przedstawienia kompleksowej oferty na
            złożone zapytanie.</p>
        </label>
      </div>
    </div>
  </div>
  <ul class="actions" align="center">
    <li><input type="submit" value="Wyślij wiadomość" class="primary" /></li>
  </ul>

</form>
<?php
}
?>
