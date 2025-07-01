<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>To do app | Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../index.css'>
    <link rel="icon" href="../assets/logo.png" type="image/x-icon">
</head>
<body>
    <!-- NAVBAR -->
    <header>
        <nav>
            <div>
                <a href="../index.html">
                    <img src="../assets/logo.png" alt="logo" loading="lazy" height="30" width="30" />
                </a>
            </div>
            <div>
                <a href="./login.php">Accedi</a>
            </div>
        </nav>
    </header>
    
    <!-- MAIN CONTENT -->
    <main>
        <section>   
            <form method="POST" class="form">
                <h1>Accedi</h1>
                <div>
                    <label for="username">Nome Utente:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <?php
                    include '../config.php';
                    if($_SERVER["REQUEST_METHOD"] === "POST")
                    {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        $ql = "SELECT * FROM utenti WHERE username = '$username'";
                        if($conn -> query($ql))
                        {
                            $result = $conn -> query($ql);
                            if($result -> num_rows > 0)
                            {
                                $row = $result -> fetch_assoc();
                                if(password_verify($password, $row['password']))
                                {
                                    session_start();
                                    $_SESSION['username'] = $username;
                                    $_SESSION['id'] = $row['id'];
                                    header("Location: ./dashboard.php");
                                    exit();
                                }
                                else echo "<span style='color: red;'>Password errata!</span>";
                            }
                        }
                        else echo "errore: " . $conn -> error;
                    }
                ?>

                <button type="submit" class="btn">Accedi</button>
                <p>Non hai un account? <a href="./register.php">Registrati</a></p>
            </form>
        </section>
    </main>
    
    <!-- FOOTER -->
    <footer>

    </footer>
</body>
</html>