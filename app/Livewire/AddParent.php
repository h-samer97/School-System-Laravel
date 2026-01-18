<?php

namespace App\Livewire;

use App\Models\Nationalities;
use App\Models\Religion;
use App\Models\TypeBlood;
use Livewire\Component;

class AddParent extends Component
{

    public $currentStep = 1;
    public $successMessage;
    public $catchError;
    public function render()
    {
      return view('livewire.add-parent', [
            'Nationalities' => Nationalities::all(),
            'Type_Bloods' => TypeBlood::all(),
            'Religions' => Religion::all(),
        ]);
    }
}
