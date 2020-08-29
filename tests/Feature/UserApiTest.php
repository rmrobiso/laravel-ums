<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;

class UserApiTest extends TestCase
{
    use WithFaker;

    protected $user, $isAdmin, $data;

    public function setUp() :void {

        parent::setUp();

        $this->user = factory(User::class)->create();
        Passport::actingAs($this->user);
        $this->user->is_admin ? $this->isAdmin = true : $this->isAdmin = false;
        $this->data = [
            'first_name' => $this->faker->name, 
            'last_name' => $this->faker->name, 
            'address' => $this->faker->address, 
            'postal_code' => $this->faker->randomDigit, 
            'contact_number' => $this->faker->phoneNumber, 
            'username' => $this->faker->userName, 
            'is_admin' => $this->faker->boolean,
            'email' => $this->faker->safeEmail, 
            'password' => Hash::make($this->faker->password),
        ];
    }

    /**
     * Test to GET all the users
     * Route::get('users', 'UserController@index');
     *
     * @return void
     */
    public function testGetAllUser()
    {
        $response = $this->json('GET', "api/users");
        if($this->isAdmin) {
            $response
                ->assertStatus(200)
                ->assertJson([
                    'data' => true
                ]);
        } else {
            $response
                ->assertStatus(200)
                ->assertJson([
                     'error-message' => 'Unauthorized.'
                ]);
        }
        
    }

    /**
     * Test to GET single user by ID
     * Route::get('user/{id}', 'UserController@show');
     *
     * @return void
     */
    public function testGetUserByID()
    {
        $response = $this->json('GET', "api/user/".$this->user->id);
        if($this->isAdmin) {
            $response
                ->assertStatus(200)
                ->assertJson([
                    'data' => true
                ]);
        } else {
            $response
                ->assertStatus(200)
                ->assertJson([
                     'error-message' => 'Unauthorized.'
                ]);
        }
    }

    /**
     * Test to DELETE single user by ID
     * Route::delete('user/{id}', 'UserController@destroy');
     * 
     * @return void
     */
    public function testDeleteUserByID()
    {
        $response = $this->json('DELETE', "api/user/".$this->user->id);
        if($this->isAdmin) {
            $response
                ->assertStatus(200)
                ->assertJson([
                    'data' => true
                ]);
        } else {
            $response
                ->assertStatus(200)
                ->assertJson([
                     'error-message' => 'Unauthorized.'
                ]);
        }
    }

    /**
     * Test to DELETE mutiple users
     * Route::post('users/delete-multiple', 'UserController@deleteMultiple');
     * 
     * @return void
     */
    public function testDeleteMultiple()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $ids = [$user1->id, $user2->id];

        $response = $this->json('POST', "api/users/delete-multiple", ['ids' => $ids]);
        if($this->isAdmin) {
            $response
                ->assertStatus(200)
                ->assertJson([
                    'data' => true
                ]);
        } else {
            $response
                ->assertStatus(200)
                ->assertJson([
                     'error-message' => 'Unauthorized.'
                ]);
        }
    }

    /**
     * Test to POST single user ( create )
     * Route::post('user/', 'UserController@store');
     * 
     * @return void
     */
    public function testCreateNewUser()
    {
        $response = $this->json('POST', "api/user", $this->data);
        if($this->isAdmin) {
            $response
                ->assertStatus(200)
                ->assertJson([
                    'data' => true
                ]);
        } else {
            $response
                ->assertStatus(200)
                ->assertJson([
                     'error-message' => 'Unauthorized.'
                ]);
        }
    }

    /**
     * Test to PUT single user ( update )
     * Route::put('user/', 'UserController@store');
     * 
     * @return void
     */
    public function testUpdateUserByID()
    {
        $user = factory(User::class)->create();
        $param = $this->data;
        $param['id'] = $user->id;
        $response = $this->json('PUT', "api/user", $param);
        if($this->isAdmin) {
            $response
                ->assertStatus(200)
                ->assertJson([
                    'data' => true
                ]);
        } else {
            $response
                ->assertStatus(200)
                ->assertJson([
                     'error-message' => 'Unauthorized.'
                ]);
        }
    }
}
