<?php
session_start();
if(isset($_POST['query'])) {
        include '../connection/config.php';
        $conn = getCon();
        $query="SELECT `isbn`, `name`,`imgUrl`, `bookId` FROM `book` WHERE `name`LIKE '{$_POST['query']}%' LIMIT 100";
        $result = $conn->query($query);
        $count = $result->rowCount();
        $bookArray=array();

        if($count>0){
            foreach ($result as $row) {
                array_push($bookArray,$row[3]);
            }
            $i = 0;
            while($i < count($bookArray))
            {
                $query = "SELECT `id` FROM `records` WHERE return_date IS NULL AND `book_id`=$bookArray[$i] ";
                $result = $conn->query($query);
                $count = $result->rowCount();
                if($count>0){
                    unset($bookArray[$i]);
                }
                $i++;
            }

//            $z = 0;
//            while($z < count($bookArray))
//            {
//                $query = 'SELECT * FROM `reservation` WHERE  `bookId`="1" ';
//                $result = $conn->query($query);
//                $count = $result->rowCount();
//                if($count>0){
//                    unset($bookArray[$z]);
//                }
//                $z++;
//            }

            if (empty($bookArray)) {
                echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
                echo '<table class="table" style="border:solid #dee2e6 1px;">';
                echo '<thead class="thead-dark">';

                echo '</thead>';
                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"><img src="'.$row[2].'" width="80" height="90"></td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
                echo '<td style="vertical-align: middle;"> <div  style="color:red; font-weight: bold">No available books</div></td>';
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
                echo '</table>';
                echo '</form></div> </div>';
            } else {
                echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
                echo '<table class="table" style="border:solid #dee2e6 1px;">';
                echo '<thead class="thead-dark">';

                echo '</thead>';
                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"><img src="'.$row[2].'" width="80" height="90"></td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
                echo '<td style="vertical-align: middle;"> <div  style="color:green; font-weight: bold">Available</div></td>';
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
                echo '</table>';
                echo '</form></div> </div>';

                echo $row[1];
                $bookArray[0];
                $_SESSION['ResBookId']=$bookArray[0];

                print_r($bookArray);
            }
        }

}

?>


