<?php

require_once("calculation.php");

if (isset($_POST['expression'])) {

    $expression = $_POST['expression'];

    $result = 0; 

    if (!Calculator::checkParenthesis($expression)) {
        echo ('Syntax error, brackets are incorrect');
        exit;
    } else {
        $result = Calculator::evaluatePostFix($expression);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Calculator</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form action="" method="post">
        <div id="background">
            <!-- Main background -->

            <div id="main">

                <div id="main">

                    <input type="text" value="<?php echo (!empty($result)) ? $result : "0"; ?>" name="expression" id="result">
                    <div id="first-rows">
                        <button type="button" value="%" class="btn btn-style operator opera-bg fall-back">%</button>
                        <button type="button" value="(" class="btn btn-style operator opera-bg fall-back">(</button>
                        <button type="button" value=")" class="btn btn-style operator opera-bg fall-back">)</button>
                        <button type="button" value="+" class="btn btn-style opera-bg value align operator">+</button>
                    </div>

                    <div class="rows">
                        <button type="button" value="7" class="btn btn-style num-bg num first-child">7</button>
                        <button type="button" value="8" class="btn btn-style num-bg num">8</button>
                        <button type="button" value="9" class="btn btn-style num-bg num">9</button>
                        <button type="button" value="-" class="btn btn-style opera-bg operator">-</button>
                    </div>

                    <div class="rows">
                        <button type="button" value="4" class="btn btn-style num-bg num first-child">4</button>
                        <button type="button" value="5" class="btn btn-style num-bg num">5</button>
                        <button type="button" value="6" class="btn btn-style num-bg num">6</button>
                        <button type="button" value="*" class="btn btn-style opera-bg operator">x</button>
                    </div>

                    <div class="rows">
                        <button type="button" value="1" class="btn btn-style num-bg num first-child">1</button>
                        <button type="button" value="2" class="btn btn-style num-bg num">2</button>
                        <button type="button" value="3" class="btn btn-style num-bg num">3</button>
                        <button type="button" value="/" class="btn btn-style opera-bg operator">/</button>
                    </div>

                    <div class="rows">
                        <button type="button" value="0" class="btn num-bg zero" id="delete">0</button>
                        <button type="submit" value="=" id="eqn-bg" class="eqn align">=</button>
                    </div>

                </div>

            </div>
    </form>
    <script charset="UTF-8" type="text/javascript" src="js/jquery-3.4.1.min.js"></script>

    <script charset="UTF-8" type="text/javascript" src="js/scripts.js"></script>

</body>

</html>