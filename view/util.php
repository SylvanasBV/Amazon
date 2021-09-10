<?php
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';
require 'mailer/Exception.php';
function removeAccents($input){
    $output = "";
    $output = str_replace("á", "a", $input);
    $output = str_replace("é", "e", $output);
    $output = str_replace("í", "i", $output);
    $output = str_replace("ï", "i", $output);
    $output = str_replace("ì", "i", $output);
    $output = str_replace("ó", "o", $output);
    $output = str_replace("ú", "u", $output);
    $output = str_replace("ñ", "n", $output);
    $output = str_replace("Á", "a", $output);
    $output = str_replace("É", "e", $output);
    $output = str_replace("Í", "i", $output);
    $output = str_replace("Ó", "o", $output);
    $output = str_replace("Ú", "u", $output);
    $output = str_replace("Ñ", "n", $output);
    $output = str_replace("ü", "u", $output);
    $output = str_replace(":", "", $output);
    $output = str_replace(".", "", $output);
    return $output;
}
function saveImage($name,$temporalName){
    $url=removeAccents(str_replace(' ', '', $name)) . ".png";
    $img = "images/photosDocuments/" . $url;
    file_put_contents($img, file_get_contents($temporalName));
    return $img;
}
function printMessage($titulo,$desc,$tipo){
    $r="<script>swal(
        '".$titulo."',
        '".$desc."',
        '".$tipo."'
      )</script>";
      return $r;
}
function printMessageWithRedirect($titulo,$desc,$tipo,$route){
    $r="<script>swal(
        '".$titulo."',
        '".$desc."',
        '".$tipo."'
      ).then(function(){
        window.location.href='".$route."'
      })</script>";
      return $r;
}
function strtotitle($title)
{
    $title=strtolower($title);
    $smallwordsarray = array(
        'of', 'a', 'the', 'and', 'an', 'or', 'nor', 'but', 'is', 'if', 'then', 'else', 'when',
        'at', 'from', 'by', 'on', 'off', 'for', 'in', 'out', 'over', 'to', 'into', 'with', 'en', 'y', 'de', 'e', 'el', 'a', 'para',
        'u', 'con', 'del', 'la'
    );
    $words = explode(' ', $title);
    foreach ($words as $key => $word) {
        if ($key == 0 or !in_array($word, $smallwordsarray))
            $words[$key] = ucwords($word);
    }
    $newtitle = implode(' ', $words);

    return $newtitle;
}


function sendMail($mail, $name,$id)
{
    $PHPmail=new PHPMailer();
    $PHPmail->CharSet = 'UTF-8';
    $PHPmail->IsSMTP();
    $PHPmail->Host       = 'smtp.gmail.com';
    $PHPmail->SMTPSecure = 'tls';

    $PHPmail->Port       = 587;
    $PHPmail->SMTPDebug  = 0;
    $PHPmail->SMTPAuth   = true;
    $PHPmail->Username   = 'amazoniaenlinea@gmail.com';
    $PHPmail->Password   = 'amazonas123';
    $PHPmail->SetFrom('amazoniaenlinea@gmail.com', "Amazonia en Linea");
   
     $PHPmail->Subject    = 'Confirm your email';
    $PHPmail->MsgHTML('
            <div style="background-color: rgba(222,222,222,0.6); margin-left: 15%; margin-right: 15%;">
    <div style=" margin-left: 5%; margin-right: 5%; padding-top: 5%; padding-bottom: 5%;">
        <div style="background-color: rgba(255,255,255);">
            
            <div style="margin-left: 10%; margin-right: 10%;"><br><br>
                <p>We welcome '.$name.' to the Amazonia en linea portal.</p>
                <p>In order to use all of our services please click on the following button to finish your registration process.</p><br><br><br>
                <center><a href="http://localhost:8080/Amazonia/view/index.php?menu=signin&i='.base64_encode($id).'" style="background-color:#f3984d;border:10px solid #f3984d;text-decoration:none;color:#fff" target="_blank">Activate account</a></center>
                <br><br>
            </div>
            <br><br><br><br>
            </div>
    </div>
</div>
            ');

    $PHPmail->AddAddress($mail, $name);
    $PHPmail->Send();
   
}
?>
