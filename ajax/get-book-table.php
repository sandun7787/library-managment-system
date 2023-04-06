<?php
session_start();
if(isset($_POST['query'])) {
    if($_POST['query'] == null) {
        include '../connection/config.php';
        $conn = getCon();
        $query = "SELECT `imgUrl`, `name`, `isbn`, `author`, `cat`,`edition`, `price`, `year`, `pub`,  `rack`, `shell`,`bookid` FROM `book`";
        $result = $conn->query($query);
        $count = $result->rowCount();

        if ($count > 0) {
            echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
            echo '<table class="table" style="border:solid #dee2e6 1px;">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                      <th scope="col">Cover</th>
                      <th scope="col">Book ID</th>
                     <th scope="col">Name</th>
                     <th scope="col">ISBN</th>
                     <th scope="col">Author</th>
                     <th scope="col">Category </th>
                     <th scope="col"></th>

              </tr>';
            echo '</thead>';
            foreach ($result as $row) {

                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"><img src="'.$row[0].'" width="80" height="90"></td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[11] . '">' . $row[11] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[2] . '">' . $row[2] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[3] . '">' . $row[3] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[4] . '">' . $row[4] . '</td>';
                echo '<td style="vertical-align: middle;"><button class="btn btn-primary"  style="margin: auto" name="viewBook" type="submit"  value="' . $row[11] . '"><i class="fa fa-info-circle "></i>  </button></td>';
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
            }
            echo '</table>';
            echo '</form></div> </div>';
        }
        else {
            echo "<span  style='color:red; margin-left: auto; margin-right: auto; display: table; margin-top: 50px;' class='features CardBgCol' > No user available for this NIC number</span>";
        }


    }
    else {
        include '../connection/config.php';
        $conn = getCon();
        $query = "SELECT `imgUrl`, `name`, `isbn`, `author`, `cat`,`edition`, `price`, `year`, `pub`,  `rack`, `shell`,`bookid` FROM `book` WHERE name LIKE '{$_POST['query']}%' LIMIT 100";
        $result = $conn->query($query);
        $count = $result->rowCount();

        if ($count > 0) {
            echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
            echo '<table class="table" style="border:solid #dee2e6 1px;">';
            echo '<thead class="thead-dark">';
            echo '<tr>
                      <th scope="col">Cover</th>
                      <th scope="col">Book ID</th>
                     <th scope="col">Name</th>
                     <th scope="col">ISBN</th>
                     <th scope="col">Author</th>
                     <th scope="col">Category </th>
                     <th scope="col"></th>

              </tr>';
            echo '</thead>';
            foreach ($result as $row) {

                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"><img src="'.$row[0].'" width="80" height="90"></td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[11] . '">' . $row[11] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[2] . '">' . $row[2] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[3] . '">' . $row[3] . '</td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[4] . '">' . $row[4] . '</td>';
                echo '<td style="vertical-align: middle;"><button class="btn btn-primary"  style="margin: auto" name="viewBook" type="submit"  value="' . $row[11] . '"><i class="fa fa-info-circle "></i>  </button></td>';
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
            }
            echo '</table>';
            echo '</form></div> </div>';
        }
        else {
            echo "<span  style='color:red; margin-left: auto; margin-right: auto; display: table; margin-top: 50px;' class='features CardBgCol' > No available books for this name</span>";
        }
    }
}

?>


