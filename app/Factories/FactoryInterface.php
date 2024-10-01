<?php

namespace App\Factories;

use Flasher\Prime\Notification\Envelope;
use Flasher\Toastr\Prime\ToastrInterface;

interface FactoryInterface
{
    public static function makeSuccess(string $message): Envelope | ToastrInterface;
    public static function makeError(string $message): Envelope | ToastrInterface;
    public static function makeInfo(string $message): Envelope | ToastrInterface;
    public static function makeWarning(string $message): Envelope | ToastrInterface;
}
