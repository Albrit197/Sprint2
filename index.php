<?php
    
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "sprint2";
    $board = 'employees';

    if(isset($_GET['path']) and $_GET['path'] !== $board){
        if($_GET['path'] == 'employees' or $_GET['path'] == 'projects')
            $board = $_GET['path'];
    }

    $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) 
        die("Connection failed: " . mysqli_connect_error());

      if(isset($_GET['delete'])){
        $sql_delete = "DELETE FROM " . $board . " WHERE id = " . $_GET['delete'];
        $stmt = $conn->prepare($sql_delete);
        $stmt->execute();
        header("Location: /Sprint2.1/?path=" . $_GET['path']);
    }

    $sql = "SELECT " 
       . $board. ".id, " 
       . $board.".name, GROUP_CONCAT(" . ($board === 'projects' ? 'employees' : 'projects' ) . ".name SEPARATOR \", \")" . 
            " FROM " . $board . 
            " LEFT JOIN " . ($board === 'projects' ? 'employees' : 'projects') . 
            " ON " . ($board === 'projects' ? 'employees.id = projects.id' : 'employees.id = projects.id') .
            " GROUP BY " . $board . ".id;";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $mainEntityName, $relatedEntityName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>File Browser</title>
</head>
<body>
        <header class="">
            <nav>
                <div class="login">
                    <ul  class="create">
                        <li><a class='' href="?path=projects">Projects</a></li>
                        <li><a class='' href="?path=employees">Employees</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        
        <main  class="">
            <?php
                echo '<table class="row"><th>Id</th><th>Name</th><th>' . ($board === 'projects' ? 'employees' : 'Projects') . '</th><th>Actions</th>';
                while ($stmt->fetch()){
                    echo "<tr>
                            <td class='field'>" . $id . "</td>
                            <td class='field'>" . $mainEntityName . "</td>
                            <td class='field'>" . $relatedEntityName . "</td>
                            <td class='field'>
                                <button><a class='delete' href=\"?path=" . $board . "&delete=$id\">DELETE</a></button>
                                
                            </td>
                        </tr>";
                }
                echo '</table>';
                ?>
        </main>
</body>
</html>
<?php
    $stmt->close();
    mysqli_close($conn);
?>
