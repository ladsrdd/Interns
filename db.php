
<?php
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nom = $_POST['nom'];
$prénom = $_POST['prénom'];

$email = $_POST['email'];

$sexe = $_POST['sexe'];
$school = $_POST['school'];
$duration = $_POST['duration'];
$bdate = $_POST['bdate'];
$fdate = $_POST['fdate'];
$cv = $_FILES['cv']['tmp_name'];
$rapport = $_FILES['rapport']['tmp_name'];
if (empty($nom) || empty($prénom)  || empty($email) || empty($sexe) || empty($school) || empty($rapport)  || empty($duration) || empty($bdate) || empty($fdate) || empty($cv)) {

    echo '<label>
    <input type="checkbox" class="alertCheckbox" autocomplete="off" />
    <div class="alert error">
      <span class="alertClose">X</span>
      <span class="alertText">Veuillez remplir tous les champs obligatoires.
          <br class="clear"/></span>
    </div>
  </label>';
} else {
    


$conn = new mysqli('localhost', 'root', '', 'datab');
if ($conn->connect_errno) {
    die('connection failed:' . $conn->connect_error);
} else {
    $f = $conn->prepare("INSERT INTO form (nom, prénom, email, sexe, school, duration, bdate, fdate) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)");

 
    $f->bind_param("ssssssss", $nom, $prénom, $email, $sexe, $school, $duration, $bdate, $fdate);

    $f->execute();

    echo  '<label>
      <input type="checkbox" class="alertCheckbox" autocomplete="off" />
      <div class="alert success">
        <span class="alertClose">X</span>
        <span class="alertText">Formulaire soumis avec succès!<br />
            <br class="clear"/></span>
      </div>
    </label>';

    $f->close();

 
    $cvName = rand(1000, 10000) . "-" . $_FILES["cv"]["name"];
    $cvTmpName = $_FILES["cv"]["tmp_name"];
    $cvUploadPath = 'C:\xampp\htdocs\stage\cv';
    move_uploaded_file($cvTmpName, $cvUploadPath . '/' . $cvName);
    $sqlCV = "INSERT INTO cvs (name) VALUES ('$cvName')";
    $conn->query($sqlCV);

    $rapportName = rand(1000, 10000) . "-" . $_FILES["rapport"]["namex"];
    $rapportTmpName = $_FILES["rapport"]["tmp_name"];
    $rapportUploadPath = 'C:\xampp\htdocs\stage\rapports';
    move_uploaded_file($rapportTmpName, $rapportUploadPath . '/' . $rapportName);
    $sqlRapport = "INSERT INTO rapports (rapp) VALUES ('$rapportName')";
    $conn->query($sqlRapport);

    $conn->close();
}
}}


?>
<?php require 'form.html'; ?>*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$nom = $_POST['nom'];
$prénom = $_POST['prénom'];

$email = $_POST['email'];

$sexe = $_POST['sexe'];
$school = $_POST['school'];
$duration = $_POST['duration'];
$bdate = $_POST['bdate'];
$fdate = $_POST['fdate'];
$cv = $_FILES['cv']['tmp_name'];
$rapport = $_FILES['rapport']['tmp_name'];
if (empty($nom) || empty($prénom)  || empty($email) || empty($sexe) || empty($school) || empty($rapport)  || empty($duration) || empty($bdate) || empty($fdate) || empty($cv)) {

    echo '<label>
    <input type="checkbox" class="alertCheckbox" autocomplete="off" />
    <div class="alert error">
      <span class="alertClose">X</span>
      <span class="alertText">Veuillez remplir tous les champs obligatoires.
          <br class="clear"/></span>
    </div>
  </label>';
} else {
    


$conn = new mysqli('localhost', 'root', '', 'datab');
if ($conn->connect_errno) {
    die('connection failed:' . $conn->connect_error);
} else {
  

 
    $cvName = rand(1000, 10000) . "-" . $_FILES["cv"]["name"];
    $cvTmpName = $_FILES["cv"]["tmp_name"];
    $cvUploadPath = 'C:\xampp\htdocs\stage\cv';
    move_uploaded_file($cvTmpName, $cvUploadPath . '/' . $cvName);
    

    $rapportName = rand(1000, 10000) . "-" . $_FILES["rapport"]["name"];
    $rapportTmpName = $_FILES["rapport"]["tmp_name"];
    $rapportUploadPath = 'C:\xampp\htdocs\stage\rapports';
    move_uploaded_file($rapportTmpName, $rapportUploadPath . '/' . $rapportName);
   
    $f = $conn->prepare("INSERT INTO form (nom, prénom, email, sexe, school, duration, bdate, fdate, cv_name, rapp_name) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

 
    $f->bind_param("ssssssssss", $nom, $prénom, $email, $sexe, $school, $duration, $bdate, $fdate, $cvName, $rapportName);

    $f->execute();

    echo  '<label>
      <input type="checkbox" class="alertCheckbox" autocomplete="off" />
      <div class="alert success">
        <span class="alertClose">X</span>
        <span class="alertText">Formulaire soumis avec succès!<br />
            <br class="clear"/></span>
      </div>
    </label>';

    $f->close();
    $conn->close();
}
}}


?>
<?php require 'form.html'; ?>

