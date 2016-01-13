<?php
require_once 'dblink.php';

$query = "SELECT * FROM Main JOIN Wallpaper on Main.image = Wallpaper.id";
$result = mysqli_fetch_array(mysqli_query($db_link, $query));

$title = $result["slogan"];
$background = $result["img_path"];
?>
<head>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Lobster|Roboto|Roboto:300|Roboto+Condensed' rel='stylesheet'
          type='text/css'>
    <link rel="stylesheet" type="text/css" href="edit_styles.css">
    <link rel="stylesheet" type="text/css" href="vendors/ionicons/css/ionicons.css">

    <title>Start</title>
    <script type="text/javascript" src="vendors/jquery/jquery.js"></script>
    <script type="text/javascript" src="main.js">
        <script>
        window.addEventListener('preload', function load() {
            window.removeEventListener('preload', load, false);
            document.body.classList.remove('preload');
        }, false);
    </script>
    <style>
        body {background: url(<?php echo $background ?>);}
    </style>
</head>
    <body class="preload">
    <div id="wrapper">
        <h1><?php echo $title ?></h1>
        <form id="add_link" action="functions.php?f=addLink" method="POST">
            <select name="category">
                <option value='none'>-- Select Category --</option> ";

        <?php

        $categories = array();
        $catres = mysqli_query($db_link, "SELECT title FROM Category WHERE title != 'Search' ORDER BY priority");
        while($catrow = mysqli_fetch_array($catres)) {
            $categories[] = $catrow["title"];
        }

        foreach($categories as $category_title) {

            echo "<option value='$category_title'>$category_title</option>";

        }
        ?>

            </select>
            <input type="text" name="title" placeholder="Title">
            <input type="text" name="link" placeholder="Link">
            <input type="submit" value="Submit">
        </form>

        <?php
        foreach($categories as $category_title) {

            echo "<div class='table-wrapper'>
        <h2>$category_title</h2>
        <table class='listhead'>
            <tr>
                <th>Title</th>
                <th>Link</th>
            </tr>
        </table>
        <div class='table-body'>
            <table class='linklist'>";

            $li_query = "SELECT title, link FROM List_item " .
                "WHERE category = '$category_title' ORDER BY priority";
            $result = mysqli_query($db_link, $li_query);
            while ($row = mysqli_fetch_array($result)) {
                $href = $row['link'];
                $title = $row['title'];

                echo "<tr> " .
                    "<td class='li_title'>$title</td> " .
                    "<td>$href</td> " .
                    "<td><i class='icon ion-close-round'></i></td> " .
                    "</tr>";
            }
            echo '</table>
        </div>
        </div>';
        }
        ?>
    </div>
    </body>
</html>
