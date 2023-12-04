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
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if($user == $row["cuenta"] && $password == $row["contrasena"] && $row["bloqueado"]!=1){
                    $band = 1;
                    if(!empty($_POST["remember"])){
                        setcookie("user", $user, time()+3600);
                        setcookie("password", $password, time()+ 3600);
                        echo "cookies puestas";
                    } else {
                        setcookie("user","");
                        setcookie("password","");
                        echo "cookies no";
                    }
                    break;
                }
                if(($user == $row["cuenta"] && $password == $row["contrasena"] && $row["bloqueado"]==1) || ($user == $row["cuenta"] && $row["bloqueado"]==1)){
                    $band = 3;
                    break;
                }
                if($user == $row["cuenta"]){
                    $band = 2;
                    break;
                }
            }
        }

        if ($band == 1) { 
            $_SESSION["user"] = $user;
            $_SESSION["attempts"]=0;
        } else if ($band == 2) {
            if(empty($_SESSION["attempts"])){
                $_SESSION["attempts"]=1;
            } else {
                $_SESSION["attempts"]++;
            }
            if($_SESSION["attempts"] >= 3){
                $sql = "UPDATE usuarios SET bloqueado=1 WHERE cuenta = '$user'";
                $result = $conn->query($sql);
            }
        } else if($band = 3){
            $_SESSION["recover"]=$user;
            header("Location: recovery.php");
        }

    }
  } 
  $conn->close();
}
?>