<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\PackageCategory;

class Package extends Component
{
    public $data = [];
    public $package;

    public function dedicatedCollect()
    {
        $dedicated = PackageCategory::find(1)->package;
        $this->data = $dedicated;
        $this->package = PackageCategory::where('name', 'Dedicated')->first();
    }

    public function sohoCollect()
    {
        $soho = PackageCategory::find(2)->package;
        $this->data = $soho;
        $this->package = PackageCategory::where('name', 'Soho')->first();
    }

    public function render()
    {
        return view('livewire.package');
    }
}
