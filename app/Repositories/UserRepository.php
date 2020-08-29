<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Hash;
use App\User;

class UserRepository implements UserRepositoryInterface 
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Create New User
     *
     * @param array
     * @return User
    */
    public function create(array $attributes)
    {
        return $this->user->create($attributes);
    }    

    /**
     * Updates User by ID
     *
     * @param int, array
     * @return User
    */
    public function update($id, array $attributes)
    {
        return $this->user->find($id)->update($attributes);
    }

    /**
     * Delete a Single User by ID
     *
     * @param int
     * @return User
     */
    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }

    /**
     * Delete Multiple Users
     *
     * @param array
     * @return User
     */
    public function deleteMultiple($ids)
    {
        return $this->user->whereIn('id', $ids)->delete();
    }

    /**
     * Get User by it's ID
     *
     * @param int
     * @return User
     */
    public function get($id)
    {
        return $this->user->find($id);
    }

    /**
     * Get Multiple User by array of IDs
     *
     * @param int
     * @return User
     */
    public function getMultiple(array $ids)
    {
        return $this->user->whereIn('id', $ids)->get();
    }

    /**
     * Get all Users
     *
     * @return mixed
     */
    public function all()
    {
        return $this->user->paginate(10);
    }
}
