<?php

namespace App\Factories;

use Flasher\Prime\Notification\Envelope;
use Flasher\Prime\Notification\Type;
use Flasher\Toastr\Prime\ToastrInterface;

class NotifyFactory implements FactoryInterface
{
    public static function makeSuccess(string $message): Envelope | ToastrInterface
    {
        return toastr($message, Type::SUCCESS);
    }

    public static function makeError(string $message): Envelope | ToastrInterface
    {
        return toastr($message, Type::ERROR);
    }

    public static function makeInfo(string $message): Envelope | ToastrInterface
    {
        return toastr($message, Type::INFO);
    }

    public static function makeWarning(string $message): Envelope | ToastrInterface
    {
        return toastr($message, Type::WARNING);
    }
}
