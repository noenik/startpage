<html xmlns="http://www.w3.org/1999/html">
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
    <link rel="stylesheet" type="text/css" href="style.css">

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
<h1><?php echo $title ?></h1>

<div id="boxes">

    <?php
    $categories = array();
    $catres = mysqli_query($db_link, "SELECT title FROM Category ORDER BY priority");
    while($catrow = mysqli_fetch_array($catres)) {
        $categories[] = $catrow["title"];
    }

    foreach($categories as $category_title) {
        echo "<div class='box'> <h4>$category_title</h4> <ul>";

        if($category_title == "Search") {

            echo '<table id="search">

                        <tr>
                            <td><a href="https://www.google.com/">Google</a></td>
                            <td>
                                <form action="https://google.com/search?q=" method="get">
                                    <input type="text" name="q" autofocus/></form>
                            </td>
                        </tr>

                        <tr>
                            <td><a href="http://www.imdb.com/">IMDb</a></td>
                            <td>
                                <form action="http://www.imdb.com/find?q=" method="get">
                                    <input type="text" name="q"/></form>
                            </td>
                        </tr>

                        <tr>
                            <td><a href="https://en.wikipedia.org/wiki/Main_Page">Wikipedia</a></td>
                            <td>
                                <form action="https://en.wikipedia.org/w/index.php?title=Special%3ASearch&go=Go$search=" method="get">
                                    <input type="text" name="search"/></form>
                            </td>
                        </tr>

                    </table>';

        } else {
            $li_query = "SELECT title, link FROM List_item WHERE category = '$category_title' ORDER BY priority";
            $result = mysqli_query($db_link, $li_query);
            while($row = mysqli_fetch_array($result)){
                $href = $row['link'];
                $title = $row['title'];

                if($href == "#") {
                    echo "<span class='sub_li_hover'><br><li><a href='$href'>$title</a></li>";
                    echo '<ul class="sub_box"> ';
                    $sub_li_res = mysqli_query($db_link, "SELECT title, link FROM Sublist_item WHERE mainitem = '$title'");

                    while($sub_li_row = mysqli_fetch_array($sub_li_res)) {
                        $sub_href = $sub_li_row['link'];
                        $sub_title = $sub_li_row['title'];
                        echo "<li><a href='$sub_href'>$sub_title</a></li>";
                    }
                    echo "</span>";
                } else {
                    echo "<li><a href='$href'>$title</a></li>";
                }
            }
        }
        echo "</ul></div>";

    }

    ?>

</div>

</body>

</html>

