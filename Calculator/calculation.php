<?php

require_once("index.php");
require_once("Stack.php");

$expression = $_POST['expression'];


if(!checkParenthesis($expression)){
    echo ('Syntax error, brackets are incorrect');
    exit;
}
$tokens = tokenize($expression);

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

$operators = populateOperatorStack($tokens);
$operands = populateOperandStack($tokens);

function calculate($tokens)
{
  $firstNumber = $tokens[0];
  $operator = $tokens[1];
  $secondNumber = $tokens[2];

  $result = applyOperator($firstNumber, $operator, $secondNumber);

  return $result;
}

$_POST['expression'] = calculate($tokens);

if(isset($_POST)){
    var_dump($_POST);
};

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

function applyOperator($firstNumber,$operator, $secondNumber)
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

            if ($stack->isEmpty()) {

                $areBracketsCorrect = false;
                break;
            }
            $stack->pop();
        }
    }

    if (!$stack->isEmpty()) {
        $areBracketsCorrect = false;
    }

    return $areBracketsCorrect;
};