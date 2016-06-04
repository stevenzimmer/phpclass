<?php
    // get the data from the form
    $investment = filter_input(INPUT_POST, 'investment', 
            FILTER_VALIDATE_FLOAT);
    $interest_rate = filter_input(INPUT_POST, 'interest_rate', 
            FILTER_VALIDATE_FLOAT);
    $years = filter_input(INPUT_POST, 'years', 
            FILTER_VALIDATE_INT);
    $monthly = isset($_POST['monthly']);

    // validate investment
    if ($investment === FALSE ) {
        $error_message = 'Investment must be a valid number.'; 
    } else if ( $investment <= 0 ) {
        $error_message = 'Investment must be greater than zero.'; 
    // validate interest rate
    } else if ( $interest_rate === FALSE )  {
        $error_message = 'Interest rate must be a valid number.'; 
    } else if ( $interest_rate <= 0 ) {
        $error_message = 'Interest rate must be greater than zero.'; 
    // validate years
    } else if ( $years === FALSE ) {
        $error_message = 'Years must be a valid whole number.';
    } else if ( $years <= 0 ) {
        $error_message = 'Years must be greater than zero.';
    } else if ( $years > 30 ) {
        $error_message = 'Years must be less than 31.';
    // set error message to empty string if no invalid entries
    } else {
        $error_message = ''; 
    }

    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.php');
        exit();
    }

// calculate the future value
$future_value = $investment;
for ($i = 1; $i <= $years; $i++) {
$future_value = ($future_value + ($future_value * $interest_rate *.01));
}

$future_value_m = $investment;
for ($i = 1; $i <= $years*12; $i++) {
$future_value_m = ($future_value_m * (1 + ($interest_rate*.01)/12)); 
}

    // apply currency and percent formatting
    $investment_f = '$'.number_format($investment, 2);
    $yearly_rate_f = $interest_rate.'%';
    $future_value_f = '$'.number_format($future_value, 2);
    $future_value_monthly = '$'.number_format($future_value_m, 2);

//   function to calculate the future value
function future_value(){
    global $investment;
    global $interest_rate;
    global $years;
    global $future_value_f;
    $future_value = $investment;
    for ($i = 1; $i <= $years; $i++) {
    $future_value = ($future_value + ($future_value * $interest_rate *.01));
    }
    return $future_value_f;
}

//  function to calculate the future monthly value
function future_value_m(){
    global $investment;
    global $interest_rate;
    global $years;
    global $future_value_monthly;
    $future_value_m = $investment;
    for ($i = 1; $i <= $years*12; $i++) {
    $future_value_m = ($future_value_m * (1 + ($interest_rate*.01)/12)); 
    }
    return $future_value_monthly;
}


// function to apply currency formatting to a value
function currency_format(){
    global $investment;
    $investment_f = '$'.number_format($investment, 2);
    return $investment_f;
}

// function to apply percent formatting to a value
function percent_format(){
    global $interest_rate;
    $yearly_rate_f = $interest_rate.'%';
    return $yearly_rate_f;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Future Value Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo currency_format(); ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo percent_format(); ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php if(isset($monthly) && $monthly == "yes") {
              echo future_value_m();
            } else {
                echo future_value();
        } ?></span><br>

        <label>Compound monthly</label>
        <span><?php if(isset($monthly) && $monthly == "yes") {
                echo "Yes";
            } else {
                echo "No";
        } ?></span><br>
    </main>
</body>
</html>