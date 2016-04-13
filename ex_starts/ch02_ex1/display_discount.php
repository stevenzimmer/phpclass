<?php 

    $product_description = filter_input(INPUT_POST, "product_description");

    $list_price = filter_input(INPUT_POST, 'list_price');

    $discount_percent = filter_input(INPUT_POST, 'discount_percent');

    $discount_amount = $list_price * $discount_percent * .01;

    $discount_price = $list_price - $discount_amount;

    $list_price_f = "$".number_format($list_price, 2);

    $discount_percent_f = $discount_percent."%";

    $discount_amount_f = "$".number_format($discount_amount, 2);

    $discount_price_f = "$".number_format($discount_price, 2);

    $number = .08;

    $sale_tax = $number * 100;

    $sales_tax_rate = number_format($sale_tax)."%";

    $sales_tax_amount = $number * $list_price;

    $sales_tax_amount_f = "$".number_format($sales_tax_amount, 2);

    $amount_total = $sales_tax_amount + $discount_price;

    $amount_total_f = "$".number_format($amount_total, 2);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Discount Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Product Discount Calculator</h1>

        <label>Product Description:</label>
        <span><?php echo htmlspecialchars($product_description); ?></span><br>

        <label>List Price:</label>
        <span><?php echo htmlspecialchars($list_price_f); ?></span><br>

        <label>Standard Discount:</label>
        <span><?php echo htmlspecialchars($discount_percent_f); ?></span><br>

        <label>Discount Amount:</label>
        <span><?php echo $discount_amount_f; ?></span><br>

        <label>Discount Price:</label>
        <span><?php echo $discount_price_f; ?></span><br>

        <label>Sales tax rate:</label>
        <span><?php echo $sales_tax_rate; ?></span><br>

        <label>Sales tax amount:</label>
        <span><?php echo $sales_tax_amount_f; ?></span><br>

        <label>Amount total:</label>
        <span><?php echo $amount_total_f; ?></span><br>

    </main>
</body>
</html>