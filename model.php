<?php

use PHPMailer\PHPMailer\PHPMailer;

require('fpdf/fpdf.php');
include("session.php");
class PDF_Dash extends FPDF
{
    function SetDash($black = null, $white = null)
    {
        if ($black !== null)
            $s = sprintf('[%.3F %.3F] 0 d', $black * $this->k, $white * $this->k);
        else
            $s = '[] 0 d';
        $this->_out($s);
    }
}

$hostname = "localhost";
$dbname = "hotel";
$username = "root";
$password = "";

$db = new mysqli($hostname, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed" . $db->connect_error);
}

$userId = $_SESSION['user'];

$pdf = new PDF_Dash();
$pdf->SetMargins(10, 7, 10);
$pdf->AddPage('P', 'A4');

$x = $pdf->getX();
$y = $pdf->getY();

$lat = 190;
$lung = 280;

$pdf->SetLineWidth(0.4);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 10);


$pdf->Cell($lat, 3, ' ', 'LTR', 1, 'L', 0);

$furnizor = 'Hotel Sunlight';
$reg_com_f = 'J32/1111/2021';
$cif_f = 'RO12345678';
$adresa_f = 'str. Tomis, Mamaia';
$iban_f = 'RO12345678910111213141516';
$banc_f = 'BCR Constanta';
$capital = '1000 RON';

$client = $_SESSION['name'];
$reg_com_f = 'J35/105/2021';
$cif_c = 'RO55667788';
$adresa_c = $_SESSION['adress'];;
$iban_c = 'RO06BTRL5765069';
$banc_c = 'BT';

$pdf->SetFont('Arial', '', 10);
$y_save = $pdf->GetY();
$y_save_t = $pdf->GetY();
$pdf->Cell($lat / 3, 4, 'Furnizor: ' . $furnizor, 'L', 1, 'L', 0);
$pdf->Cell($lat / 3, 4, 'Reg. com.: ' . $reg_com_f, 'L', 1, 'L', 0);
$pdf->Cell($lat / 3, 4, 'CIF: ' . $cif_f, 'L', 1, 'L', 0);
$pdf->MultiCell($lat / 3 + 10, 4, 'Adresa: ' . $adresa_f, 'L', 'L');
$pdf->Cell($lat / 3, 4, 'IBAN: ' . $iban_f, 'L', 1, 'L', 0);
$pdf->Cell($lat / 3, 4, 'Banca: ' . $banc_f, 'L', 1, 'L', 0);
$pdf->Cell($lat / 3, 4, 'Capital social: ' . $capital, 'L', 1, 'L', 0);

$y_save_1 = $pdf->GetY();

$pdf->SetXY(10 + 2 * $lat / 3, $y_save);
$pdf->Cell($lat / 3, 4, 'Client: ' . $client, 'R', 1, 'L', 0);
$pdf->SetXY(10 + 2 * $lat / 3, $y_save + 4);
$pdf->Cell($lat / 3, 4, 'Reg. com.' . $reg_com_f, 'R', 1, 'L', 0);
$pdf->SetXY(10 + 2 * $lat / 3, $y_save + 8);
$pdf->Cell($lat / 3, 4, 'CIF: ' . $cif_c, 'R', 1, 'L', 0);
$pdf->SetXY(10 + 2 * $lat / 3, $y_save + 12);
$pdf->MultiCell($lat / 3, 4, 'Adresa: ' . $adresa_c, 'R', 'L');
$y_save = $pdf->GetY();
$pdf->SetXY(10 + 2 * $lat / 3, $y_save);
$pdf->Cell($lat / 3, 4, 'IBAN: ' . $iban_c, 'R', 1, 'L', 0);
$pdf->SetXY(10 + 2 * $lat / 3, $y_save + 4);
$pdf->Cell($lat / 3, 4, 'Banca: ' . $banc_c, 'R', 1, 'L', 0);

$y_save_2 = $pdf->GetY();


$pdf->SetXY(10, $y_save_1);

$pdf->Cell($lat / 3, $lung * 0.25 - $y_save_1, ' ', 'LB', 0, 'L', 0);
$pdf->Cell($lat / 3, $lung * 0.25 - $y_save_1, ' ', 'B', 0, 'L', 0);
$pdf->Cell($lat / 3, $lung * 0.25 - $y_save_2, ' ', 'BR', 1, 'L', 0);

$y_t1 = $pdf->GetY();

$pdf->SetXY(10 + $lat / 3, $y_save_t);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell($lat / 3, 7, 'FACTURA', 0, 1, 'C', 0);
$pdf->SetLineWidth(0.2);

$date = date('Y-m-d');

