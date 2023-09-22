<!DOCTYPE html>
<html>
<head>
    <title>Income Tax Calculator</title>
    <link rel= "stylesheet" href= "style.css">
</head>
<body>
    <div class="left">
       
        <h2>Inter your information:</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="salary">Salary in USD:</label>
            <input type="number" name="salary"  placeholder= "Salary" required value="<?php echo isset($_POST['salary']) ? $_POST['salary'] : ''; ?>"/>
            <label for="allowance">Tax Free Allowance in USD:</label>
            <input type="number" name="allowance"  placeholder= "Tax free allowance" required value="<?php echo isset($_POST['allowance']) ? $_POST['allowance'] : ''; ?>"/>
            <label>Chose one:</label>
            <div class="radio">
                <input type="radio" name="calculation_type" value="yearly" required <?php echo (isset($_POST['calculation_type']) && $_POST['calculation_type'] === 'yearly') ? 'checked' : ''; ?>>yearly
                <input type="radio" name="calculation_type" value="monthly" required <?php echo (isset($_POST['calculation_type']) && $_POST['calculation_type'] === 'monthly') ? 'checked' : ''; ?>>monthly
            </div>
          
            <button type= "submit" name="calculate" value="Calculate">submit</button>
      
        </form>
        
    </div>
    <div class="right">
      <h2>Your incom tax results:</h2>
      <?php
        if (isset($_POST['calculate']) ) {
             $salary = floatval($_POST['salary']);
             $allowance = floatval($_POST['allowance']);
             $calculation_type = $_POST['calculation_type'];


           if($calculation_type === 'monthly'){
                    $salary *= 12 ;
                    $allowance *= 12;
             }

           $tax = 0 ;
             if ($salary < 10000) {
            $tax = 0;
            } elseif ($salary < 25000) {
            $tax = $salary * 0.11;
            } elseif ($salary < 50000) {
            $tax = $salary * 0.30;
            } else {
            $tax = $salary * 0.45;
            }
         
          $social_security_fee = ($salary > 10000) ? $salary * 0.04 : 0;

          $salary_after_tax = $salary - $tax + $allowance;

         
          echo "<table border='1' width = '40%'>";
          echo "<tr><th>Category</th><th>Amount</th></tr>";
          echo "<tr><td>Total Salary</td><td>$salary</td></tr>";
          echo "<tr><td>Tax Amount</td><td>$tax</td></tr>";
          echo "<tr><td>Social Security Fee</td><td>$social_security_fee</td></tr>";
          echo "<tr><td>Salary after Tax</td><td>$salary_after_tax</td></tr>";
          echo "</table>";

          }
      ?>
    </div>
 

</body>
</html>
