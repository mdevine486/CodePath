<html>
<body>
<?php
   $x = array("10", "15", "20");
   $Total = '';
   $tipAm = '';
   $tipAmeh = '';
   $Totaleh = '';

   if(isset($_POST['submit'])){
      $amount = $_POST['Amount'];
      $tip    = $_POST['tip'];
      $custom = $_POST['custom'];
      $split  = $_POST['split'];

      if(empty($_POST["custom"])){
        $tipAm = ($tip/100)*$amount;
      }
      else{
        $tipAm = ($custom/100)*$amount;
      }
      $tipAmeh = $tipAm/$split;
      $Total = $amount + $tipAm;
      $Totaleh = $Total/$split;
   }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nameErr = '';
        $tipErr = '';
        $cusErr = '';

        if (empty($_POST["Amount"])) {
          $nameErr = "Amount is required";
        } else {
          if (!is_numeric($amount)) {
                $nameErr = "Enter Numeric value";
          }
          elseif ((int)$amount < 0){
                $nameErr = "Enter positive value";
          }
        }
        if($tip != "0"){
                $custom = '';
                if (empty($_POST["tip"])) {
                        $tipErr = "Tip is required";
                } else {
                        if (!is_numeric($tip)) {
                                $tipErr = "Enter Numeric value";
                        }
                        elseif ((int)$tip < 0){
                                $tipErr = "Enter positive value";
                        }
                }
        }
        else{
                if (empty($_POST["custom"])) {
                        $cusErr = "Tip is required";
                } else {
                        if (!is_numeric($custom)) {
                                $cusErr = "Enter Numeric value";
                        }
                        elseif ((int)$custom < 0){
                                $cusErr = "Enter positive value";
                        }
                }

        }

   }
?>

<h1>Tip Calculator</h1>
<form action="#" method="post">

 Amount: $ <input type="text" name="Amount" value='<?php echo $amount;?>'>
 <span class="error">* <?php echo $nameErr;?></span>
 <br><br>

 Tip:
 <?php
 for ($i = 0; $i <= 2; $i++) {
 ?>
 <input type="radio" name="tip" <?php if(isset($tip) && $tip == $x[$i]) echo "checked";?> value= <?php echo $x[$i]?> onclick = "disableTextbox();" > <?php echo $x[$i]?>%
 <?php
 }
 ?>

 <input type="radio" name="tip" <?php if(isset($tip) && $tip == "0") echo "checked";?> value = "0" onclick="enableTextbox();"> custom
 <span class="error">* <?php echo $tipErr;?></span>

 <input type="text" name="custom" value='<?php echo $custom;?>' id="name1" disabled>
 <span class="error">* <?php echo $cusErr;?></span>
<br><br>

 Split: <input type="number" name="split" value='<?php echo $split;?>' min = "1" id="abc"> persons
<br><br>

 <input type="submit" name="submit">

 <script type="text/javascript">
 function enableTextbox() {
    document.getElementById("name1").disabled = false;
 }
 function disableTextbox() {
    document.getElementById("name1").value = '';
    document.getElementById("name1").disabled = true;
 }
 </script>

<?php
 if(isset($_POST['submit'])){
     if($nameErr == '' && $tipErr == '' && $cusErr == '' && $spErr == ''){
 ?>
        <p>Tip - $<?php echo $tipAm ?></p>
        <p>Total - $<?php echo $Total?></p>

        <?php
        if(!empty($_POST["split"]) && $split != "1" ){
        ?>
                <p>Tip each - $<?php echo $tipAmeh ?></p>
                <p>Total each - $<?php echo $Totaleh ?></p>
        <?php
        }
        ?>


        <?php
        if($tip == "0") {
        ?>
                <script type="text/javascript">
                        document.getElementById("name1").disabled = false;
                </script>
        <?php
        } else {
        ?>
                <script type="text/javascript">
                        document.getElementById("name1").disabled = true;
                </script>

        <?php
        }

     }
     if($tip == "0"){
        ?>

        <script type="text/javascript">
                document.getElementById("name1").disabled = false;
        </script>

<?php
     }
 }
 ?>

</form>

</body>
</html>

