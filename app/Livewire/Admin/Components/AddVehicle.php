<?php

namespace App\Livewire\Admin\Components;

use App\Models\BodyStyle;
use App\Models\BrandModel;
use App\Models\Color;
use App\Models\Part;
use App\Models\Variant;
use App\Models\Vehicle;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class AddVehicle extends Component
{
    use WithFileUploads;

    public $models, $variants, $colors, $bodies;
    public $count = 0;
    public $input = [];

    #[Rule('nullable|image')]
    public $photo;

    #[Computed]
    public function parts()
    {
        return Part::all()->groupBy('part_type');
    }

    public function render()
    {
        $this->models = BrandModel::all();
        $this->variants = Variant::all();
        $this->colors = Color::all();
        $this->bodies = BodyStyle::all();
        return view('livewire.admin.components.add-vehicle');
    }

    public function createVehicle()
    {
        $validate = Validator::make($this->input, [
            'model' => 'required',
            'variant' => 'required',
            'color' => 'required',
            'body' => 'required',
            'model_year' => 'required',
            'price' => 'required',
            'manufactured_date' => 'required|date',
            'engine' => 'required',
            'transmission' => 'required',
            'axle' => 'required',
            'shock_absorber' => 'required',
            'quantity' => 'required|integer|min:1',
        ])->validate();
        try {
            if ($this->photo) {
                $validate['image_url'] = $this->photo->store('RAILWAY_VOLUME_MOUNT_PATH.env', 'RAILWAY_VOLUME_NAME.env');
            }

            $vehicleData = Arr::except($validate, ['engine', 'axle', 'transmission', 'shock_absorber', 'quantity']);
            $quantity = $validate['quantity'];

            for ($i = 0; $i < $quantity; $i++) {
                $vehicle = Vehicle::create($vehicleData);
                $vehicle->vehicleparts()->createMany([
                    ['part' => $validate['engine']],
                    ['part' => $validate['transmission']],
                    ['part' => $validate['axle']],
                    ['part' => $validate['shock_absorber']],
                ]);
            }

            Alert::toast('Succesfully Added', 'success');
            return redirect()->to('Admin/Vehicles');
        } catch (Exception $e) {
            Alert::toast('Something Went Wrong!', 'error');
        }
    }

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count > 0 && $this->count--;
    }
}