$pdf->SetXY(15 + $lat / 3, $y_save_t + 7);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell($lat / 3 - 10, 7, 'Seria FCT nr. 0021', 'LTR', 1, 'C', 0);
$pdf->SetXY(15 + $lat / 3, $y_save_t + 13);
$pdf->Cell($lat / 3 - 10, 4, 'Data (an/luna/zi): ' . $date, 'LR', 1, 'C', 0);
$pdf->SetXY(15 + $lat / 3, $y_save_t + 17);
$pdf->Cell($lat / 3 - 10, 4, 'Cota TVA: 19%', 'LBR', 1, 'C', 0);



$pdf->SetXY(10, $y_t1);
$pdf->Cell($lat, 4, ' ', 0, 1, 'L', 0);

$x_rect = $pdf->GetX();
$y_rect = $pdf->GetY();

$pdf->SetLineWidth(0.3);

$pdf->SetFont('Times', 'B', 10);

$pdf->Cell(3 * $lat / 30, 4, ' ', 0, 0, 'C', 0);
$pdf->Cell(13.5 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
$pdf->Cell(2 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
$pdf->Cell(2.5 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30, 4, 'Pret unitar', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 - 3, 4, 'Valoarea', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 + 3, 4, 'Valoarea TVA', 'L', 1, 'C', 0);

$pdf->Cell(3 * $lat / 30, 4, 'Nr. crt', 0, 0, 'C', 0);
$pdf->Cell(13.5 * $lat / 30, 4, 'Denumirea produselor sau a serviciilor', 'L', 0, 'C', 0);
$pdf->Cell(2 * $lat / 30, 4, 'U.M.', 'L', 0, 'C', 0);
$pdf->Cell(2.5 * $lat / 30, 4, 'Cant.', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30, 4, '(fara TVA)', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 - 3, 4, '-RON-', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 + 3, 4, '-RON-', 'L', 1, 'C', 0);

$pdf->SetFont('Times', '', 10);

$pdf->Cell(3 * $lat / 30, 4, ' ', 'B', 0, 'C', 0);
$pdf->Cell(13.5 * $lat / 30, 4, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(2 * $lat / 30, 4, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(2.5 * $lat / 30, 4, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30, 4, '-RON-', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 - 3, 4, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 + 3, 4, ' ', 'LB', 1, 'C', 0);

$pdf->Cell(3 * $lat / 30, 5, '0', 'B', 0, 'C', 0);
$pdf->Cell(13.5 * $lat / 30, 5, '1', 'LB', 0, 'C', 0);
$pdf->Cell(2 * $lat / 30, 5, '2', 'LB', 0, 'C', 0);
$pdf->Cell(2.5 * $lat / 30, 5, '3', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30, 5, '4', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 - 3, 5, '5(3x4) ', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 + 3, 5, '6', 'LB', 1, 'C', 0);

$pdf->Cell(3 * $lat / 30, 4, ' ', 0, 0, 'C', 0);
$pdf->Cell(13.5 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
$pdf->Cell(2 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
$pdf->Cell(2.5 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 - 3, 4, ' ', 'L', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 + 3, 4, ' ', 'L', 1, 'C', 0);

$query = "SELECT b.bookingCartId, r.roomDesc, b.dateFrom, b.dateTo, b.price, b.nights FROM bookingcart b, room_type r WHERE b.roomID = r.roomID AND userID = '$userId';";
$result = $db->query($query);
$num_results = $result->num_rows;

$sumPrice = 0;

for ($i = 0; $i < $num_results; $i++) {
    $row = $result->fetch_assoc();
    $pdf->Cell(3 * $lat / 30, 4, $i + 1, 0, 0, 'C', 0);
    $pdf->Cell(13.5 * $lat / 30, 4, $row['roomDesc'], 'L', 0, 'L', 0);
    $pdf->Cell(2 * $lat / 30, 4, 'buc', 'L', 0, 'C', 0);
    $pdf->Cell(2.5 * $lat / 30, 4, '1', 'L', 0, 'C', 0);
    $pdf->Cell(3 * $lat / 30, 4, $row['price'] - $row['price'] * 0.19, 'L', 0, 'C', 0);
    $pdf->Cell(3 * $lat / 30 - 3, 4, $row['price'], 'L', 0, 'C', 0);
    $pdf->Cell(3 * $lat / 30 + 3, 4, $row['price'] * 0.19, 'L', 1, 'C', 0);

    $pdf->Cell(3 * $lat / 30, 4, ' ', 0, 0, 'C', 0);
    $pdf->Cell(13.5 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
    $pdf->Cell(2 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
    $pdf->Cell(2.5 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
    $pdf->Cell(3 * $lat / 30, 4, ' ', 'L', 0, 'C', 0);
    $pdf->Cell(3 * $lat / 30 - 3, 4, ' ', 'L', 0, 'C', 0);
    $pdf->Cell(3 * $lat / 30 + 3, 4, ' ', 'L', 1, 'C', 0);

    $sumPrice += $row['price'];
}


$pdf->Cell(3 * $lat / 30, 45, ' ', 'B', 0, 'C', 0);
$pdf->Cell(13.5 * $lat / 30, 45, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(2 * $lat / 30, 45, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(2.5 * $lat / 30, 45, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30, 45, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 - 3, 45, ' ', 'LB', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 + 3, 45, ' ', 'LB', 1, 'C', 0);


$pdf->Cell($lat, 1, ' ', 0, 1, 'L', 0);
$pdf->SetFont('Times', '', 12);
$pdf->Cell($lat, 5, 'Mentionam ca plata trebuie facuta in numerar.', 'B', 1, 'L', 0);

$pdf->SetFont('Times', '', 10);
$pdf->Cell(4 * $lat / 30, 5, 'Semnatura si', 0, 0, 'L', 0);
$pdf->Cell(17 * $lat / 30, 5, 'Intocmit de: Vlaicu Pop', 'L', 0, 'L', 0);
$y_total = $pdf->GetY();
$pdf->Cell(3 * $lat / 30, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 - 3, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 + 3, 5, ' ', 'L', 1, 'L', 0);

$pdf->Cell(4 * $lat / 30, 5, 'stampila', 0, 0, 'L', 0);
$pdf->Cell(17 * $lat / 30, 5, 'CNP: 1821220190456', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 - 3, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 + 3, 5, ' ', 'L', 1, 'L', 0);

$pdf->Cell(4 * $lat / 30, 5, 'furnizorului', 0, 0, 'L', 0);
$pdf->Cell(17 * $lat / 30, 5, 'Numele delegatului: Maria Voda', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 - 3, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 + 3, 5, ' ', 0, 1, 'L', 0);

$pdf->Cell(4 * $lat / 30, 5, ' ', 0, 0, 'L', 0);
$pdf->Cell(17 * $lat / 30, 5, 'B.I/C.I: SB288887', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 - 3, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 + 3, 5, ' ', 0, 1, 'L', 0);


$pdf->Cell(4 * $lat / 30, 5, ' ', 0, 0, 'L', 0);
$pdf->Cell(17 * $lat / 30, 5, 'Semnaturile:', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30, 5, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 - 3, 5, ' ', 0, 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 + 3, 5, ' ', 0, 1, 'L', 0);

$pdf->Cell(4 * $lat / 30, 1, ' ', 0, 0, 'L', 0);
$pdf->Cell(17 * $lat / 30, 1, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30, 1, ' ', 'L', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 - 3, 1, ' ', 0, 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 + 3, 1, ' ', 0, 1, 'L', 0);
$y_rect2 = $pdf->GetY();

$pdf->SetLineWidth(0.4);

$pdf->Rect($x_rect, $y_rect, $lat, $y_rect2 - $y_rect);

$pdf->ln(3);
$pdf->SetFont('Times', '', 14);
$pdf->Cell($lat / 2, 1, 'Termen Plata: 15 zile', 0, 0, 'L', 0);

$pdf->SetFont('Times', '', 11);

$pdf->SetDash(1.8, 1);
$pdf->Line(10 - 4, $y_rect2 + 7, 10 + $lat + 4, $y_rect2 + 7);
$pdf->SetDash();
$y_rect3 = $pdf->GetY();

$pdf->SetXY(10 + 21 * $lat / 30, $y_total);
$pdf->Cell(3 * $lat / 30, 10, 'Total', 'B', 0, 'L', 0);
$pdf->Cell(3 * $lat / 30 - 3, 10, $sumPrice - $sumPrice * 0.19, 'B', 0, 'C', 0);
$pdf->Cell(3 * $lat / 30 + 3, 10, $sumPrice * 0.19, 'B', 1, 'C', 0);

$pdf->SetXY(10 + 21 * $lat / 30, $y_total + 10);
$pdf->Cell(3 * $lat / 30, 15, 'Total plata', 'B', 0, 'L', 0);
$pdf->Cell(6 * $lat / 30, 15, $sumPrice, 'B', 1, 'R', 0);

$pdf->SetXY(10 + 21 * $lat / 30, $y_total + 25);
$pdf->Cell(9 * $lat / 30, 8, 'Semnatura de primire:', 0, 0, 'L', 0);


require_once "PHPMailer/Exception.php";
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'rotarumariancatalin1@gmail.com';
    $mail->Password   = '1973852852852cV@';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('rotarumariancatalin1@gmail.com', 'Rotaru');
    $mail->addAddress("rotarumariancatalin@yahoo.com");

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Sunlight Hotel bill';
    $mail->Body = "Hello {$_SESSION['name']}. This is your bill.<br><br>";
    $mypdf = $pdf->Output('factura.pdf', 'S');
    #$path = "factura.pdf";
    $mail->AddStringAttachment($mypdf, 'factura.pdf');
    //$_SESSION['emailConfirm'] = 'true';
    $mail->send();
    /*if($mail->send())
		{
			$_SESSION['emailConfirm'] = 'true';
		}
		else 
		{
			echo "something wrong happened";
			exit();
		}*/
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
