<?php

namespace App\Http\Controllers\Admin;

use App\Author;
use App\Http\Requests\AuthorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

class AuthorController extends CrudController
{
    use ListOperation, ShowOperation, CreateOperation, UpdateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Author::class);
        $this->crud->setRoute("admin/authors");
        $this->crud->setEntityNameStrings('Author', 'Authors');
    }

    public function setupListOperation()
    {
        $this->crud->setColumns(['name']);
    }

    public function setupCreateOperation()
    {
        $this->crud->setValidation(AuthorRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Name"
        ]);
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
