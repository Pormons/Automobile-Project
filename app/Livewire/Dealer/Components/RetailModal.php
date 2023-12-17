<?php

namespace App\Livewire\Dealer\Components;

use App\Models\Inventory;
use Exception;
use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;

class RetailModal extends Component
{
    public $defaultValue;

    public $id;

    public $retail_price;

    public function render()
    {

        return view('livewire.dealer.components.retail-modal');
    }

    #[On('update-retail')]
    public function update($id)
    {
        $this->id = $id;
    }

    public function updateRetail()
    {
        try{

            $retail = Inventory::findorfail($this->id);
            $retail->retail_price = $this->retail_price;
            $retail->save();
            Alert::toast('Successfully Added Price', 'success');
            return redirect()->to('/Dealer/Inventory');
        }catch(Exception $e){
            Alert::toast('Something Went Wrong', 'error');
        }


    }
}
