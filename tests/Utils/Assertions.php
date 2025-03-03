<?php

function assertEquals($expected, $actual, $testName) {
    if ($expected === $actual) {
        echo "$testName => passed\n";
    } else {
        echo "$testName => failed. Expected: $expected, Got: $actual\n";
    }
}

function assertTrue($condition, $testName) {
    if ($condition) {
        echo "$testName => passed\n";
    } else {
        echo "$testName => failed. Expected true, got false\n";
    }
}

function assertContains($needle, $haystack, $testName) {
    if (str_contains($haystack, $needle)) {
        echo "$testName => passed\n";
    } else {
        echo "$testName => failed. Needle: $needle, Haystack: $haystack\n";
    }
}