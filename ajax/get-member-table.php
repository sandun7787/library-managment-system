<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
session_start();
if (isset($_POST['query'])) {
    include '../connection/config.php';
    include '../repository/MemberService.php';
    $memberService = new MemberService();

    if ($_POST['query'] == null) {
        $conn = getCon();
        $result = $memberService->getAllMember();
        $count = $result->rowCount();
        getMemberTable($count,$result);
    }
    else {
        $conn = getCon();
        $result = $memberService->getFilteredMembers();
        $count = $result->rowCount();
        getMemberTable($count,$result);
    }
}

function getMemberTable($count,$result){
    if ($count > 0) {
        echo '
            <div class="row justify-content-md-center">
                <div class="col-md-12"><form method="post">';
        echo '<table class="table" style="border:solid #dee2e6 1px;">';
        echo '<thead class="thead-dark">';
        echo '<tr>
                      <th scope="col">Cover</th>
                      <th scope="col">Id</th>
                     <th scope="col">Name</th>
                     <th scope="col">Email</th>
                     <th scope="col">Mobile Number</th>
                     <th scope="col">State</th>
                     <th scope="col"></th>
                     
                    

              </tr>';
        echo '</thead>';
        foreach ($result as $row) {

            echo '<tbody>';
            echo '<tr class="rw">';
            echo '<td style="vertical-align: middle;"><img style="border-radius:50%; width:50px; height: 50px% " src="' . $row[6] . '"></td>';
            echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[0] . '">' . $row[0] . '</td>';
            echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[1] . '">' . $row[1] . '</td>';
            echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[2] . '">' . $row[2] . '</td>';
            echo '<td style="vertical-align: middle;"> <input type="hidden" value="' . $row[3] . '">' . $row[3] . '</td>';
            echo '<td style="vertical-align: middle;"> <input type="hidden"  value="' . $row[4] . '">' . $row[4] . '</td>';
            if ($row[4]=="active"){
                $btnClass="btn-danger";
                $btnIcon="fa-toggle-off";
                $value="Deactivate";
                $setState=1;
            }else{
                $btnClass="btn-success";
                $btnIcon="fa-toggle-on";
                $value="Activate";
                $setState=2;
            }
            $dataSet=$row[0].",".$setState;
            echo '<td style="vertical-align: middle;"><button class="btn '.$btnClass.'" style="width: -webkit-fill-available;" name="changeState" type="submit"  value="' . $dataSet . '"><i class="fa '.$btnIcon.' "></i> '.$value.'  </button></td>';

            echo '</tr>';
            echo '</tr>';
            echo ' </tbody>';
        }
        echo '</table>';
        echo '</form></div> </div>';
    } else {
        echo "<span  style='color:red; margin-left: auto; margin-right: auto; display: table; margin-top: 50px;' class='features CardBgCol' > No user available for this NIC number</span>";
    }
}
?>

