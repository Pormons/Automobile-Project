<?php

namespace App\Livewire\Admin;

use App\Models\Part;
use Livewire\Component;
use App\Models\Partner;
use Livewire\WithPagination;

class PartnerInventory extends Component
{
    use WithPagination;

    public $partnerId;
    public $type;

    public $search, $part_type;

    public $name;

    public function mount($id)
    {
        $this->partnerId = $id;
    }

    public function render()
    {
        $partner = Partner::find($this->partnerId);
        $this->type = $partner->partner_type;
        $this->name = $partner->partner_name;

        if($partner->partner_type === 'Manufacturer')
        {
            $query = $partner->brandmodels()->with('vehicles');

        }else{
            $query = $partner->parts();

            if ($this->search) {
                $query->where('part_name', 'LIKE', '%' . $this->search . '%');
            }

            if ($this->part_type) {
                $query->where('part_type', $this->part_type);
            }
        }

        $stocks = $query->paginate(7);

        return view('livewire.admin.partner-inventory', compact('stocks'));
    }

    public function delete($id)
    {

        if($this->type === 'Supplier')
        {
            $part = Part::findorfail($id);
            $part->delete();
            return redirect()->to('Admin/Partners/'.$this->partnerId."/Inventory");
        }

    }



}
