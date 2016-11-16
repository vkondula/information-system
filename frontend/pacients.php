<?php
session_start();
$title = "Pacienti";
include "header.php";
require_once ("../backend/patient.php");
?>
<div class="site">

    <div class="sidepanel" >
        <button>Nová návšteva</button>
        <hr/>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non est mattis, malesuada lorem eget, euismod sem. Vestibulum pharetra elementum mollis. Suspendisse ac molestie justo, quis porta odio. Duis bibendum mauris a turpis mollis rhoncus. Proin in mollis lectus. Ut hendrerit felis at mauris ornare scelerisque. Duis molestie pulvinar nunc ac sollicitudin. Nullam a libero at ligula interdum mattis. Sed pharetra libero in orci cursus, at placerat urna euismod. Donec ultrices nulla sed arcu bibendum, sed ornare nisi vehicula. Fusce consectetur elit suscipit, hendrerit magna et, fermentum erat. Cras tempus iaculis congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu ullamcorper neque. Donec nulla odio, consequat at lacus ultricies, laoreet ultrices arcu. Proin lobortis, est sagittis imperdiet pretium, lectus nisl euismod dolor, et convallis purus justo sed risus.

    </div>
    <div class="content">
        <div>
            <?php
            $patient = get_patient_info('8811050622');  //get patient info via birth code
            //var_dump($patient);

            if (count($patient) == 0) {
                echo "<h1>Pacient nenalezen</h1>";
                //TODO: back button
            }
            echo "<h2>".$patient[0]["name"]." ".$patient[0]["surname"]." </h2>";
            echo "<div>R.č.: ".$patient[0]["rc"]." </div>";
            echo "<div>".$patient[0]["birthdate"]." </div>";
            echo "<div>".$patient[0]["insurance"]." </div>";
            echo "<div>".$patient[0]["street"]." ".$patient[0]["str_number"]." </div>";
            echo "<div>".$patient[0]["city"]." </div>";
            echo "<div>".$patient[0]["postal_code"]." </div>";
            echo "<div>Pacientem od: ".$patient[0]["evidence"]." </div>";
            ?>
            <hr/>
        </div>
        <div>
            <h1>Správa</h1>
            <hr/>
        </div>
        <div>
            <h1>Léky</h1>
            <hr/>
        </div>
        <div>
            <h1>Faktura</h1>
            <hr/>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>