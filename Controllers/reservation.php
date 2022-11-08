<?php
require 'models/userModel.php';
require 'models/user.php';

class reservation 
{
    public static function reserved_dates(){
        $objum=new userModel();
        if(isset($_POST['room'])){

            $room = $_POST['room'];

            $objum->open_db();
            $query=$objum->condb->prepare("SELECT * FROM reservation WHERE roomID = '".$room."' AND status = 1 OR status = 2"); 
            $query->execute();
            $res=$query->get_result();

            $dStart[] = "";
            $dEnd[] = "";
            $index = 0;

            while($row = mysqli_fetch_array($res))  
            {
                $dStart[$index] = $row['checkin'];
                $dEnd[$index] = $row['checkout'];
                $index++;
            }

            $date[] = "";
            $i = 0;

            for($ii = 0; $ii < sizeof($dStart); $ii++){

                $start = new DateTime($dStart[$ii]);
                $end = (new DateTime($dEnd[$ii]))->modify('+0 day');
                $interval = new DateInterval('P1D');
                $period = new DatePeriod($start, $interval, $end);
        
                foreach ($period as $dt) {
                    $date[$i] = $dt->format("m/d/Y");
                    $i++;
                }
            }
            echo json_encode(array("date" => $date));
        }                        
    }
}
?>