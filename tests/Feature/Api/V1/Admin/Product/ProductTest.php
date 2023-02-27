<?php

namespace Api\V1\Admin\Product;

use App\Enums\UserRoleEnum;
use App\Models\Product;
use App\Models\Property;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /* start tests for admin get_products */

    public function test_admin_can_not_get_products_without_login()
    {
        $this->createAdmin();

        $this->getJson(route('api.v1.admin.products.index'), [])
            ->assertStatus(401);
    }

    public function test_user_can_not_get_products()
    {
        $this->actAsAdmin($this->createUser());

        $this->getJson(route('api.v1.admin.products.index'), [])
            ->assertStatus(403);
    }

    public function test_admin_can_get_products()
    {
        $this->actAsAdmin($this->createAdmin());

        $this->getJson(route('api.v1.admin.products.index'), [])
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);
    }

    /* end tests for admin get_products */

    /* start tests for admin get_product */

    public function test_admin_can_not_get_product_without_login()
    {
        $this->createAdmin();

        $product = $this->createProduct();

        $this->getJson(route('api.v1.admin.products.show', $product->id), [])
            ->assertStatus(401);
    }

    public function test_user_can_not_get_product()
    {
        $this->actAsAdmin($this->createUser());

        $product = $this->createProduct();

        $this->getJson(route('api.v1.admin.products.show', $product->id), [])
            ->assertStatus(403);
    }

    public function test_admin_can_get_product()
    {
        $this->actAsAdmin($this->createAdmin());

        $product = $this->createProduct();

        $this->getJson(route('api.v1.admin.products.show', $product->id), [])
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);
    }

    /* end tests for admin get_products */

    /* start tests for admin create_product */

    public function test_admin_can_create_product()
    {
        $this->actAsAdmin($this->createAdmin());

        $image = UploadedFile::fake()->create('test.jpg', 1024);

        $this->postJson(route('api.v1.admin.products.store'),
            $this->productData() + ['image' => $image])
            ->assertSuccessful()
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);

        $this->assertEquals(1, Product::count());
    }

    public function test_admin_can_not_create_product_without_login()
    {
        $this->createadmin();

        $image = UploadedFile::fake()->create('test.jpg', 1024);

        $this->postJson(route('api.v1.admin.products.store'),
            $this->productData())
            ->assertStatus(401);
    }

    public function test_user_can_not_create_product()
    {
        $this->actAsUser($this->createUser());

        $image = UploadedFile::fake()->create('test.jpg', 1024);

        $this->postJson(route('api.v1.admin.products.store'),
            $this->productData() + ['image' => $image])
            ->assertStatus(403);
    }

    public function test_admin_can_not_create_product_because_name_is_required()
    {
        $this->actAsAdmin($this->createAdmin());

        $data = $this->productData();
        unset($data['name']);

        $this->postJson(route('api.v1.admin.products.store'),
            $data)
            ->assertStatus(422);
    }

    /* end tests for admin create_product */


    /* start tests for admin update_product */

    public function test_admin_can_update_product()
    {
        $this->actAsAdmin($this->createAdmin());

        $product = $this->createProduct();

        $this->postJson(route('api.v1.admin.products.update', $product->id),
            $this->productData())
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);

        $this->assertEquals(1,
            product::whereName($this->productData()['name'])->count());
    }

    public function test_admin_can_not_update_product_without_login()
    {
        $this->createadmin();

        $product = $this->createProduct();

        $this->postJson(route('api.v1.admin.products.update', $product->id),
            $this->productData())
            ->assertStatus(401);
    }

    /* end tests for admin update_product */

    /* start tests for admin delete_product */

    public function test_admin_can_delete_product()
    {
        $this->actAsAdmin($this->createAdmin());

        $product = $this->createproduct();

        $this->deleteJson(route('api.v1.admin.products.destroy',
            $product->id),
            $this->productData())
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);

        $this->assertCount(0, product::all());
    }

    public function test_admin_can_not_delete_product_without_login()
    {
        $this->createadmin();

        $product = $this->createproduct();

        $this->deleteJson(route('api.v1.admin.products.destroy',
            $product->id), $this->productData())
            ->assertStatus(401);
    }

    public function test_user_can_not_delete_product()
    {
        $this->actAsUser($this->createUser());

        $product = $this->createproduct();

        $this->deleteJson(route('api.v1.admin.products.destroy',
            $product->id), $this->productData())
            ->assertStatus(403);
    }

    /* end tests for admin delete_product */

    /* start tests for admin save_product_properties */

    public function test_admin_can_save_product_properties()
    {
        $this->actAsAdmin($this->createAdmin());

        $product = $this->createproduct();

        $this->postJson(route('api.v1.admin.products.properties.save',
            $product->id),
            $this->makeProductPropertiesData())
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);

        $this->assertEquals(5, $product->properties->count());
    }

    public function test_admin_can_not_save_product_properties_without_login()
    {
        $this->createadmin();

        $product = $this->createproduct();

        $this->postJson(route('api.v1.admin.products.properties.save',
            $product->id), $this->makeProductPropertiesData())
            ->assertStatus(401);
    }

    public function test_user_can_not_save_product_properties()
    {
        $this->actAsUser($this->createUser());

        $product = $this->createproduct();

        $this->postJson(route('api.v1.admin.products.properties.save',
            $product->id), $this->makeProductPropertiesData())
            ->assertStatus(403);
    }

    /* end tests for admin save_product_properties */

    /* start helper functions */

    private function makeProductPropertiesData(): array
    {
        $property_id1 = $this->createProperty()->id;
        $property_id2 = $this->createProperty()->id;
        $property_id3 = $this->createProperty()->id;
        $property_id4 = $this->createProperty()->id;
        $property_id5 = $this->createProperty()->id;

        return [
            'data' => [
                ['property_id' => $property_id1],
                ['property_id' => $property_id2],
                ['property_id' => $property_id3],
                ['property_id' => $property_id4],
                ['property_id' => $property_id5]
            ]
        ];
    }

    private function productData(): array
    {
        return [
            'name' => 'test',
            'slug' => 'test',
            'price' => '1000',
            'discount' => '20',
            'description' => 'this is final test'
        ];
    }

    private function createAdmin(): Model|Builder|null
    {
        $this->seed(UserSeeder::class);

        return User::query()
            ->where('role', '=', UserRoleEnum::ADMIN->value)
            ->first();
    }

    private function createUser()
    {
        return User::factory()->create();
    }

    private function actAsAdmin($admin)
    {
        $this->actingAs($admin);
    }

    private function actAsUser($user)
    {
        $this->actingAs($user);
    }

    private function createProperty()
    {
        return Property::factory()->create();
    }

    private function createProduct()
    {
        return Product::factory()->create();
    }

    /* end helper functions */
}
