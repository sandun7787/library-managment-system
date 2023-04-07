<?php
session_start();
if(isset($_POST['query'])) {
    if($_POST['query'] == null) {
        include '../connection/config.php';
        $conn = getCon();
        $query= "SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state, reservation.userId, reservation.bookId
            FROM reservation 
            JOIN book ON book.bookId = reservation.bookId 
            WHERE reservation.state IN ('pending', 'accepted')
            ORDER BY 
              CASE reservation.state 
                WHEN 'pending' THEN 1 
                WHEN 'accepted' THEN 2 
              END, 
              reservation.date DESC;";
        $result = $conn->query($query);
        $count = $result->rowCount();

        if ($count > 0) {
            echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
            echo '<table class="table" style="border:solid #dee2e6 1px;">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                     <th scope="col">ID</th>
                     <th scope="col">Book</th>
                     <th scope="col">Book ID</th>
                     <th scope="col">User ID</th>
                     <th scope="col">Date</th>
                     <th scope="col">Request Date</th>
                     <th scope="col">State</th>
                     <th scope="col"></th> 
              </tr>';
            echo '</thead>';
            foreach ($result as $row) {

                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["id"] . '">' . $row["id"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["name"] . '">' . $row["name"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["bookId"] . '">' . $row["bookId"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["userId"] . '">' . $row["userId"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["date"] . '">' . $row["date"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["reqDate"] . '">' . $row["reqDate"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["state"] . '">' . $row["state"] . '</td>';

                if ($row["state"]=="pending"){
                    echo '<td style="vertical-align: middle;">

                        <button class="btn btn-success" style="margin-top: 5px" name="accept" type="submit" value="' . $row["id"] . '"><i class="fa fa-check"></i> Accept </button>
                        <button class="btn btn-danger" style="margin-top: 5px" name="reject" type="submit" value="' . $row["id"] . '"><i class="fa fa-ban"></i> Reject </button>
                        </td>';
                }else if($row["state"]=="accepted"){
                    echo '<td style="vertical-align: middle;">
                        <button class="btn btn-primary" style="margin-top: 5px" name="complete" type="submit" value="' . $row["id"] . '"><i class="fa fa-check"></i> Complete</button>
                        </td>';
                }else{
                    echo '<td style="vertical-align: middle;"></td>';
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
        $query=  "SELECT book.name, reservation.id, reservation.date, reservation.reqDate, reservation.state, reservation.userId, reservation.bookId
            FROM reservation 
            JOIN book ON book.bookId = reservation.bookId 
            WHERE reservation.state IN ('pending', 'accepted') AND reservation.userId = '9563' AND book.name LIKE '{$_POST['query']}%'
            ORDER BY 
              CASE reservation.state 
                WHEN 'pending' THEN 1 
                WHEN 'accepted' THEN 2 
              END, 
              reservation.date DESC;";

        $result = $conn->query($query);
        $count = $result->rowCount();

        if ($count > 0) {
            echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
            echo '<table class="table" style="border:solid #dee2e6 1px;">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                     <th scope="col">ID</th>
                     <th scope="col">Book</th>
                     <th scope="col">Book ID</th>
                     <th scope="col">User ID</th>
                     <th scope="col">Date</th>
                     <th scope="col">Request Date</th>
                     <th scope="col">State</th>
                     <th scope="col"></th> 
              </tr>';
            echo '</thead>';
            foreach ($result as $row) {

                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["id"] . '">' . $row["id"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["name"] . '">' . $row["name"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["bookId"] . '">' . $row["bookId"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["userId"] . '">' . $row["userId"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["date"] . '">' . $row["date"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row["reqDate"] . '">' . $row["reqDate"] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row["state"] . '">' . $row["state"] . '</td>';

                if ($row["state"]=="pending"){
                    echo '<td style="vertical-align: middle;">

                        <button class="btn btn-success" style="margin-top: 5px" name="accept" type="submit" value="' . $row["id"] . '"><i class="fa fa-check"></i> Accept </button>
                        <button class="btn btn-danger" style="margin-top: 5px" name="reject" type="submit" value="' . $row["id"] . '"><i class="fa fa-ban"></i> Reject </button>
                        </td>';
                }else if($row["state"]=="accepted"){
                    echo '<td style="vertical-align: middle;">
                        <button class="btn btn-primary" style="margin-top: 5px" name="complete" type="submit" value="' . $row["id"] . '"><i class="fa fa-check"></i> Complete</button>
                        </td>';
                }else{
                    echo '<td style="vertical-align: middle;"></td>';
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
}

?>
