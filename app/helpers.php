<?php

function generateTimeStamp($prefix=''){
        return $prefix.((int) (microtime(true) * 1000));
}
