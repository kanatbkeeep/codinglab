<?php
$mysqli = mysqli_connect("localhost", "root", "", "codingLab");
if (isset($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
    $results = mysqli_query($mysqli, "SELECT * FROM  `users` where `login`='$user' ");
    $results = mysqli_fetch_assoc($results);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $matchResult = $mysqli->query("SELECT * FROM matches WHERE ID = '$id'");
        $matchResult = mysqli_fetch_assoc($matchResult);
    }
}
$result = $mysqli->query("SELECT * FROM matches ORDER BY ID DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/match_style.css">
</head>
<body>
<section id="menu">
    <img src="https://img.icons8.com/ios-filled/50/ffffff/multiply.png" alt="exit" id="exitIcon">
    <a href="index.php" class="menuList">Home</a>
</section>

<section id="all">
    <section class="navbar">
        <nav>
            <div class="leftSide">
                <div id="menuButton">
                    <div class="menuLine"></div>
                    <div class="menuLine"></div>
                    <div class="menuLine"></div>
                </div>
                <a href="index.php" class="logo_box">TaDaNatBet</a>
            </div>

            <div class="rightSide">
                <form>
                    <label>
                        <img src="https://img.icons8.com/ios-filled/24/000000/search--v1.png" alt="searchIcon"
                             class="searchIcon">
                        <input type="search" class="search" placeholder="Search here">
                    </label>
                </form>

                <?php
                if (isset($_COOKIE['user'])) {
                    echo '<a href="user.php" style="margin: 0 30px">
                    <span style="font-weight: bold">User: </span>' . $_COOKIE['user'] . '
                    <br>
                    <span style="font-weight: bold">Balance: </span>' . $results['balance'] . ' тг
                    </a>';
                } else {
                    echo '<a href="login.php" class="logButton">Login</a>
                <a href="registration.php" class="logButton">Registration</a>';
                }
                ?>

            </div>
        </nav>
    </section>

    <section>
        <div class="matchBanner">
            <div class="inBanner">
                <h1 class="tournamentName"><?php echo $matchResult['tournament']?></h1>
            </div>
        </div>
    </section>

    <section class="matchInfo">
        <h1 class="teams">
            <?php echo $matchResult['teamName1']?> - <?php echo $matchResult['teamName2']?>
        </h1>

        <table class="match">
            <thead>
            <tr>
                <th>coefficient to <?php echo $matchResult['teamName1']?> win</th>
                <th>draw</th>
                <th>coefficient to <?php echo $matchResult['teamName2']?> win</th>
            </tr>
            <tr>
                <td><?php echo $matchResult['teamCoefficient1']?></td>
                <td><?php echo $matchResult['draw']?></td>
                <td><?php echo $matchResult['teamCoefficient2']?></td>
            </tr>
            </thead>
        </table>
    </section>

    <section class="summitBet">
        <form>
            <input type="text" placeholder="bet on winning <?php echo $matchResult['teamName1']?>">
            <button type="submit">BET</button>
        </form>

        <form>
            <input type="text" placeholder="bet on winning <?php echo $matchResult['teamName2']?>">
            <button type="submit">BET</button>
        </form>

        <form>
            <input type="text" placeholder="bet on draw">
            <button type="submit">BET</button>
        </form>
    </section>
</section>
<script src="js/jquery-3.5.1.js"></script>
<script src="js/script.js"></script>
</body>
</html>
