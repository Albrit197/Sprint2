<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "sprint2";
$board = 'employees';

                 //   Connection to data base logic

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());
                       
                 //   Table selection logic

if (isset($_GET['path']) and $_GET['path'] !== $board) {
    if ($_GET['path'] == 'employees' or $_GET['path'] == 'projects')
        $board = $_GET['path'];
}

                 //   Deletion logic

if (isset($_GET['delete'])) {
    $sql_delete = "DELETE FROM " . $board . " WHERE id = " . $_GET['delete'];
    $stmt = $conn->prepare($sql_delete);
    $stmt->execute();
    header("Location: /Sprint2/?path=" . $_GET['path']);
}

                 //   Adding new employee and project logic

if (isset($_POST['ADD'])) {
    print($_POST['name']);
    $sql_add = "INSERT INTO " . $board . " (`name`) VALUES (?)";
    $stmt = $conn->prepare($sql_add);
    $stmt->bind_param("s", $_POST['name']);
    $stmt->execute();
    header("Location: /Sprint2/?path=" . $_GET['path']);
}

                //   Joining two table logic

$sql = "SELECT "
    . $board . ".id, "
    . $board . ".name, GROUP_CONCAT(" . ($board === 'projects' ? 'employees' : 'projects') . ".name SEPARATOR \", \")" .
    " FROM " . $board .
    " LEFT JOIN " . ($board === 'projects' ? 'employees' : 'projects') .
    " ON " . ($board === 'projects' ? 'employees.projects = projects.id' : 'employees.projects = projects.id') .
    " GROUP BY " . $board . ".id;";

$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($id, $mainEntityName, $relatedEntityName);

?>

                <!-- Table visualisation -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud PHP</title>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    </div>
    <header>
        <nav>
            <div>
                <ul>
                    <a class='badge badge-info' style="font-size: medium; margin-top:50px" href="?path=projects">Projects</a>
                    <a class='badge badge-info' style="font-size: medium; margin-top:50px" href="?path=employees">Employees</a>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <?php
            echo '<table class="table"><th>Id</th><th>Name</th><th>' . ($board === 'projects' ? 'Employees' : 'Projects') . '</th><th>Actions</th>';
            while ($stmt->fetch()) {
                echo "<tr>
                            <td>" . $id . "</td>
                            <td>" . $mainEntityName . "</td>
                            <td>" . $relatedEntityName . "</td>
                            <td>
                                <a class='btn btn-danger' href=\"?path=" . $board . "&delete=$id\">Delete</a>
                                <a class='btn btn-info' href=\"?path=" . $board . "&edit=$id\">Edit</a>
                            </td>
                        </tr>";
            }
            echo '</table>';
            ?>
        </div>

        <?php
        echo "
             <div class='row justify-content-center'>
             <br><br><form  action=\"\" method=\"POST\">
                 <input type=\"text\" name=\"name\" value=\"\" placeholder=\"enter "
            . ($_GET['path'] === 'projects' ? 'project' : 'name')  . "\">
                            <input type=\"submit\" value=\"ADD "
            . ($_GET['path'] === 'projects' ? 'projects' : 'employees') . "\" name=\"ADD\">
                        </form></div>";
        ?>
    </div>
    </div>
</body>

</html>
<?php
$stmt->close();
mysqli_close($conn);
?>