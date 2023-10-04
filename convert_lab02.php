<?php
$result=0;


    if(isset($_GET["in"])){

        #echo "Your input is:". $_GET["in"]."<br>";
        #echo "Your choose is:". $_GET["unit"]."<br>";

        if($_GET["unit"]==1){
            $result= $_GET["in"]*2.54;
        }

        elseif($_GET["unit"]==2){
            $result = $_GET["in"]*1.6;
        }

        elseif($_GET["unit"]==3){
            $result = $_GET["in"]*745.7;
        }

        elseif($_GET["unit"]==4){
            $result = $_GET["in"]*453.6;
        }

        elseif($_GET["unit"]==5)
        {
            $result = $_GET["in"]*119.2;
        }

    }


    $unitType = array(
        1=> "Inch-CM",
        2=> "Mile-KM",
        3=> "Horse power- Watt",
        4=> "Pound-Grams",
        5=> "Barrel-Liter"

    );
  
?>

<html>
    <style>
        input[type=text],select {
            width: 30%;
            padding: 12px 12px;
            margin: 8px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            margin-bottom: 5px;
            }

        
        div {
            border-radius: 5px;
            padding: 30px;
            margin: 60px;
            }

        #myCompiler {
            background-color: #ffffff;
        }

        table {
            background: #add8e6;

        }

        td,tr {
            border: 1px solid black;
        }


    </style>

<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

    <body style="background-color:mediumturquoise">
        <div id= "myCompiler">
        <p>Утга хөрвүүлэх</p><br>
        <hr>

            <form action=convert_lab02.php method="get" >
            
                    <label>Хувиргах утга:</label>
                        <input type="text" name="in">
                

                    <label>Төрөл:</label>
                        <select name="unit">
                        <option value="1">Inch-CM</option>
                        <option value="2">Mile-KM</option>
                        <option value="3">Horse power- Watt</option>
                        <option value="4">Pound-Grams</option>
                        <option value="5">Barrel-Liter</option>
                    </select><br>

                    <label>Нэгжийн утга:</label>
                        <input type= "text" value="<?php echo $result;?>" ><br><hr>
                        <input type= "submit" value="Хувиргах" class="btn btn-primary">
                        <input type= "reset" value="Цуцлах" class="btn btn-danger">
    
            </form>
        </div>


    <div class="col-sm-3">
    <table class="table" >
        <thead>
            <tr><th style="border: 1px solid black" colspan="4" ><center>Таны оруулсан сүүлийн утга (Түүх) </center></th></tr>
            <tr >
                <th style="border: 1px solid black">№</th>
                <th style="border: 1px solid black">Нэгж</th>
                <th style="border: 1px solid black">Оролт</th>
                <th style="border: 1px solid black">Гаралт</th>
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
             $conversion->description = $_GET["unit"];

             array_push($_SESSION["history"], $conversion);



             if (count($_SESSION["history"]) > 5) {
                 array_shift($_SESSION["history"]);
         }
            $counter = 1;
            $reverse_history = array_reverse($_SESSION["history"]);

            foreach ($reverse_history as $conversion) {
                echo "<tr>";
                echo "<td>{$counter}</td>";
                echo "<td>{$unitType[$conversion->description]}</td>";
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

</body>

</html>



    
