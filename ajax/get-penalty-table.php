<?php
session_start();
if(isset($_POST['query'])) {
    if($_POST['query'] == null) {
        include '../connection/config.php';
        $conn = getCon();
        $query = "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` FROM `records` WHERE return_date IS NULL AND penalty IS NULL AND NOW() > due_date ORDER BY due_date ASC ";
        $result = $conn->query($query);
        $count = $result->rowCount();

        if ($count > 0) {
            echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
            echo '<table class="table" style="border:solid #dee2e6 1px;">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                     <th scope="col">Record ID</th>
                     <th scope="col">Member ID</th>
                     <th scope="col">Book ISBN</th>
                     <th scope="col">Borrowed Date</th>
                     <th scope="col">Due Date</th>
                     <th scope="col">Rate</th>
                     <th scope="col"></th>

              </tr>';
            echo '</thead>';
            foreach ($result as $row) {

                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[0] . '">' . $row[0] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[2] . '">' . $row[2] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[3] . '">' . $row[3] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[4] . '">' . $row[4] . '</td>';
                $penalty_rate = 100;
                $days_overdue = (int) round((strtotime('now') - strtotime($row[4])) / (60*60*24));
                $penalty_amount = $days_overdue * $penalty_rate;

                $dataSet=$penalty_amount. ",".$row[0];
                echo '<td style="vertical-align: middle;"> <input type="hidden" name="amount"  value="' . $penalty_amount . '">' . $penalty_amount . '</td>';
                echo '<td style="vertical-align: middle;"><button class="btn btn-primary"  style="margin: auto" name="pay" type="submit" value="' . $dataSet . '"><i class="fa fa fa-money "></i> Pay penalty </button></td>';
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
            }
            echo '</table>';
            echo '</form></div> </div>';
        }
        else {
            echo "<span  style='color:red; margin-left: auto; margin-right: auto; display: table; margin-top: 50px;' class='features CardBgCol' > No available records</span>";
        }
    }
    else {
        include '../connection/config.php';
        $conn = getCon();
        $query = "SELECT `id`, `book_id`, `borrower_id`, `borrow_date`, `due_date`, `return_date`, `penalty` FROM `records` WHERE return_date IS NULL AND penalty IS NULL AND NOW() > due_date AND borrower_id LIKE '{$_POST['query']}%' LIMIT 100";
        $result = $conn->query($query);
        $count = $result->rowCount();

        if ($count > 0) {
            echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
            echo '<table class="table" style="border:solid #dee2e6 1px;">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                     <th scope="col">Record ID</th>
                     <th scope="col">Member ID</th>
                     <th scope="col">Book ISBN</th>
                     <th scope="col">Borrowed Date</th>
                     <th scope="col">Due Date</th>
                     <th scope="col">Rate</th>
                     <th scope="col"></th>

              </tr>';
            echo '</thead>';
            foreach ($result as $row) {

                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[0] . '">' . $row[0] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[2] . '">' . $row[2] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[3] . '">' . $row[3] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[4] . '">' . $row[4] . '</td>';
                $penalty_rate = 100;
                $days_overdue = (int) round((strtotime('now') - strtotime($row[4])) / (60*60*24));
                $penalty_amount = $days_overdue * $penalty_rate;
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $penalty_amount . '">' . $penalty_amount . '</td>';
                echo '<td style="vertical-align: middle;"><button class="btn btn-primary"  style="margin: auto" name="pay" type="submit" value="' . $row[0] . '"><i class="fa fa fa-money "></i> Pay penalty </button></td>';
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
            }
            echo '</table>';
            echo '</form></div> </div>';
        }
        else {
            echo "<span  style='color:red; margin-left: auto; margin-right: auto; display: table; margin-top: 50px;' class='features CardBgCol' > No available records for this member ID</span>";
        }
    }
}

?>


