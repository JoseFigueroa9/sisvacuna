<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PosController extends Component
{
    public $total=10,$itemsQuantity=1, $cart=[];

    public function render()
    {
        return view('livewire.pos.component')->extends('layouts.theme.app')->section('content');
    }
}
