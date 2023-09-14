<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_GET['modid'];

    $nom = $_POST['nom'];
    $prénom = $_POST['prénom'];
    $email = $_POST['email'];
    $sexe = $_POST['sexe'];
    $school = $_POST['school'];
    $duration = $_POST['duration'];
    $bdate = $_POST['bdate'];
    $fdate = $_POST['fdate'];
    $cvTmpName = $_FILES['cv']['tmp_name'];
    $rapportTmpName = $_FILES['rapport']['tmp_name'];

    $conn = new mysqli('localhost', 'root', '', 'datab');
    if ($conn->connect_errno) {
        die('connection failed:' . $conn->connect_error);
    } else {
        $sql = "SELECT * FROM form WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();

        $row = mysqli_fetch_assoc($result);
        $existingCVName = $row['cv_name'];
        $existingRapportName = $row['rapp_name'];

        // Check if a new CV file is uploaded
        if (!empty($cvTmpName)) {
            $cvName = rand(1000, 10000) . "-" . $_FILES["cv"]["name"];
            $cvUploadPath = 'C:\xampp\htdocs\stage\cv';
            move_uploaded_file($cvTmpName, $cvUploadPath . '/' . $cvName);
        } else {
            // No new CV file, keep the existing filename
            $cvName = $existingCVName;
        }

        // Check if a new rapport file is uploaded
        if (!empty($rapportTmpName)) {
            $rapportName = rand(1000, 10000) . "-" . $_FILES["rapport"]["name"];
            $rapportUploadPath = 'C:\xampp\htdocs\stage\rapports';
            move_uploaded_file($rapportTmpName, $rapportUploadPath . '/' . $rapportName);
        } else {
            // No new rapport file, keep the existing filename
            $rapportName = $existingRapportName;
        }

        $sql = "UPDATE form SET nom=?, prénom=?, email=?, sexe=?, school=?, duration=?, bdate=?, fdate=?, cv_name=?, rapp_name=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", $nom, $prénom, $email, $sexe, $school, $duration, $bdate, $fdate, $cvName, $rapportName, $id);

        $stmt->execute();

        header('location:rech.php');

        $stmt->close();
        $conn->close();
    }
}
?>

    


<?php
  $id = $_GET['modid'];
require_once('conn.php');
$query="SELECT * FROM form WHERE id=$id" ;
$res= mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="favicon.png" type="img/x-icon"/>
  	<title>Interns - TGR</title>
    
  </head>
  <style> form {
	max-width: 600px;
	margin: 0 auto;
  }
  
  /* Add border and padding to each fieldset */
  fieldset {
	margin-bottom: 15px;
	padding: 10px;
	border: 1px solid #2C4755; /* Add a border around each fieldset */
  }
  
  legend {
	padding: 0px 3px;
	font-weight: bold;
	font-variant: small-caps;
  }
  
  label {
	width: 110px;
	display: inline-block;
	vertical-align: top;
	margin: 6px;
  }

  input:focus {
	background: #eaeaea;
  }
  
  input,
  textarea {
	width: 249px;
	
  }
  
  textarea {
	height: 100px;
  }
  
  select {
	width: 254px;
  }
  
  /* Submit button styling */
  input[type=submit] {
	border-radius: 20px;
	width: 150px;
	color: #ffffff;
	background-color: rgb(81, 127, 66);
	padding: 10px;
	cursor: pointer;
	transition: background-color 0.3s ease;
  }
  
  /* Hover effect for submit button */
  input[type=submit]:hover {
	background-color: rgb(112, 192, 109);
  }
/* Style the radio buttons and labels */
fieldset label[for="homme"],
fieldset label[for="femme"] {
  display: inline-block;
  margin-right: 15px;
  font-size: 16px;
  color: #333;
  cursor: pointer;
}
#ann {
  border-radius: 20px;
	width: 150px;
	color:#222222;
	background-color:aliceblue;
	padding: 10px;
	cursor: pointer;
	transition: background-color 0.3s ease;
  }
  
  /* Hover style for the button */
  #ann:hover {
	background-color:#eaeaea /* Change the background color on hover */
  }

fieldset input[type="radio"] {
  vertical-align: middle;
  margin-right: 5px;
}

/* Hide default radio button appearance */
fieldset input[type="radio"] {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  border: 2px solid #333;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  outline: none;
  cursor: pointer;
}

/* Style the custom radio button when checked */
fieldset input[type="radio"]:checked {
  background-color: #333;
}

/* Adjust the alignment of the radio buttons with the labels */
fieldset input[type="radio"] + label[for="homme"],
fieldset input[type="radio"] + label[for="femme"] {
  vertical-align: middle;
}
form {
	max-width: 800px; /* Increase the max-width to make the form wider */
	margin: 50px auto; /* Add some margin to push the form down */
	padding: 20px;
  }
  input,
