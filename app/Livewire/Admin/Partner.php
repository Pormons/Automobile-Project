<?php

namespace App\Livewire\Admin;

use App\Models\Partner as ModelsPartner;
use Livewire\Component;

class Partner extends Component
{
    public $searchName, $type;

    public function render()
    {
        $query = ModelsPartner::query();

        if ($this->searchName && $this->type) {
            $query->where('partner_name', 'LIKE', '%' . $this->searchName . '%')
                  ->where('partner_type', $this->type);
        }
        elseif ($this->searchName) {
                $query->where('partner_name', 'LIKE', '%' . $this->searchName . '%');
        }
        elseif ($this->type) {
                $query->where('partner_type', $this->type);
        }

        $partners = $query->paginate(8);

        return view('livewire.admin.partner', compact('partners'));
    }

    public function delete($id)
    {
        $dealer = ModelsPartner::findorfail($id);
        $dealer->delete();

        return redirect()->to('Admin/Partners');
    }
}
