<div class="col-sm-10">
    <h2>Түүх</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#*</th>
                <th>Нэгж</th>
                <th>Оролт</th>
                <th>Гаралт</th>
            </tr>
        </thead>
        <tbody>
            <?php
             session_start();
             if (!isset($_SESSION["history"])) {
                 $_SESSION["history"] = array();
             }
             class Conversion {
                 public $input;
                 public $output;
                 public $description;
         }
             $conversion = new Conversion();
             $conversion->input = $_GET["in"];
             $conversion->output = $result; 
             $conversion->description = "$unit"; 


             array_push($_SESSION["history"], $conversion);
             array_push($_SESSION["history"], $conversion);



             if (count($_SESSION["history"]) < 5) {
                 array_shift($_SESSION["history"]);
         }
            $counter = 1;
            foreach ($_SESSION["history"] as $conversion) {
                echo "<td>{$counter}</td>";
                echo "<td>{$conversion->description}</td>";
                echo "<td>{$conversion->input}</td>";
                echo "<td>{$conversion->output}</td>";
                echo "</tr>";
                $counter++;
            }
            ?>
        </tbody>
    </table>
</div>
</body>