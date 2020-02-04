<?php

require_once("index.php");
require_once("Stack.php");

$expression = $_POST['expression'];
var_dump($expression);

if(!checkParenthesis($expression)){
    echo ('Syntax error, brackets are incorrect');
    exit;
}
$tokens = tokenize($expression);

var_dump($tokens);

function populateOperatorStack($tokens)
{
    $operands = new Stack();
    foreach($tokens as $token)
    {
        if(is_numeric($token)){
            $operands->push($token);
        }
    }
    return $operands;
}

function populateOperandStack($tokens)
{

    $operators = new Stack();
    foreach($tokens as $token)
    {
        if(!is_numeric($token)){
            $operators->push($token);
        }
    }
    return $operators;
}

// calculate($tokens);

$operators = populateOperatorStack($tokens);
$operands = populateOperandStack($tokens);

function calculate($tokens)
{
       









    
    
}



function tokenize($string)
{
    $parts = preg_split('((\d+|\+|-|\(|\)|\*|/)|\s+)', $string, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    $parts = array_map('trim', $parts);
    return $parts;
};

function precedence($char)
{
    if ($char == '+' || $char == "-") {
        return 1;
    } elseif ($char == '*' || $char == "/") {
        return 2;
    } else {
        return 0;
    }
}

function applyOperator($firstNumber, $secondNumber, $operator)
{
    switch ($operator):
        case '+':
            return $firstNumber + $secondNumber;
            break;
        case '-':
            return $firstNumber - $secondNumber;
            break;
        case '*':
            return $firstNumber * $secondNumber;
            break;
        case '/':
            return $firstNumber / $secondNumber;
            break;
    endswitch;
}

function checkParenthesis($expression)
{
    $length = strlen($expression);
    $stack = new Stack();
    $areBracketsCorrect = true;

    for ($i = 0; $i < $length; $i++) {

        if ($expression[$i] == '(') {

            $stack->push($i);
        } elseif ($expression[$i] == ')') {

            if ($stack->isEmpty() == true) {

                $areBracketsCorrect = false;
                break;
            }
            $stack->pop();
        }
    }

    if ($stack->isEmpty() == false) {
        $areBracketsCorrect = false;
    }

    return $areBracketsCorrect;
};
