<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dealer extends Component
{
    use WithPagination;

    public $searchName;

    public function render()
    {
        $query = User::query()->where('user_type', 'dealer');

        if ($this->searchName) {
            $query->where('dealer', 'LIKE', '%' . $this->searchName . '%');
        }

        $dealers = $query->paginate(8);

        return view('livewire.admin.dealer', compact('dealers'));

    }

    public function delete($id)
    {
        $dealer = User::findorfail($id);
        $dealer->delete();

        return redirect()->to('Admin/Dealers');
    }
}