textarea,
select {
  width: 400px; /* Increase the width to make the input fields wider */
  padding: 10px; /* Increase the padding for better spacing */
}
.ban p{
	font-size: larger;
	margin-bottom: 25px;
}
.alert {
	position: absolute;
	top: 25%;
	left: 60%;
	transform: translate(-50%, -50%);
	width: 300px;
	height: 100px;
	padding: 20px;
	margin: 0;
	line-height: 1.8;
	border-radius: 10px;
	cursor: pointer;
	font-family: sans-serif;
	font-weight: 400;
	background-color: #FEE;
	font-size: 16px;
	transition: background-color 0.3s, color 0.3s; /* Add transition for smooth hover effect */
}

.alert:hover {
	background-color: rgba(160, 155, 155, 0.096); /* Change background color on hover */
	color: #222222; /* Change text color on hover */
}

.alertCheckbox {
	display: none;
}

:checked + .alert {
	display: none;
}

.alertText {
	text-align: center;
}

.alertClose {
	float: right;
	padding-top: 5px;
	font-size: 10px;
}

.clear {
	clear: both;
}
.success {
	background-color: #EFE;
	border: 1px solid #DED;
	color: #9A9;
  }
  .error {
	background-color: #FEE;
	border: 1px solid #EDD;
	color: #A66;
  }  
em{
	color: red;
}</style>
  <body class="lang-en">
    <form  method="post" enctype="multipart/form-data">
  
    <div class="banner">
    <fieldset>
      <legend> Contact </legend>
     
      <?php
     if ($row= mysqli_fetch_assoc($res)){
      
      
?>
      <label for="nom">Nom<em>*</em></label>
      <input id="nom" type="text" name="nom" value="<?php  echo $row['nom'];?>" >
    <br>
    <label for="prénom">Prénom<em>*</em></label>
      <input id="prénom" type="text" name="prénom"  value="<?php echo $row['prénom'];?>">
    <br>
    
<label for="email" >Email<em>*</em></label>
      <input id="email" name="email" type="email" value="<?php echo $row['email'];?> "required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
    </fieldset>
    <fieldset>
      <legend>Information Personnelles</legend>
   <label for="sexe">Sexe<em>*</em></label>
      <input type="radio" name="sexe" value="m" id="homme"<?php if ($row['sexe'] === 'm') echo 'checked'; ?>>
      <label for="homme">Homme</label>
     
      <input type="radio" name="sexe" value="f" id="femme"<?php if ($row['sexe'] === 'f') echo 'checked'; ?>>
      <label for="femme">Femme</label>
  
    <br>
    <label for="ecole" >Ecole<em>*</em></label>
      <select name="school" >
        <option value="Autre"<?php if ($row['school'] === 'Autre') echo 'selected'; ?>>Autre</option>
        <option value="EST"<?php if ($row['school'] === 'EST') echo 'selected'; ?>>EST</option>
        <option value="ENCG" <?php if ($row['school'] === 'ENCG') echo 'selected'; ?>>ENCG</option>
        <option value="ESI" <?php if ($row['school'] === 'ESI') echo 'selected'; ?>>ESI</option>
        <option value="ENSA" <?php if ($row['school'] === 'ENSA') echo 'selected'; ?>>ENSA</option>
        <option value="BTS" <?php if ($row['school'] === 'BTS') echo 'selected'; ?>>BTS</option>
        <option value="FAC"<?php if ($row['school'] === 'FAC') echo 'selected'; ?>>Fac</option>
        <option value="FST"<?php if ($row['school'] === 'FST') echo 'selected'; ?>>Fst</option>
        <option value="OFPPT"<?php if ($row['school'] === 'OFPPT') echo 'selected'; ?>>Ofppt</option>
      </select>
   
    </fieldset>
    <fieldset>
      <legend>Information sur stage</legend>
      <label for="durée">Durée de stage </label>
      <select name="duration">
        <option value="1 mois" <?php if ($row['duration'] === '1 mois') echo 'selected'; ?>>Un mois</option>
        <option value="2 mois" <?php if ($row['duration'] === '2 mois') echo 'selected'; ?>>2 mois</option>
        <option value="3 mois" <?php if ($row['duration'] === '3 mois') echo 'selected'; ?>> 3 mois</option>
        <option value="6 mois" <?php if ($row['duration'] === '6 mois') echo 'selected'; ?>>6 mois</option>
      </select>
   
    <br>
    <label for="debut">Date de début</label>
      <input type="date" name="bdate" lang="fr" value="<?php echo $row['bdate']; ?>">
      <i class="fas fa-calendar-alt"></i>
  
    <br>
    <label for="fin">Date de fin </label>
      <input type="date" name="fdate" lang="fr" value="<?php echo $row['fdate']; ?>">
      <i class="fas fa-calendar-alt"></i>
   
    <br>
    <br>
    <label for="cv">CV (pdf) </label>
    <span><?php echo $row['cv_name']; ?></span>
      <input type="file" name="cv" >
  <br>
    <br>
    <label for="rapport">Rapport (pdf) </label>
    <span><?php echo $row['rapp_name']; ?></span>
      <input type="file" name="rapport" >
  
    <br>
    </fieldset>
      <input type="submit" value="Actualiser">
<span>
      <a href="rech.php"><input type="button" value="Annuler" id="ann"></a>
      </span>
      
 



    <?php } ?>

  </form>