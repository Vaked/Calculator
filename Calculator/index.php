<?php

require_once("calculation.php");

?>


<!DOCTYPE html>
<html>

<head>
    <title>Calculator</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <form method="post">
        <div id="background">
            <!-- Main background -->

            <div id="main">

                <input type="text" name="expression" id="result">
                <div id="first-rows">
                    <button type="button" value="c" id="mod" class="btn-style operator opera-bg fall-back">%</button>
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
                    <button type="button" value="." class="btn btn-style num-bg period fall-back">.</button>
                    <button type="submit" value="=" id="eqn-bg" class="eqn align">=</button>
                </div>

            </div>

        </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="/Calculator/scripts/scripts.js"></script>

</body>

</html>