<?php

function response($content = null) {
    return new Template($content);
}