<?php 
$servername = "localhost:33065";
$username = "root";
$bd = "havenrecords";
$password = "";

$band = 0;

$conn = new mysqli($servername, $username, $password, $bd);

if ($conn->connect_error) {
  die("Can't connect to the database: " . $conn->connect_error);
}

if (!empty($_POST['signout'])) {
  session_start();

    $_SESSION = array();
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    $_SESSION["user"] = "";
    unset($_SESSION["user"]);
    unset($_SESSION["uemail"]);
    unset($_SESSION["uname"]);
    unset($_SESSION["newLogin"]);
    unset($_SESSION["cart"]);

    session_destroy();
    $_POST['signout'] = "";
} else {
  session_start();
  if (empty($_SESSION["user"])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['form_name']) && $_POST['form_name'] == "login")) {
        $user = $_POST["user"];
        $password = $_POST["password"];
        $_POST['form_name'] = "";
        unset($_POST['form_name']);


        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        

        $attempts = 0;
        $band =0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($user == $row["cuenta"] && password_verify($password, $row["contrasena"]) && $row["bloqueado"]!=1 && (isset($_POST['captcha']) && $_POST['captcha'] === $_SESSION['captcha'])){

                    unset($_SESSION['captcha']);
                    $band = 1;
                    $attempts = $row["intentos"];
                    if(!empty($_POST["remember"])){
                        setcookie("user", $user, time()+3600);
                        setcookie("password", $password, time()+ 3600);
                    } else {
                        setcookie("user","");
                        setcookie("password","");
                    }

                    $_SESSION["uemail"] = $row["email"];
                    $_SESSION["uname"] = $row["nombre"];

                    break;
                }
                if(($user == $row["cuenta"] && password_verify($password, $row["contrasena"]) && $row["bloqueado"]==1) || ($user == $row["cuenta"] && $row["bloqueado"]==1)){
                    $attempts = $row["intentos"];
                    $band = 3;
                    break;
                }
                if($user == $row["cuenta"]){
                    $attempts = $row["intentos"];
                    $band = 2;
                    break;
                } else {
                    
                }
                    
                
                $band = 0;
                $incorrectattempt = true;
            }
        }

        if ($band == 1) { 
            $_SESSION["user"] = $user;
            $sql = "UPDATE usuarios SET intentos=0 WHERE cuenta = '$user'";
            $result = $conn->query($sql);
            $_SESSION["newLogin"] = true;
        } else if ($band == 2) {

            $attempts++;
            $sql = "UPDATE usuarios SET intentos=". $attempts ." WHERE cuenta = '$user'";
            $result = $conn->query($sql);
            if($attempts >= 3){
                $sql = "UPDATE usuarios SET bloqueado=1 WHERE cuenta = '$user'";
                $band = 5;
                $result = $conn->query($sql);
                $_SESSION["recovered"]=0;
                if(isset($_SESSION["recovered"])) unset($_SESSION["recovered"]);
            } else {
                $incorrectLogin = true;
            }
        } else if($band == 3){
            $_SESSION["recover"]=$user;
            $_SESSION["recoverAccount"]=$user;
            if(isset($_SESSION["recovered"])) unset($_SESSION["recovered"]);
            $band = 5;
        }

        if(isset($incorrectattempt) && $band!=5){
            $incorrectLogin=true;
        }

    }
  } 
  $conn->close();
}
?>