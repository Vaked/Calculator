<?php

require_once("index.php");

class Calculator
{

    static function infixToPostfix($tokens)
    {
        $tokens = Calculator::tokenize($tokens);
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
                while ($operatorStack->count() > 0 && Calculator::precedence($token) <= Calculator::precedence($operatorStack->top())) {
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

    static function evaluatePostfix($postfix)
    {
        $postfix = Calculator::infixToPostfix($postfix);
        $firstOperand = 0;
        $secondOperand = 0;
        $result = 0;
        $stack = new SplStack();

        foreach ($postfix as $token) {
            if (calculator::isOperator($token)) {
                $secondOperand = $stack->pop();
                $firstOperand = $stack->pop();
                $result = Calculator::applyOperation($firstOperand, $token, $secondOperand);
                $stack->push($result);
            } elseif (is_numeric($token)) {
                $stack->push($token);
            }
        }
        return $result;
    }

    static function tokenize($string)
    {
        $parts = preg_split('((\d+|\+|-|\(|\)|\*|%|\)|\/|\s+))', $string, null, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $parts = array_map('trim', $parts);
        return $parts;
    }

    static public function isOperator($token)
    {
        return in_array($token, ['-', '+', '*', '/', '%']);
    }

    static function applyOperation($firstNumber, $operator, $secondNumber)
    {
        switch ($operator):
            case '+':
                return $firstNumber + $secondNumber;

            case '-':
                return $firstNumber - $secondNumber;

            case '*':
                return $firstNumber * $secondNumber;

            case '/':
                return $firstNumber / $secondNumber;

        endswitch;
    }

    static function precedence($char)
    {
        if ($char == '+' || $char == "-") {
            return 1;
        } elseif ($char == '*' || $char == "/" || $char == '%') {
            return 2;
        } else {
            return 0;
        }
    }

    static public function checkParenthesis($expression)
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
    }
}
