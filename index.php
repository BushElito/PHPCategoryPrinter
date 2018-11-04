<!DOCTYPE html>
<?php
include_once("include/settings.php");
$safe_post = filter_input_array(INPUT_POST);
?>
<html>
    <head>
        <link rel="stylesheet" href="include/w3.css">
        <link rel="stylesheet" href="include/styles.css">
        <meta charset="UTF-8">
        <title>Category printer</title>
    </head>
    <body>
        <div class="w3-container w3-pale-blue">
            <h3>
                Category printer
            </h3>
        </div>
        <div class="w3-panel">
            <div>
                <form class="w3-container" name="newCategory" method="POST">
                    <p>
                    <label>New Category name</label>
                    <input class="w3-input w3-border" type="text" name="categoryName" value="" />
                    <p>
                    <label>Existing categories</label>
                    <?php
                    populate_item_list();
                    ?>
                    <p>
                    <input class="w3-button w3-border" type="submit" value="Add new category" name="add" />
                </form>
            </div>
            <?php
            if (isset($safe_post['add'])) {
                create_new_category($safe_post['categoryName'], $safe_post['categoryNumber']);
            }
            ?>
            <h3>
                Iterative print
            </h3>
            <?php
            $iterative_printer = new IterativePrinter();
            $iterative_printer->print_operation();
            ?>
            <h3>
                Recursive print
            </h3>
            <?php
            $recursive_printer = new RecursivePrinter();
            $recursive_printer->print_operation();
            ?>
        </div>
    </body>
</html>
