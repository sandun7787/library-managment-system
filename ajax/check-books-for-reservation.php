<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();
if(isset($_POST['query'])) {
    include '../connection/config.php';
    include '../repository/BookService.php';
    include '../repository/ReservationService.php';
    include '../repository/RecordService.php';
    $bookService = new BookService();
    $recordService = new RecordService();
    $resService = new ReservationService();
    $conn = getCon();
    $result = $bookService->getFilteredBooks();
        $count = $result->rowCount();
        $bookArray=array();

        if($count>0){
            foreach ($result as $row) {
                array_push($bookArray,$row[11]);
            }
            try{
                foreach ($bookArray as $key => $bookId) {
                    $result = $recordService->getRecordsToArray($bookId);
                    $count = $result->rowCount();
                    if ($count > 0) {
                        unset($bookArray[$key]);
                    }
                }
                try{
                    foreach ($bookArray as $key => $bookId) {
                        $result = $resService->getReservationsToArray($bookId);
                        $count = $result->rowCount();
                        if ($count > 0) {
                            unset($bookArray[$key]);
                        }
                    }
                }
                catch (Exception $ex) {
                    echo 'Message: ' .$ex->getMessage();
                }
            }catch (Exception $ex) {
                echo 'Message: ' .$ex->getMessage();
            }

            if (empty($bookArray)) {
                echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
                echo '<table class="table" style="border:solid #dee2e6 1px;">';
                echo '<thead class="thead-dark">';

                echo '</thead>';
                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"><img src="'.$row[0].'" width="80" height="90"></td>';
                echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
                echo '<td style="vertical-align: middle;"> <div  style="color:red; font-weight: bold">No available books</div></td>';
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
                echo '</table>';
                echo '</form></div> </div>';
                echo'<script>
                      $(document).ready(function() {
                        // Disable the button
                        $("#save").prop("disabled", true);
                      });
                    </script>';
            } else {
                $bookArray = array_values($bookArray);
                $_SESSION['ResBookId'] = $bookArray[0];
                echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
                echo '<table class="table" style="border:solid #dee2e6 1px;">';
                echo '<thead class="thead-dark">';

                echo '</thead>';
                echo '<tbody>';
                echo '<tr class="rw">';
                echo '<td style="vertical-align: middle;"><img src="'.$row[0].'" width="80" height="90"></td>';
                echo '<td style="vertical-align: middle;"> <input id="bookName" type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
                echo '<td style="vertical-align: middle;"> <div  style="color:green; font-weight: bold">Available</div></td>';
                echo'<td style="vertical-align: middle;"><input type="checkbox" id="select">
                        <label for="checkBox" id="msg">Select</label></td>';
                echo '</tr>';
                echo '</tr>';
                echo ' </tbody>';
                echo '</table>';
                echo '</form></div> </div>';
                echo'<script>
                      $(document).ready(function() {            
                         $("#save").prop("disabled", true);
                         var inputValue = $("#bookName").val();
                
                          $("#select").change(function() {
                            if ($(this).prop("checked")) {
                                $("#name").val(inputValue).prop("disabled", true)
                                $("#msg").html("Selected");
                                $("#save").prop("disabled", false);  
                            } else {
                                $("#name").val("").prop("disabled", false);
                                $("#msg").html("Select");

                            }
                            });
                      });
                      
                    </script>';
                echo 'Available book ID(s) - '.implode(", ", $bookArray);
                $bookArray = null;
            }
        }
}

?>


