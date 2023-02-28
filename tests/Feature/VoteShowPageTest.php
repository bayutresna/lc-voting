<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaShow;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteShowPageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function show_page_contains_idea_show_livewire_component(){
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

        $idea = Idea::factory()->create([
            'user_id'=> $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $this->get(route('idea.show',$idea))
             ->assertSeeLivewire('idea-show');
    }


        /** @test */
    public function show_page_correctly_receive_votes_count(){
        $user = User::factory()->create();
        $userb = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

        $idea = Idea::factory()->create([
            'user_id'=> $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$user->id,
        ]);

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id'=>$userb->id,
        ]);

        $this->get(route('idea.show',$idea))
             ->assertViewHas('votes',2);
    }

        /** @test */
    public function votes_count_shows_correctly_on_show_page_livewire_component(){
        $user = User::factory()->create();
        $userb = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

        $idea = Idea::factory()->create([
            'user_id'=> $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        Livewire::test(IdeaShow::class, [
            'idea'=> $idea,
            'votes' => 5
        ]) 
        ->assertSet('votes',5);
    }

    /** @test */
    public function user_who_is_logged_in_shows_voted_if_idea_already_voted_for(){
        $user = User::factory()->create();
        $userb = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

        $idea = Idea::factory()->create([
            'user_id'=> $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);
        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id' => $user->id
        ]);

        Livewire::actingAs($user)->test(IdeaShow::class, [
            'idea'=> $idea,
            'votes' => 5
        ]) 
        ->assertSet('hasVoted',true)
        ->assertSeeHtml('Voted');
    }
        /** @test */
    public function user_who_is_not_logged_in_is_redirected_to_login_page_when_trying_to_vote(){
        $user = User::factory()->create();
        $userb = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);
        $categoryTwo = Category::factory()->create(['name' => 'Category 2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);

        $idea = Idea::factory()->create([
            'user_id'=> $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);


        Livewire::test(IdeaShow::class, [
            'idea'=> $idea,
            'votes' => 5
        ]) 
        ->call('vote',true)
        ->assertRedirect(route('login'));
    }

    /** @test */
    public function user_who_is_logged_in_can_vote(){
        $user = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id'=> $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);
        $this->assertDatabaseMissing('votes',[
            'idea_id'=>$idea->id,
            'user_id'=> $user->id
        ]);


        Livewire::actingAs($user)
            ->test(IdeaShow ::class, [
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
}
