
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body id="page-top">
    <?php
    function isValid($amount) {
        if(is_numeric($amount)){
            $val = floatVal($amount);
            return $val >= 0 && strlen(substr(strrchr($amount, "."), 1)) <= 2;
        }
        return False;
    }

    ?>
    <?php
    $validInput = False;
    $subtotal = "";
    $tip = 0;
    $total = 0;
    $selectRadio = $_POST["radios"];
    $perc = ($selectRadio)*.05;
    $cust = $_POST["custTip"]/100;
    if($perc == .25){
        $perc = $cust;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        if (!empty($_POST["billInput"]) && isValid($_POST["billInput"])){
            $subtotal = $_POST["billInput"];
            $validInput = True;
            $tip = $perc * $subtotal;
            $total = $subtotal + $tip;

        }
        else{
            $subtotal = 0;
        }

    }
    else{
        $selectRadio = 3;
    }
    ?>



    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-horizontal">
        <fieldset>

            <!-- Form Name -->
            <legend>Tip Calculator</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="billInput">Bill subtotal: </label>
                <div class="col-md-4">
                    <input id="billInput" name="billInput" type="text" class="form-control input-md" value="<?php echo $subtotal; ?>" required="">
                    <span class="help-block">without $ symbol</span>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="custTip">Custom Tip Amount: </label>
                <div class="col-md-4">
                    <input id="custTip" name="custTip" type="text" class="form-control input-md" value="<?php echo $perc*100; ?>">
                    <span class="help-block">without % symbol</span>
                </div>
            </div>

            <!-- Multiple Radios (inline) -->
            <div class="form-group">

                <label class="col-md-4 control-label" for="radios">Tip Percentage:</label>

                <?php
                for ($i = 2; $i < 6; $i++) {
                    $checked = '';
                    if($i == $selectRadio){
                        $checked = "checked = 'checked'";
                    }
                    if($i < 5){
                        ?>
                        <label class="radio-inline" for="radios-<?php echo $i; ?>">
                            <input type="radio" name="radios" id="radio-<?php echo $i; ?>" value="<?php echo $i; ?>" <?php echo $checked; ?>><?php echo ($i)*5; ?>%
                        </label>
                        <?php
                    }
                    else{
                        ?>
                        <label class="radio-inline" for="radios-<?php echo $i; ?>">
                            <input type="radio" name="radios" id="radio-<?php echo $i; ?>" value="<?php echo $i; ?>" <?php echo $checked; ?>>
                            Custom

                        </label>
                        <?php
                    }
                    ?>




                    <?php
                }
                ?>
</div



                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button id="singlebutton" name="singlebutton" class="btn btn-primary" >Submit</button>
                    </div>
                </div>




            </fieldset>
        </form>
        <?php
        if($validInput){
            ?>
            <h4>Tip: $<?php echo $tip;?></h4>
            <h4>Total: $<?php echo $total;?></h4>
            <?php
        }
        ?>





    </body>

    </html>
