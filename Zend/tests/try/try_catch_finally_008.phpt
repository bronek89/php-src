--TEST--
Catching Multiple Exception Types
--CREDITS--
bronek
--FILE--
<?php

class AE extends Exception {};
class BE extends Exception {};
class BaE extends BE {};

function foo() {
    try {
        throw new AE();
    } catch (AE|BE $e) {
        echo "3";
    } finally {
        echo "4";
    }
    return 1;
}

var_dump(foo());

function bar() {
    try {
        throw new BaE();
    } catch (AE|BE $e) {
        echo "3";
    } finally {
        echo "4";
    }
    return 1;
}

var_dump(bar());

function xoxo() {
    try {
        try {
            throw new AE();
        } catch (BaE|BE $e) {
            echo "3";
        } finally {
            echo "4";
        }
    } catch (\Throwable|AE $e) {
        echo "5";
    }
    return 1;
}

var_dump(xoxo());
?>
--EXPECTF--
34int(1)
34int(1)
45int(1)
