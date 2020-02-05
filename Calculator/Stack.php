<?php

class Stack
{
    protected $stack;
    protected $size;

    public function __construct($size = 50)
    {
        $this->stack = array();

        $this->size = $size;
    }

    public function push($data)
    {
        if (count($this->stack) < $this->size) {

            array_unshift($this->stack, $data);
        } else {

            throw new RuntimeException("Stack overflow, you have reached the limit of the stack!");
        }
    }

    public function pop()
    {
        if (empty($this->stack)) {

            throw new RuntimeException("Stack underflow, stack is empty, cannot pop non existing item!");
        } else {
            return array_shift($this->stack);
        }
    }

    public function top()
    {
        return current($this->stack);
    }

    public function isEmpty()
    {
        return empty($this->stack);
    }

    public function count()
    {
        return count($this->stack);
    }
    
}