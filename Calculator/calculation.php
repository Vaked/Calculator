<?php

require_once("index.php");

$expression = $_POST['expression'];

if (!checkParenthesis($expression)) {
    echo ('Syntax error, brackets are incorrect');
    exit;
}

$tokens = tokenize($expression);

function infixToPostfix($tokens)
{
    $result = [];
    $operatorStack = new SplStack();

    foreach ($tokens as $token) {
        if (is_numeric($token)) {
            $result[] = $token;
        } elseif ($token == '(') {
            $operatorStack->push($token);
        } elseif ($token == ')') {
            while ($operatorStack->count() > 0 && $operatorStack->top() != '(') {
                $result[] = $operatorStack->pop();
            }
            if ($operatorStack->count() > 0 && $operatorStack->top() != '(') {
                return "Syntax error, Invalid expression";
            } else {
                $operatorStack->pop();
            }
        } else {
            while ($operatorStack->count() > 0 && precedence($token) <= precedence($operatorStack->top())) {
                $result[] = $operatorStack->pop();
            }
            $operatorStack->push($token);
        }
    }

    while ($operatorStack->count() > 0) {
        $result[] = $operatorStack->pop();
    }
    return $result;
}

function evaluatePostfix($postfix)
{
    $firstOperand = 0;
    $secondOperand = 0;
    $result = 0;
    $stack = new SplStack();


    foreach ($postfix as $token) {
        if (isOperator($token)) {
            $secondOperand = $stack->pop();
            $firstOperand = $stack->pop();
            $result = applyOperation($firstOperand, $token, $secondOperand);
            $stack->push($result);
        } elseif (is_numeric($token)) {
            $stack->push($token);
        }
    }
    return $result;
}

function isOperator($token)
{
    return in_array($token, ['-', '+', '*', '/', '%']);
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
    } elseif ($char == '*' || $char == "/" || $char == '%') {
        return 2;
    } else {
        return 0;
    }
}

function applyOperation($firstNumber, $operator, $secondNumber)
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
    $stack = new SplStack();
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
