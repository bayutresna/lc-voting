<?php

namespace Tests\Unit;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_check_if_idea_voted_by_user(){
        
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
        
        $this->assertTrue($idea->isVotedByUser($user));
        $this->assertFalse($idea->isVotedByUser($userb));
        $this->assertFalse($idea->isVotedByUser(null));
    }

    /** @test */
    public function user_can_vote(){
        
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
        
        $this->assertFalse($idea->isVotedByUser($user));

        $idea->vote($user);
        $this->assertTrue($idea->isVotedByUser($user));
    }
        /** @test */
    public function voting_an_already_voted_idea_for_throw_exception(){
        
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

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id' => $user->id
        ]);
        
        $this->expectException(DuplicateVoteException::class);
        $idea->vote($user);
    }

            /** @test */
    public function remove_voting_an_that_doesnt_exist_for_throw_exception(){
        
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

        
        $this->expectException(VoteNotFoundException::class);
        $idea->unvote($user);
    }

    /** @test */
    public function user_can_unvote(){
        
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

        Vote::factory()->create([
            'idea_id'=>$idea->id,
            'user_id' => $user->id
        ]);
        
        $this->assertTrue($idea->isVotedByUser($user));
        $idea->unvote($user);
        $this->assertFalse($idea->isVotedByUser($user));
    }

}
