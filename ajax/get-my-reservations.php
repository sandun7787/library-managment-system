<?php
session_start();
if(isset($_POST['query'])) {
    if($_POST['query'] == null) {
        include '../connection/config.php';
        $conn = getCon();
        $query=  "SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state 
        FROM reservation JOIN book ON book.bookId = reservation.bookId 
        WHERE reservation.userId = '9563' ORDER BY date DESC";
        $result = $conn->query($query);
        $count = $result->rowCount();

        if ($count > 0) {
            echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
            echo '<table class="table" style="border:solid #dee2e6 1px;">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                     <th scope="col">Reservation ID</th>
                     <th scope="col">Book</th>
                     <th scope="col">Date</th>
                     <th scope="col">Requesting Date</th>
                     <th scope="col">State</th>
                     <th scope="col"></th>
                     

              </tr>';
            echo '</thead>';
            foreach ($result as $row) {

                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["id"] . '">' . $row["id"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["name"] . '">' . $row["name"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["date"] . '">' . $row["date"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["reqDate"] . '">' . $row["reqDate"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["state"] . '">' . $row["state"] . '</td>';

                if ($row["state"]=="pending"){
                    echo '<td style="vertical-align: middle;"><button class="btn btn-primary" style="margin: auto" name="pay" type="submit" value="' . $row[0] . '"><i class="fa fa fa-trash"></i> </button></td>';
                }
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
            }
            echo '</table>';
            echo '</form></div> </div>';
        }
        else {
            echo "<span  style='color:red; margin-left: auto; margin-right: auto; display: table; margin-top: 50px;' class='features CardBgCol' >  No available reservation records</span>";
        }
    }
    else {
        include '../connection/config.php';
        $conn = getCon();
        $query=  "SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state 
        FROM reservation JOIN book ON book.bookId = reservation.bookId 
        WHERE reservation.userId = '9563' AND book.name LIKE '{$_POST['query']}%' LIMIT 100";
        $result = $conn->query($query);
        $count = $result->rowCount();

        if ($count > 0) {
            echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
            echo '<table class="table" style="border:solid #dee2e6 1px;">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                     <th scope="col">Reservation ID</th>
                     <th scope="col">Book</th>
                     <th scope="col">Date</th>
                     <th scope="col">Requesting Date</th>
                     <th scope="col">State</th>
                     <th scope="col"></th>
                     

              </tr>';
            echo '</thead>';
            foreach ($result as $row) {

                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["id"] . '">' . $row["id"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["name"] . '">' . $row["name"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["date"] . '">' . $row["date"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["reqDate"] . '">' . $row["reqDate"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["state"] . '">' . $row["state"] . '</td>';

                if ($row["state"]=="pending"){
                    echo '<td style="vertical-align: middle;"><button class="btn btn-primary" style="margin: auto" name="pay" type="submit" value="' . $row[0] . '"><i class="fa fa fa-trash"></i> </button></td>';
                }
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
            }
            echo '</table>';
            echo '</form></div> </div>';
        }
        else {
            echo "<span  style='color:red; margin-left: auto; margin-right: auto; display: table; margin-top: 50px;' class='features CardBgCol' > No available reservation records</span>";
        }
    }
}

?>


