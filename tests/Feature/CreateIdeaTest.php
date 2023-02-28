<?php

namespace Tests\Feature;

use App\Http\Livewire\CreateIdea;
use App\Models\Category;
use App\Models\Status;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CreateIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_idea_form_does_not_show_when_logged_out(){
        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();
        $response->assertSee('Please login to create an idea');
        $response->assertDontSee('Let us know what you would like and we\'ll take a look');

    }

        /** @test */
        public function create_idea_form_does_show_when_logged_in(){
            $response = $this->actingAs(User::factory()->create())-> get(route('idea.index'));
    
            $response->assertSuccessful();
            $response->assertSee('Let us know what you would like and we\'ll take a look',false);
            $response->assertDontSee('Please login to create an idea');
    
        }

        /** @test */
        public function main_page_contains_create_idea_livewire_component(){
            $this->actingAs(User::factory()->create())
                 ->get(route('idea.index'))
                 ->assertSeeLivewire('create-idea');

        }

        /** @test */
        public function create_idea_form_validation_works(){
            Livewire::actingAs(User::factory()->create())
                ->test(CreateIdea::class)
                ->set('title','')
                ->set('category','')
                ->set('description','')
                ->call('createIdea')
                ->assertHasErrors(['title','category','description'])
                ->assertSee('The title field is required');
        }

        /** @test */
        public function creating_idea_works_correctly(){
            $user = User::factory()->create();

            $categoryOne = Category::factory()->create(['name' => 'Category 1']);
            $categoryTwo = Category::factory()->create(['name' => 'Category 2']);
    
            $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
            $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);
        
        
            Livewire::actingAs(User::factory()->create())
            ->test(CreateIdea::class)
            ->set('title','coba coba')
            ->set('category',$categoryOne->id)
            ->set('description','masih coba coba dulu')
            ->call('createIdea')
            ->assertRedirect('/');

            $response = $this->actingAs($user)->get(route('idea.index'));
            $response->assertSuccessful();
            $response->assertSee('coba coba');
            $response->assertSee('masih coba coba dulu');

            $this->assertDatabaseHas('ideas',[
                'title'=> 'coba coba'
            ]);

        }

             /** @test */
             public function creating_two_ideas_with_same_title_works_but_has_different_slugs(){
                $user = User::factory()->create();
    
                $categoryOne = Category::factory()->create(['name' => 'Category 1']);
                $categoryTwo = Category::factory()->create(['name' => 'Category 2']);
        
                $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
                $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-purple text-white']);
            
            
                Livewire::actingAs(User::factory()->create())
                ->test(CreateIdea::class)
                ->set('title','coba coba')
                ->set('category',$categoryOne->id)
                ->set('description','masih coba coba dulu')
                ->call('createIdea')
                ->assertRedirect('/');
    
                $this->assertDatabaseHas('ideas',[
                    'title'=> 'coba coba',
                    'slug'=> 'coba-coba'
                ]);

                Livewire::actingAs(User::factory()->create())
                ->test(CreateIdea::class)
                ->set('title','coba coba')
                ->set('category',$categoryOne->id)
                ->set('description','masih coba coba dulu')
                ->call('createIdea')
                ->assertRedirect('/');
    
                $this->assertDatabaseHas('ideas',[
                    'title'=> 'coba coba',
                    'slug'=> 'coba-coba-2'
                ]);
    
            }
}
