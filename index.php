<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/reset.css" type="text/css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="number" name="num01" placeholder="Number-one">
        <select name="operators">
            <option value="addition">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>

        <input type="number" name="num02" placeholder="Number-two">

        <button>Calculate</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num01 = filter_input (INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);

        $num02 = filter_input (INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);

        $operators = htmlspecialchars($_POST["operators"]);

        //Error handlers
        $errors = false;

        if (empty($num01) || empty($num02) || empty($operators)) {
            echo "<p class='calc-error'>Fill in All Fields</p>";
            $errors = true;
        }

        if (!is_numeric($num01) || !is_numeric($num02)) {
            echo "<p class='calc-error'>Fill in numbers only</p>";
            $errors = true;
        }

        //claculate the numbers if no error
        if(!$errors) {
            $value = 0;
            switch ($operators) {
                case "addition";
                    $value = $num01 + $num02;
                    break;
                case "subtract";
                    $value = $num01 - $num02;
                    break;
                case "multiply";
                    $value = $num01 * $num02;
                    break;
                case "divide";
                    $value = $num01 / $num02;
                    break;
                default:
                echo "<p class='calc-error'>Some thing went wrong</p>";
            }
            echo "<p class= 'calc-result'>Result = " . $value . "</p>";
        }
    }
    ?>
</body>
</html>