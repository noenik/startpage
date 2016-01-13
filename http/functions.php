<?php

include_once 'dblink.php';

if(isset($_GET["f"])) {
    $function = $_GET["f"];
    if(function_exists($function)) {
        $function();
    } else {
        die("No such function");
    }
} else {
    die ("No function defined");
}

function addLink() {
    global $db_link;
    $title = $_POST["title"];
    $link = $_POST["link"];
    $category = $_POST["category"];

    $sql = sprintf("SET @pri = (SELECT priority FROM List_item WHERE category = '%s' ORDER BY priority DESC LIMIT 1) + 1; "
        . "INSERT INTO List_item(title, link, category, priority) " .
        "VALUES ('%s', '%s', '%s', @pri);", $category, $title, $link, $category);

    if(mysqli_multi_query($db_link, $sql)) {
        header("Location: edit.php");
    } else {
        echo "Error in query '$sql': " . mysqli_error($db_link);
    }

}

function delLink() {
    global $db_link;
    $title = $_POST["title"];

    $sql = sprintf("DELETE FROM list_item WHERE title = '%s'", $title);
    mysqli_query($db_link, $sql);
    echo mysqli_error($db_link);
}