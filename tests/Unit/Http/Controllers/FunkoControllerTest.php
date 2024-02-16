<?php

namespace Http\Controllers;

use App\Http\Controllers\FunkoController;
use App\Models\Funko;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class FunkoControllerTest extends TestCase
{
    use RefreshDatabase;

    private $funkoController;

    public function setUp(): void
    {
        parent::setUp();
        $this->funkoController = new FunkoController();
    }

    public function testIndex()
    {
        $request = new Request();
        $request->search = null;
        $funkos = $this->funkoController->index($request);
        $this->assertIsObject($funkos);
    }

    public function testShow()
    {
        $funko = Funko::factory()->create();
        $response = $this->get('/funkos/' . $funko->id);
        $response->assertOk();
        $response->assertViewIs('funkos.show');
        $response->assertViewHas('funko');
    }

    public function testStore()
    {
        $category = Category::factory()->create();
        $request = new Request();
        $request->name = 'Funko 1';
        $request->price = 10;
        $request->stock = 5;
        $request->category_id = $category->id;
        $funko = $this->funkoController->store($request);
        $this->assertIsObject($funko);
    }

    public function testCreate()
    {
        $response = $this->get('/funkos/create');
        $response->assertOk();
        $response->assertViewIs('funkos.create');
    }

    public function testEdit()
    {
        $user = User::factory()->create();
        $funko = Funko::factory()->create();
        $response = $this->actingAs($user)->get('/funkos/edit/' . $funko->id);
        $response->assertOk();
        $response->assertViewIs('funkos.edit');
        $response->assertViewHas('funko');
    }

    public function testUpdate()
    {
        $funko = Funko::factory()->create();
        $request = new Request();
        $request->name = 'Funko 2';
        $request->price = 20;
        $request->stock = 10;
        $request->category_id = $funko->category_id;
        $funko = $this->funkoController->update($request, $funko->id);
        $this->assertIsObject($funko);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $funko = Funko::factory()->create();
        $response = $this->actingAs($user)->delete('/funkos/delete/' . $funko->id);
        $response->assertRedirect();
    }
}
