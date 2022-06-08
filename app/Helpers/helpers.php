<?php

if (! function_exists('uuid4')) {
    function uuid4() {
        return \Ramsey\Uuid\Uuid::uuid4()->toString();
    }
}