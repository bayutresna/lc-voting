<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
use App\Http\Livewire\IdeasIndex;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function index_page_contains_idea_show_livewire_component(){
        Idea::factory()->create();

        $this->get(route('idea.index'))
             ->assertSeeLivewire('idea-index');
    }

            /** @test */
    public function ideas_index_livewire_component_page_correctly_receive_votes_count(){
        $user = User::factory()->create();
        $userb = User::factory()->create();
        
        $idea = Idea::factory()->create();

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id,
        ]);

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$userb->id,
        ]);

        Livewire::test(IdeasIndex::class)
             ->assertViewHas('ideas', function($ideas){
                return $ideas->first()->votes_count == 2;
             });
    }

            /** @test */
    public function votes_count_shows_correctly_on_index_page_livewire_component(){
        $user = User::factory()->create();
        $userb = User::factory()->create();
        $idea = Idea::factory()->create();

        Livewire::test(IdeaIndex::class, [
            'idea'=> $idea,
            'votes' => 5
        ]) 
        ->assertSet('votes',5);
    }

    /** @test */
    public function user_who_is_logged_in_shows_voted_if_idea_already_voted_for(){
        $user = User::factory()->create();

        $idea = Idea::factory()->create();
        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id' => $user->id
        ]);

        $idea->votes_count = 1;
        $idea->voted_by_user = 1;

        Livewire::actingAs($user)->test(IdeaIndex::class, [
            'idea'=> $idea,
            'votes' => 5
        ]) 
        ->assertSet('votes',5);
    }
        /** @test */
    public function user_who_is_not_logged_in_is_redirected_to_login_page_when_trying_to_vote(){
        
        $idea = Idea::factory()->create();

        Livewire::test(IdeaIndex::class, [
            'idea'=> $idea,
            'votes' => 5
        ]) 
        ->call('vote',true)
        ->assertRedirect(route('login'));
    }

        /** @test */
        public function user_who_is_logged_in_can_vote(){
            $user = User::factory()->create();
    
            $idea = Idea::factory()->create();

            $this->assertDatabaseMissing('votes',[
                'idea_id'=>$idea->id,
                'user_id'=> $user->id
            ]);
    
    
            Livewire::actingAs($user)
                ->test(IdeaIndex::class, [
                'idea'=> $idea,
                'votes' => 5
            ]) 
            ->call('vote')
            ->assertSet('votes',6)
            ->assertSet('hasVoted',true)
            ->assertSee('Voted');

            $this->assertDatabaseHas('votes',[
                'idea_id'=>$idea->id,
                'user_id'=> $user->id
            ]);
        }

    /** @test */
    public function user_who_is_logged_in_can_remove_vote_for_idea(){
        $user = User::factory()->create();
        $idea = Idea::factory()->create();
        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
        ]);

        $idea->votes_count = 1;
        $idea->voted_by_user = 1;

        Livewire::actingAs($user)
            ->test(IdeaIndex::class, [
                'idea' => $idea,
                'votes' => 5,
            ])
            ->call('vote')
            ->assertSet('votes', 4)
            ->assertSet('hasVoted', false)
            ->assertSee('Vote')
            ->assertDontSee('Voted');
        $this->assertDatabaseMissing('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);
    }
    
}
