<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Requests\BookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

class BookController extends CrudController
{
    use ListOperation, ShowOperation, CreateOperation, UpdateOperation, DeleteOperation;

    public function setup()
    {
        $this->crud->setModel(Book::class);
        $this->crud->setRoute("admin/books");
        $this->crud->setEntityNameStrings('Book', 'Books');
    }

    public function setupListOperation()
    {
        $this->crud->setColumns(['id', 'name', 'price', 'authorsName']);
    }

    public function setupCreateOperation()
    {
        $this->crud->setValidation(BookRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => "Name"
        ]);
        $this->crud->addField([
            'name' => 'price',
            'type' => 'text',
            'label' => "Price"
        ]);
        $this->crud->addField([
                'label'     => "Authors",
                'type'      => 'select_multiple',
                'name'      => 'authors', // the method that defines the relationship in your Model

                // optional
                'entity'    => 'authors', // the method that defines the relationship in your Model
                'model'     => "App\Author", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot'     => true, // on create&update, do you need to add/delete pivot table entries?

                // also optional
                'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
    }

    public function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
