<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemSolvingController extends Controller
{

    public function getLowestIntegerPositiveValue(Request $request)
    {
        $array = $request->input('arr_values');
        if (!$array)
            return response()->json(['message' => 'Array is required'], 400);

        $array = array_unique($array);
        sort($array);
        $x = 1;
        foreach ($array as $value) {
            if ($value > 0) {
                if ($value == $x) {
                    $x++;
                } else {
                    return $x;
                }
            }
        }
        return $x;
    }

    public function getNumbersWithoutFive(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');
        if (!$start || !$end)
            return response()->json(['message' => 'Start and end are required'], 400);


        $count = 0;
        for ($i = $start; $i <= $end; $i++) {
            if (strpos($i, '5') === false) {
                $count++;
            }
        }
        return $count;
    }


    public function getAlphabeticIndex(Request $request)
    {
        $input_string = $request->input('input_string');
        if (!$input_string)
            return response()->json(['message' => 'Input string is required'], 400);

        $input_string = strtoupper($input_string);
        $alphabet = range('A', 'Z');
        $index = 0;
        $length = strlen($input_string);
        for ($i = 0; $i < $length; $i++) {
            $index += (array_search($input_string[$i], $alphabet) + 1) * pow(count($alphabet), $length - $i - 1);
        }
        return $index;
    }


    public function getMinSteps(Request $request)
    {
        $N = $request->input('N');
        $Q = $request->input('Q');
        if (!$N || !$Q)
            return response()->json(['message' => 'N and Q are required'], 400);

        $result = [];
        for ($i = 0; $i < $N; $i++) {
            $x = $Q[$i];
            $steps = 0;
            while ($x > 0) {
                $x = $this->getMaxNumber($x);
                $steps++;
            }
            $result[] = $steps;
        }
        return $result;
    }

    private function getMaxNumber($x)
    {
        $max = 0;
        for ($i = 2; $i <= sqrt($x); $i++) {
            if ($x % $i == 0) {
                $max = max($max, max($i, $x / $i));
            }
        }
        return $max > 1 ? $max : $x - 1;
    }


}
