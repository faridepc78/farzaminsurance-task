<?php

namespace Api\V1\Admin\Property;

use App\Enums\UserRoleEnum;
use App\Models\Property;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    /* start tests for admin get_properties */

    public function test_admin_can_not_get_properties_without_login()
    {
        $this->createAdmin();

        $this->getJson(route('api.v1.admin.properties.index'), [])
            ->assertStatus(401);
    }

    public function test_user_can_not_get_properties()
    {
        $this->actAsAdmin($this->createUser());

        $this->getJson(route('api.v1.admin.properties.index'), [])
            ->assertStatus(403);
    }

    public function test_admin_can_get_properties()
    {
        $this->actAsAdmin($this->createAdmin());

        $this->getJson(route('api.v1.admin.properties.index'), [])
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);
    }

    /* end tests for admin get_properties */

    /* start tests for admin get_property */

    public function test_admin_can_not_get_property_without_login()
    {
        $this->createAdmin();

        $property = $this->createProperty();

        $this->getJson(route('api.v1.admin.properties.show',$property->id), [])
            ->assertStatus(401);
    }

    public function test_user_can_not_get_property()
    {
        $this->actAsAdmin($this->createUser());

        $property = $this->createProperty();

        $this->getJson(route('api.v1.admin.properties.show',$property->id), [])
            ->assertStatus(403);
    }

    public function test_admin_can_get_property()
    {
        $this->actAsAdmin($this->createAdmin());

        $property = $this->createProperty();

        $this->getJson(route('api.v1.admin.properties.show',$property->id), [])
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);
    }

    /* end tests for admin get_properties */

    /* start tests for admin create_property */

    public function test_admin_can_create_property()
    {
        $this->actAsAdmin($this->createAdmin());

        $this->postJson(route('api.v1.admin.properties.store'),
            $this->propertyData())
            ->assertSuccessful()
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);

        $this->assertEquals(1, Property::count());
    }

    public function test_admin_can_not_create_property_without_login()
    {
        $this->createAdmin();

        $this->postJson(route('api.v1.admin.properties.store'),
            $this->propertyData())
            ->assertStatus(401);
    }

    public function test_user_can_not_create_property()
    {
        $this->actAsUser($this->createUser());

        $this->postJson(route('api.v1.admin.properties.store'),
            $this->propertyData())
            ->assertStatus(403);
    }

    public function test_admin_can_not_create_property_because_name_is_required()
    {
        $this->actAsAdmin($this->createAdmin());

        $data = $this->propertyData();
        unset($data['name']);

        $this->postJson(route('api.v1.admin.properties.store'), $data)
            ->assertStatus(422);
    }

    /* end tests for admin create_property */


    /* start tests for admin update_property */

    public function test_admin_can_update_property()
    {
        $this->actAsAdmin($this->createAdmin());

        $property = $this->createProperty();

        $this->patchJson(route('api.v1.admin.properties.update', $property->id),
            $this->propertyData())
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);

        $this->assertEquals(1,
            Property::whereName($this->propertyData()['name'])->count());
    }

    public function test_admin_can_not_update_property_without_login()
    {
        $this->createadmin();

        $property = $this->createProperty();

        $this->patchJson(route('api.v1.admin.properties.update',
            $property->id), $this->propertyData())
            ->assertStatus(401);
    }

    public function test_user_can_not_update_property()
    {
        $this->actAsUser($this->createUser());

        $property = $this->createProperty();

        $this->patchJson(route('api.v1.admin.properties.update',
            $property->id), $this->propertyData())
            ->assertStatus(403);
    }

    /* end tests for admin update_property */

    /* start tests for admin delete_property */

    public function test_admin_can_delete_property()
    {
        $this->actAsAdmin($this->createAdmin());

        $property = $this->createProperty();

        $this->deleteJson(route('api.v1.admin.properties.destroy', $property->id),
            $this->propertyData())
            ->assertSuccessful()
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'code',
                'data'
            ]);

        $this->assertCount(0, Property::all());
    }

    public function test_admin_can_not_delete_property_without_login()
    {
        $this->createadmin();

        $property = $this->createProperty();

        $this->deleteJson(route('api.v1.admin.properties.destroy',
            $property->id), $this->propertyData())
            ->assertStatus(401);
    }

    public function test_user_can_not_delete_property()
    {
        $this->actAsUser($this->createUser());

        $property = $this->createProperty();

        $this->deleteJson(route('api.v1.admin.properties.destroy',
            $property->id), $this->propertyData())
            ->assertStatus(403);
    }

    /* end tests for admin delete_property */

    /* start helper functions */

    private function propertyData(): array
    {
        return [
            'name' => 'test',
            'value' => 'test'
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

    /* end helper functions */
}
