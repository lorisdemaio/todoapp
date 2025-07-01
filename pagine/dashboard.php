<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>To do app | Dashboard</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../index.css'>
    <link rel="icon" href="../assets/logo.png" type="image/x-icon">

    <style>
    .grid
    {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1rem;
        width: 100%;
        max-width: 1200px;
    }

    .task
    {
        background-color: #8b8b8b2a;
        backdrop-filter: blur(90px);
        -webkit-backdrop-filter: blur(90px);

        padding: 1rem;
        margin-top: 1rem;

        border-radius: 2rem;
        border: 1px solid var(--bg2);

        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .task h2
    {
        font-size: 1.5rem;
        color: #fff;
    }

    .task p
    {
        color: #fff;
        text-align: start;
    }
</style>
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
            <div style="display: flex; justify-content: center; align-items: center; gap: 1rem;">
                <?php
                    include '../config.php';

                    if(isset($_SESSION['username'])) 
                    {
                        echo "<span style='color: #fff; font-weight: bold;'>" . $_SESSION['username'] . "</span>";
                        
                        echo "<form method='POST' action='./logout.php'>";
                        echo "<button type='submit' class='btn-logout'>Logout</button>";
                        echo "</form>";

                    } 
                    else header("Location: ../index.html");
                ?>
            </div>
        </nav>
    </header>
    
    <!-- MAIN CONTENT -->
    <main>
        <section>   
             <form method="POST" class="form">
                <h1>Aggiungi task</h1>
                <div>
                    <label for="username">Titolo:</label>
                    <input type="text" id="username" name="titolo" required>
                </div>
                <div>
                    <label for="descrizione">Descrizione:</label>
                    <input type="text" id="descrizione" name="descrizione" required>
                </div>

                <?php
                    if($_SERVER["REQUEST_METHOD"] === "POST")
                    {
                        $titolo = $_POST['titolo'];
                        $descrizione = $_POST['descrizione'];
                        $id_utente = $_SESSION['id'];

                        $ql = "INSERT INTO task (titolo, descrizione, stato, id_utente) VALUES ('$titolo', '$descrizione', 'non completata', '$id_utente')";
                        if($conn -> query($ql)) echo "<span style='color: green;'>Task aggiunto con successo!</span>";
                        else echo "<span style='color: red;'>Errore nell'aggiunta del task: " . $conn->error . "</span>";
                    }
                ?>

                <button type="submit" class="btn">Aggiungi task</button>
            </form>
            
            <hr style="height: 2px; width: 100%; background-color: white; color: white; margin-top: 50px; margin-bottom: 50px;">

            <div class="grid">
                <?php
                    $id_utente = $_SESSION['id'];
                    $ql = "SELECT * FROM task WHERE id_utente = '$id_utente'";
                    $result = $conn -> query($ql);

                    if($result -> num_rows > 0)
                    {
                        while($row = $result -> fetch_assoc())
                        {
                            echo "<div class='task'>";
                            echo "<h2>" . $row['titolo'] . "</h2>";
                            echo "<p>" . $row['descrizione'] . "</p>";
                            if($row['stato'] == 'completata') 
                            {
                                echo "<p>Stato: <span style='color: green;'>Completata</span></p>";
                            } 
                            else 
                            {
                                echo "<p>Stato: <span style='color: red;'>Non completata</span></p>";
                            }
                            echo "<p>" . $row['data'] . "</p>";
                            
                            echo "<form method='POST' action='./completa_task.php'>";
                            echo "<input type='hidden' name='id_task' value='" . $row['id'] . "'>";
                            echo "<button type='submit' class='btn' style='width: 100%'>Completa</button>";
                            echo "</form>";

                            echo "</div>";
                        }
                    }
                    else echo "<span style='color: red;'>Nessun task disponibile.</span>";
                ?>
            </div>

        </section>
    </main>
    
    <!-- FOOTER -->
    <footer>

    </footer>
</body>
</html>