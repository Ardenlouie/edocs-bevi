<?php

namespace App\Livewire\Departments;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Edoc;
use App\Models\Department;
use App\Models\Type;

class GlobalSales extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search, $item_per_page, $company_id=1, $department_id=5, $departments, $types, $type_id=1, $status='active';
    public $page_selected;
    
    public $activeTab = 'tab1';

    public function changePage($page_selected) {
        $this->page_selected = $page_selected;
    }

    public function updatedSearch() {
        $this->resetPage('edocs-page');
    }

    public function updatedItemPerPage() {
        $this->resetPage('edocs-page');
    }

    public function updatedStatus() {
        $this->resetPage('edocs-page');
    }

    public function mount() {
  

        $this->item_per_page = '5';

        // $this->departments = Department::all()->keyBy('id');

        $this->types = Type::all()->keyBy('id');

    }

    public function changeTab($tab, $type_id)
    {
        $this->activeTab = $tab;

        $this->type_id = $type_id;

        $this->resetPage('edocs-page');

    }

    public function render()
    {
        $edocs = Edoc::where(function ($query) {
            if (!empty($this->department_id)) { 
                $query->where('type_id', $this->type_id)->where('department_id', $this->department_id);
                
            }
            $query->unless(auth()->user()->can('global sales access'), function ($q) {
                $q->where('confidential', 0);
            });
            
        })
            ->whereHas('type', function($query) {
                // searchs
                if(!empty($this->search)) {
                    $query->where(function($qry) {
                        $qry->where('control_number', 'like', '%'.$this->search.'%')
                        ->orWhere('reference_number', 'like', '%'.$this->search.'%')
                        ->orWhere('title', 'like', '%'.$this->search.'%')
                        ->orWhere('type_id', 'like', '%'.$this->search.'%');
                    });
                }
                if(!empty($this->status)) {
                    $query->where('status', $this->status);
                }

            })->orderBy('created_at', 'desc');

        if($this->item_per_page == 'all') {
            $edocs = $edocs->get();
        } else {
            $edocs = $edocs->paginate($this->item_per_page, ['*'], 'edocs-page')
            ->onEachSide(1);
        }

        return view('livewire.departments.global-sales')->with([
            'edocs' => $edocs,
        ]);
    }
}
