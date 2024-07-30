<?php
namespace App\Http;

interface DataTransferObject {
    public function validate();

    public function toArray();
}