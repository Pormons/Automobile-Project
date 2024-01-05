<?php

namespace App\Livewire\Customer;

use App\Models\BodyStyle;
use App\Models\Color;
use App\Models\User;
use App\Models\Variant;
use App\Models\Vehicle;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Home extends Component
{
    public $colors;
    public $variants;
    public $bodyStyles;
    public $dealers;
    public $searchDealer;
    public $searchVehicle;
    public $selectedColors = [];
    public $selectedVariants = [];
    public $selectedBodyStyles = [];

    public $start, $end;


    public function mount ()
    {
        $this->colors = Color::all();
        $this->variants = Variant::all();
        $this->bodyStyles = BodyStyle::all();
        $this->dealers = User::where('user_type','dealer')->get();
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

        if($this->searchDealer)
        {
            $query->where(function ($subquery)
            {
                $subquery->whereHas('inventories', function ($query) {
                    $query->where('dealer',$this->searchDealer);
                });
            });
        }

        if ($this->start && $this->end) {
            $query->where(function ($subquery) {
                $subquery->whereHas('inventories', function ($query) {
                    $query->whereBetween('retail_price', [$this->start, $this->end]);
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
