<?php
session_start();
$title = "Pacienti";
$id = $_GET["id"];
require_once ("../backend/patient.php");
require_once ("visit.php");
if(empty($id)) header("Location: pacients.php");
$patients = get_patient_info($id);
if (count($patients) == 0) header("Location: pacients.php");
$patient = $patients[0];
include "header.php";
?>
    <div class="site">

        <div class="sidepanel" >
            <button>Nová návšteva</button>
            <hr/>
            <?php
            $visits = get_all_visits($id);
            foreach ($visits as $v){
                // TODO: naformatovat
                echo "<div>";
                echo "<a href='pacient.php?id=".$id."&v=".$v["id"]."' >";
                echo $v["datetime"];
                echo "</a>";
                echo "</div>";
                echo "<hr/>";
            }
            ?>
        </div>
        <div class="rightcontent">
            <div>
                <?php
                // TODO: naformatovat
                echo "<h2>".$patient["name"]." ".$patient["surname"]." </h2>";
                echo "<div>R.č.: ".$patient["rc"]." </div>";
                echo "<div>".$patient["birthdate"]." </div>";
                echo "<div>".$patient["insurance"]." </div>";
                echo "<div>".$patient["street"]." ".$patient["str_number"]." </div>";
                echo "<div>".$patient["city"]." </div>";
                echo "<div>".$patient["postal_code"]." </div>";
                echo "<div>Pacientem od: ".$patient["evidence"]." </div>";
                ?>
            </div>
        </div>
            <?php
                $visit = get_last_visit($patient["rc"]);
                if(!empty($_GET["v"])) $visit = $_GET["v"];
                if(!empty($visit)){
                    print_visit_info($visit, $patient["rc"]);
                }

            ?>
    </div>
<?php
include "footer.php";
?>