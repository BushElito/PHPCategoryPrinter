<?php

include_once("iPrinter.php");

/**
 * Description of IterativePrinter
 *
 * @author Admin
 */
class IterativePrinter implements IPrinter {

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
                $main_rows['level'] = -1;
                continue;
            }
            if ($value['parent'] === $value['id']) {
                continue;
            }
            $value['name'] = $value['name'] . $rows[$value['parent']]['name'];
            $rows[$value['parent']]['children'][] = &$value;
        }
        $this->iterative_print($main_rows);
    }

    private function iterative_print($main_rows) {
        $stack = [];
        $stack[] = $main_rows;
        echo '<ul>';
        while (count($stack) > 0) {
            $obj = array_pop($stack);
            if (isset($obj['name'])) {
                echo "<li style=\"padding-left:" . 40 * $obj['level'] . "px;\">" . $obj['name'];
            }
            foreach (array_reverse($obj['children']) as &$value) {
                $value['level'] = $obj['level'] + 1;
                $stack[] = &$value;
            }
            echo "</li>";
        }
        echo '</ul>';
    }

}
