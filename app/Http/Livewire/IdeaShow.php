<?php

namespace App\Http\Livewire;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    use WithAuthRedirects;
    public $idea;
    public $votes;
    public $hasVoted;

    protected $listeners = [
        'statusWasUpdated',
        'ideaWasUpdated',
        'ideaWasMarkedAsSpam',
        'ideaWasMarkedAsNotSpam',
        'commentWasAdded',
        'commentWasDeleted',
    ];
    
    public function ideaWasMarkedAsSpam(){
        $this->idea->refresh();
    }

    public function ideaWasMarkedAsNotSpam(){
        $this->idea->refresh();
    }

    public function commentWasAdded(){
        $this->idea->refresh();
    }
    public function commentWasDeleted(){
        $this->idea->refresh();
    }

    public function statusWasUpdated(){
        $this->idea->refresh();
    }

    public function ideaWasUpdated(){
        $this->idea->refresh();
    }

    public function mount(Idea $idea, $votes){
        $this->idea = $idea;
        $this->votes = $votes;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function vote(){
        if(auth()->guest()){
            return $this->redirectToLogin();
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
        return view('livewire.idea-show');
    }
}
