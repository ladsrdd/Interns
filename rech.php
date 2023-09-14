<?php
$conn = new mysqli('localhost', 'root', '', 'datab');
if ($conn->connect_errno) {
    die('Connection failed: ' . $conn->connect_error);
}

// Initialize variables to store search results
$searchResults = array();

// Check if the 'search' key exists in the $_POST array
if (isset($_POST['search'])) {
    $querystring = mysqli_real_escape_string($conn, $_POST['search']);

    // Perform the search query
    $result = mysqli_query($conn, "SELECT * FROM form WHERE nom LIKE '%$querystring%' OR prénom LIKE '%$querystring%'");

    // Store the search results in an array
    while ($row = mysqli_fetch_assoc($result)) {
        $searchResults[] = $row;
    }
}
?>










<?php
require_once('conn.php');
$query="SELECT * FROM form";
$result= mysqli_query($conn,$query);
?>



<!DOCTYPE html>
<html lang="fr">
  <head>
    
    <meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Interns - TGR</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet"
          href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  	<link rel="shortcut icon" href="favicon.png" type="img/x-icon"/>
    <link href="css/page.css" rel="stylesheet">
  
    <link href="css/sign.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
   
  </head>
  <body class="lang-en">
  
<!-- Header -->
    <header id="one">
      <nav>
        <div class="menu-toggle inner-btn float-left">
          <img src="img/x.svg" alt="Menu">
        </div>
        <ul>
          <h3>Menu</h3>
          <li><a href="index.html">Accueil</a></li>
          <br>
          <li><a href="index.html#two">Services</a></li>
          <br>
          <li><a href="form.html" >Formulaire</a></li>
          <br>
          <li><a href="sign.html" >Espace Administrateurs</a></li>
          <br>
          <li><a href="index.html#four">À propos de nous</a></li>
        </ul>
        <ul class="lower-menu">
          <h3>Contact</h3>
          <li><a href="#five">Contactez-nous</a></li>
        </ul>
       
        <h5>© TGR 2023</h5>
      </nav>
      <div class="container">
        <div id="MagicMenu" class="nav-header">
          <div class="container">
            <div class="logo float-left">
              <a href="index.html#one"><img src="img/logo.png" alt="logo"></a>
            </div>
            <div class="menu-toggle float-right">
              <img src="img/menu.svg" alt="Menu">
            </div>
          </div>
        </div>
      </div>
     <div class="search">
     <form action="rech.php" method="POST">
     <input type="text" name="search" id="search" placeholder="Recherche..">
     <button ><i class="fa fa-search"></i></button></form>
</div>
<div class="stat">
<a href='charts.php'class="simple-button">> Statistiques</a>
</div>
<style>

.simple-button {
  display: inline-block;
  padding: 5px 10px;
  color: #333;
  cursor: pointer;
  font-size: 16px;
  text-align: center;
  margin-top: 105px;
  margin-left: 850px;
  text-decoration: none;
  transition: text-decoration 0.3s ease-in-out;
}

/* Underline on hover */
.simple-button:hover {
  text-decoration: underline;
  font-size: 18px;
}
</style>

     </div>
    </header>
   <div class="card-body"><table class="table table-bordered text-center">
    <tr class="bg-dark text-white">
    <td>id</td>
      <td>Nom</td>
      <td>Prénom</td>
      <td>Email</td>
      <td>Ecole</td>
      <td>Durée</td>
      <td>Date de début</td>
      <td>Date de fin</td>
      <td>CV</td>
      <td>Rapport</td>
      <td>Modifier</td>
      <td>Supprimer</td>
      </tr>
        <?php
        if (!empty($searchResults)) {
            // Display search results
            foreach ($searchResults as $row) {
                $id = $row['id'];
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['nom']}</td>";
                echo "<td>{$row['prénom']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['school']}</td>";
                echo "<td>{$row['duration']}</td>";
                echo "<td>{$row['bdate']}</td>";
                echo "<td>{$row['fdate']}</td>";
                echo '<td><a id="voir" href="cv/' . $row['cv_name'] . '"target="_blank">Voir</a> &nbsp; <a id="voir" href="cv/' . $row['cv_name'] . '" download>Télécharger</a></td>';
                echo '<td><a id="voir" href="rapports/' . $row['rapp_name'] . '"target="_blank">Voir</a> &nbsp; <a id="voir" href="rapports/' . $row['rapp_name'] . '" download>Télécharger</a></td>';
                echo "<td><a href='modifier.php?modid=$id' class='btn btn-primary btn-sm'>Modifier</a></td>";
                echo "<td><a href='supprimer.php?suppid=$id' class='btn btn-danger btn-sm' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');\">Supprimer</a></td>";
                echo "</tr>";
            }
        } else {
            // Display regular content or default results if no search results
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['nom']}</td>";
                echo "<td>{$row['prénom']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['school']}</td>";
                echo "<td>{$row['duration']}</td>";
                echo "<td>{$row['bdate']}</td>";
                echo "<td>{$row['fdate']}</td>";
                echo '<td><a id="voir" href="cv/' . $row['cv_name'] . '"target="_blank">Voir</a> &nbsp; <a id="voir" href="cv/' . $row['cv_name'] . '" download>Télécharger</a></td>';
                echo '<td><a id="voir" href="rapports/' . $row['rapp_name'] . '"target="_blank">Voir</a> &nbsp; <a id="voir" href="rapports/' . $row['rapp_name'] . '" download>Télécharger</a></td>';
                echo "<td><a href='modifier.php?modid=$id' class='btn btn-primary btn-sm'>Modifier</a></td>";
                echo "<td><a href='supprimer.php?suppid=$id' class='btn btn-danger btn-sm' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?');\">Supprimer</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</div>


    }






    

    
    
<!-- Contact -->
<section id="five" class="contact">
    <div class="container">
      <div class="row">
        <div class="title">
          <h6>contact</h6>
          
        </div>
      </div>
      <div class="row">
        <div class="contact-info">
     
          <div class="ad">
            <img src="img/ad.png" alt="adresse" style="width: 20px;">
            <span class="spe"> Avenue Mohamed Toris, Boujdour</span>
          </div>
          <br>
          <div class="site">
            <img src="img/site.png" alt="site" style="width: 20px;">
            <a href=" https://tgr.gov.ma" class="spe"  target="_blank">tgr.gov.ma</a>
          </div>
          <br>
          <div class="tel">
            <img src="img/tel.png" alt="tel" style="width: 20px;">
            <span class="spe"> 05 28 89 60 15</span>
          </div>
        </div>
      </div>
    </div>
</section>

<!-- Footer -->
  <section class="footer">
    <h4>© 2023 - <span>TGR</span></h4>
  </section>

    

    

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>

  </body>
</html>
