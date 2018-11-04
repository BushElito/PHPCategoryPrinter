<?php

include_once("iPrinter.php");

/**
 * Description of RecursivePrinter
 *
 * @author Admin
 */
class RecursivePrinter implements IPrinter {

    public function print_operation() {
        $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        if (!$db) {
            die("Failed to connect to MySQL:" . mysqli_error($db));
        }
        $result = mysqli_query($db, "SELECT * FROM `category`");

        $rows = [];
        $main_rows = ['children' => []];

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[$row['id']] = ['id' => $row['id'], 'parent' => $row['parent_id'], 
                'name' => '-' . $row['name'], 'level' => 0, 'children' => []];
        }
        foreach ($rows as &$value) {
            if (!isset($value['parent'])) {
                $main_rows['children'][] = &$value;
                continue;
            }
            if ($value['parent'] === $value['id']) {
                continue;
            }
            $value['name'] = $value['name'] . $rows[$value['parent']]['name'];
            $value['level'] = $rows[$value['parent']]['level'] + 1;
            $rows[$value['parent']]['children'][] = &$value;
            
        }
        echo '<ul>';
        $this->recursive_print($main_rows);
        echo '</ul>';
    }

    private function recursive_print($obj) {
        if (isset($obj['name'])) {
            echo "<li style=\"padding-left:" . 40 * $obj['level'] . "px;\">" . $obj['name'];
        }
        foreach ($obj['children'] as $value) {
            $this->recursive_print($value);
        }
        echo "</li>";
    }

}
