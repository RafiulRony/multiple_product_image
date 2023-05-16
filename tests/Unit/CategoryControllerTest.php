<?php


namespace Tests\Unit;
// use PHPUnit\Framework\TestCase;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{

    public function testShowCategory(){
        $controller = new CategoryController();
        for ($i = 0; $i < 10; $i++) {
            $requestData = [
                'name' => 'Test Category' . $i,
                'image' => UploadedFile::fake()->image('category'. $i .'.jpg'),
            ];

            $data = request()->merge($requestData);

            $response = $controller->store_category($data);
            $this->assertEquals(302, $response->getStatusCode());
            $this->assertTrue(session()->has('msg'));

            $this->assertDatabaseHas('categories', [
                'name' => 'Test Category' . $i,
            ]);
        }
    }

    public function testStoreCategory(){
        $controller = new CategoryController();
        for($i = 0; $i < 10; $i++){
            $requestData = [
                'name' => 'Test Category' . $i,
                'image' => UploadedFile::fake()->image('category'. $i .'.jpg'),
            ];
            $data = request()->merge($requestData);

            $response = $controller->store_category($data);
            $this->assertEquals(302, $response->getStatusCode());
            $this->assertTrue(session()->has('msg'));

            $this->assertDatabaseHas('categories', [
                'name' => 'Test Category' . $i,
            ]);
        }
    }

    public function testDeleteCategory(){
        for ($i = 0; $i < 10; $i++){
            $category = Category::factory()->create();
            $response = $this->get(route('delete.category', $category->id));

            $response->assertStatus(302);

            $this->assertDatabaseMissing('categories', ['id' => $category->id]);
        }
    }

    public function testUpdateCategory()
    {
        for ($i = 0; $i < 10; $i++){
            $category = Category::create([
                'name' => 'Test Category',
                'image' => 'test_category.jpg',
            ]);

            $updatedData = [
                'name' => 'Updated Category',
                'image' => UploadedFile::fake()->image('updated_category.jpg'),
            ];
            $request = Request::create('/update-categories/' . $category->id, 'POST', $updatedData);

            $controller = new CategoryController();
            $response = $controller->update_category($request, $category->id);

            $this->assertEquals(302, $response->getStatusCode());
            $this->assertTrue(session()->has('msg'));

            $updatedCategory = Category::find($category->id);

            $this->assertEquals('Updated Category', $updatedCategory->name);
        }
    }
}
