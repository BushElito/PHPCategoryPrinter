<?php

function create_new_category($name, $category_number) {
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (!$db) {
        die("Failed to connect to MySQL:" . mysqli_error($db));
    }
    mysqli_query($db, "INSERT INTO `category` (`id`, `parent_id`, `name`)
            VALUES (NULL, '" . $category_number . "', '" . $name . "');");
}

function populate_item_list() {
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (!$db) {
        die("Failed to connect to MySQL:" . mysqli_error($db));
    }
    $result = mysqli_query($db, "SELECT * FROM `category`");

    echo '<select class="w3-input w3-border" name="categoryNumber">';
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value=" . $row['id'] . ">";
        echo $row['name'];
        echo "</option>";
    }
    echo '</select>';
}
