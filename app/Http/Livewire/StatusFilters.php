<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class StatusFilters extends Component
{

    public $status ='All';
    public $statusCount;

    protected $queryString = [
        'status'
    ];

    public function mount(){

        $this->statusCount= Status::getCount();

        if(Route::currentRouteName()== 'idea.show'){
            $this->status = null;
            $this->queryString = [];
        }
    }
    
    public function setStatus($newstatus){
        $this->status = $newstatus;

        // if($this->getPreviousRouteName()!== 'idea.index' ){
            return redirect()->route('idea.index',[
                'status'=> $this->status
            ]);
        // }
    }

    private function getPreviousRouteName()
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }

    public function render()
    {
        return view('livewire.status-filters');
    }
}
