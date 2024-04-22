<?php

function is_palindrome(string $input_str): bool
{
    $cleaned_input_str =  strtolower(str_replace(' ', '', $input_str));

    return $cleaned_input_str == strrev($cleaned_input_str);
}

function grab_number_sum(string $input_str): int
{
    $number = '';
    $sum = 0;

    foreach (str_split($input_str) as $input_char) {
        if (is_numeric($input_char)) {
            $number .= $input_char;
        } elseif ($number != '') {
            $sum += intval($number);
            $number = '';
        }
    }
    $sum += intval($number);
    return $sum;
}

function is_balanced_brackets(string $input_str): bool
{
    $stack = [];

    for ($i = 0; $i < strlen($input_str); $i++) {
        $char = $input_str[$i];

        if ($char == '(' || $char == '[' || $char == '{') {
            array_push($stack, $char);
        } elseif ($char == ')' || $char == ']' || $char == '}') {
            if (empty($stack) || !is_matching_pair(array_pop($stack), $char)) {
                return false;
            }
        }
    }

    return empty($stack);
}

function is_matching_pair($char1, $char2): bool
{
    return ($char1 == '(' && $char2 == ')') || ($char1 == '[' && $char2 == ']') || ($char1 == '{' && $char2 == '}');
}


