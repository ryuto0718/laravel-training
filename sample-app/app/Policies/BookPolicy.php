<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function viewAny(Admin $admin): bool
    {
        return true;
    }

    public function view(Admin $admin,Book $book): bool
    {
        return true;
    }

    public function create(Admin $admin): bool
    {
        return substr($admin->login_id,-11) === 'example.com';
    }

    public function update(Admin $admin, Book $book): bool
    {
        return $admin->id === $book->admin_id;
    }

    public function delete(Admin $admin, Book $book): bool
    {
        return $admin->id === $book->admin_id;
    }
}