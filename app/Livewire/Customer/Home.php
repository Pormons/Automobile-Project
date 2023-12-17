<?php

namespace App\Livewire\Customer;

use App\Models\BodyStyle;
use App\Models\Color;
use App\Models\Variant;
use App\Models\Vehicle;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Home extends Component
{
    public $colors;
    public $variants;
    public $bodyStyles;

    public $searchVehicle;
    public $selectedColors = [];
    public $selectedVariants = [];
    public $selectedBodyStyles = [];

    public function mount ()
    {
        $this->colors = Color::all();
        $this->variants = Variant::all();
        $this->bodyStyles = BodyStyle::all();
    }

    public function render()
    {
        $query = Vehicle::whereHas('inventories', function ($query) {
            $query->where('available', true);
        });

        if ($this->searchVehicle) {
            $query->where(function ($subquery) {
                $subquery->whereHas('model_info', function ($query) {
                    $query->where('model_name','LIKE', '%'. $this->searchVehicle. '%');
                })
                ->orWhereHas('model_info.brand_info', function ($query) {
                    $query->where('brand_name', 'LIKE', '%'. $this->searchVehicle. '%');
                });
            });
        }

        if ($this->selectedColors) {
            $query->whereIn('color', $this->selectedColors);
        }
        if ($this->selectedVariants) {
            $query->whereIn('variant', $this->selectedVariants);
        }

        if ($this->selectedBodyStyles) {
            $query->whereIn('body', $this->selectedBodyStyles);
        }

        $vehicles = $query->get();

        return view('livewire.customer.home',compact('vehicles'));
    }
}
