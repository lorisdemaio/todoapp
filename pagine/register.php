<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>To do app | Register</title>
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
                <h1>Registrati</h1>
                <div>
                    <label for="username">Nome Utente:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
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
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

                        $ql = "INSERT INTO utenti (username, email, password) VALUES ('$username', '$email', '$pass_hash')";
                        if($conn -> query($ql))
                        {
                            echo "<span style='color: green;'>Registrazione completata con successo! <a href='./login.php'>Accedi</a></span>";
                            exit();
                        }
                        else echo "errore: " . $conn -> error;
                    }
                ?>

                <button type="submit" class="btn">Registrati</button>
                <p>Hai già un account? <a href="./login.php">Accedi</a></p>
            </form>
        </section>
    </main>
    
    <!-- FOOTER -->
    <footer>

    </footer>
</body>
</html>