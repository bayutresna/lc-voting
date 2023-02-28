<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea;
    public $votes;
    public $hasVoted;

    public function mount(Idea $idea, $votes){
        $idea = $this->idea;
        $votes = $this->votes;
        $this->hasVoted = $idea->voted_by_user;

    }

    public function vote(){
        if(!auth()->check()){
            return redirect(route('login')); 
        }

        if($this->hasVoted){
            try{
                $this->idea->unvote(auth()->user());
                $this->votes--;
                $this->hasVoted = false;
            } catch(VoteNotFoundException $e){

            }
        }
        else{
            try{
                $this->idea->vote(auth()->user());
                $this->votes++;
                $this->hasVoted = true;
            } catch(DuplicateVoteException $e){
                
            }
            
        } 
    }
    
    public function render()
    {
        return view('livewire.idea-index');
    }
}
