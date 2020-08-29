<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Create New User
     *
     * @param array
     */
    public function create(array $post_data);

    /**
     * Updates User by ID
     *
     * @param int
     * @param array
     */
    public function update($id, array $post_data);

    /**
     * Delete a Single User by ID
     *
     * @param int
     */
    public function delete($id);

    /**
     * Delete Multiple Users
     *
     * @param array
     */
    public function deleteMultiple(array $ids);

    /**
     * Get User by it's ID
     *
     * @param int
     */
    public function get($id);

    /**
     * Get Multiple User by array of IDs
     *
     * @param int
     */
    public function getMultiple(array $ids);

    /**
     * Get all Users
     *
     * @return mixed
     */
    public function all();    
}