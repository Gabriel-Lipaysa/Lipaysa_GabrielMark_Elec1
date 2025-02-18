<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperationsController extends Controller
{
    public function fetch($operator1, $num1, $num2, $operator2, $num3, $num4)
    {
        return '
        <h1>Gabriel Lipaysa 3A</h1>'.
        $this->showOutput($operator1,$num1,$num2). '' . 
        $this->showOutput($operator2,$num3,$num4).'
        ';
    }

    function calculate($operator, $num1, $num2) //ito yung maghandle ng logic for arithmetic operations
    {   
        switch ($operator) {
            case 'multiply':
                return $num1 * $num2; 
            case 'divide':
                return $num2 != 0 ? $num1 / $num2 : 'Error: Division by zero';  //I check dito if yung divisor is not equal to zero and kung hindi man equal mag return ng sagot else mag return ng error message
            case 'add':
                return $num1 + $num2; 
            case 'minus':
                return $num1 - $num2;
        }
    }

    public function checkColor($num1, $num2, $result) 
    { 
        $colors = []; //Gumawa ako ng array para istore yung 3 colors na makukuha ng each parameters

        if (is_string($num1)) { //check man kung string yung first number
            $colors[0] = 'red'; //kung string man then ang magiging color ng first number is red na mastore sa first index.
        }
        $colors[0] = $num1 % 2 == 0 ? 'orange' : 'blue';//Kung false man yung condition sa taas, gumamit ako ng ternary operator para icheck kung even or odd yung first number and magiistore siya ng color depende sa makukuhang value.

        if (is_string($num2)) {
            $colors[1] = 'red';
        }
        $colors[1] = $num2 % 2 == 0 ? 'orange' : 'blue';

        if (is_string($result)) { //Same sa logic sa pagcheck ng first number pero kung nagtrue man yung condition dito then magrereturn na ng value yung function.
            $colors[2] = 'red';
            return $colors;
        }

        $colors[2] = $result % 2 == 0 ? 'green' : 'blue';
        return $colors; 
    }

    public function showOutput($operator,$num1,$num2)
    {   
        $result = $this->calculate($operator,$num1,$num2);
        $colors = $this->checkColor($num1,$num2, $result);

        return '<p>Value 1: <span style="color:' . $colors[0] . ';">' . $num1 . '</span></p>' .
        '<p>Value 2: <span style="color:' . $colors[1] . ';">' . $num2 . '</span></p>'.
        'Operator:' . $operator. 
        '<br><div style="display:flex; align-items:center; text-align:center">
        <p style="color:'.$colors[2].'; padding: 5px;">Result: </p> <div style="height: 40px;width: 180px; background-color:' . $colors[2] . '; color:white; text-align:center; align-content:center;">' .
            $result . '</div>
        </div>
        ';
    }
}
