<?php

namespace App\Traits;

trait Toastr
{

    public function showToastr($message, $type)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message,
        ]);
    }

    public function alert($type, $message)
    {
        return $this->dispatch('showToastr', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}