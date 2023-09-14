<?php
ob_end_clean();
 $conn = new mysqli('localhost', 'root', '', 'datab');

 if ($conn->connect_errno) {
  die('connection failed:' . $conn->connect_error);
} else {
  session_start();
  if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }
    $username = validate($_POST['username']);

    $password = validate($_POST['password']);

    if (empty($username) || empty($password)) {
      echo '<label>
      <input type="checkbox" class="alertCheckbox" autocomplete="off" />
      <div class="alert error">
        <span class="alertClose">X</span>
        <span class="alertText">Veuillez remplir tous les champs.
            <br class="clear"/></span>
      </div>
    </label>';

    include 'sign.html'; 
    exit();
  }
  else{

    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        if ($row['username'] === $username && $row['password'] === $password) {

         

            $_SESSION['username'] = $row['username'];

           

            header("Location: rech.php");

            exit();

          }else{

            echo '<label>
            <input type="checkbox" class="alertCheckbox" autocomplete="off" />
            <div class="alert error">
              <span class="alertClose">X</span>
              <span class="alertText">Nom d\'utilisateur ou mot de passe invalide.
                  <br class="clear"/></span>
            </div>
          </label>';
          
     include 'sign.html'; 
        }

    }else{

      echo '<label>
      <input type="checkbox" class="alertCheckbox" autocomplete="off" />
      <div class="alert error">
        <span class="alertClose">X</span>
        <span class="alertText">Nom d\'utilisateur ou mot de passe invalide.
            <br class="clear"/></span>
      </div>
    </label>';
    
    include 'sign.html'; 
        exit();

    }

}

}else{

  echo '<label>
  <input type="checkbox" class="alertCheckbox" autocomplete="off" />
  <div class="alert error">
    <span class="alertClose">X</span>
    <span class="alertText">Nom d\'utilisateur ou mot de passe invalide.
        <br class="clear"/></span>
  </div>
</label>';

include 'sign.html'; 

}
$conn->close();

}
?>

