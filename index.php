<!DOCTYPE html>
<?php
include_once("include/settings.php");
$safe_post = filter_input_array(INPUT_POST);
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="include/styles.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div>
            <div class="container">
                <form name="newCategory" method="POST">
                    <input type="text" name="categoryName" value="" />
                    <?php
                    populate_item_list();
                    ?>
                    <input type="submit" value="Add new category" name="add" />
                </form>
            </div>
            <?php
            if (isset($safe_post['add'])) {
                create_new_category($safe_post['categoryName'], $safe_post['categoryNumber']);
            }
            ?>
            <div>
                <?php
                $iterative_printer = new IterativePrinter();
                $recursive_printer = new RecursivePrinter();
                ?>
                <h3>
                    Iterative print
                </h3>
                <?php
                $iterative_printer->print_operation();
                ?>
                <h3>
                    Recursive print
                </h3>
                <?php
                $recursive_printer->print_operation();
                ?>
            </div>
        </div>
    </body>
</html>
