<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ContactRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ContactCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ContactCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Contact::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/contact');
        CRUD::setEntityNameStrings('contact', 'contacts');
        $this->setPermission();
        $this->crud->enableExportButtons();
        // $this->crud->enableDetailsRow();
    }

    public function setPermission(){
        $contact = backpack_user();

        $this->crud->denyAccess([
            'list',
            'show',
            'create',
            'update',
            'delete',
        ]);

        if($contact->canContactList()){
            $this->crud->allowAccess('list');
        }
        if($contact->canContactCreate()){
            $this->crud->allowAccess('create');
        }
        if($contact->canContactshow()){
            $this->crud->allowAccess('show');
        }
        if($contact->canContactUpdate()){
            $this->crud->allowAccess('update');
        }
        if($contact->canContactDelete()){
            $this->crud->allowAccess('delete');
        }
    }
    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // columns
        $this->crud->addFilter(
            [
                'type'  => 'text',
                'name'  => 'phone',
                'label' => 'Phone',
            ]
        );
        $this->crud->addFilter([
                'name' => 'id',
                'type' => 'text',
                'label' => 'Search ID',
        ]);
        $this->crud->addColumns([
            [
                'name' => 'id',
                'type' => 'text',
                'label' => 'ID',
            ],
            [
                'name' => 'profile',
                'type' => 'image',
                'label' => 'Profile',
                'width' => '70px',
                'height' => '70px',
                // 'prefix' => '',
            ],
            [
                'name' => 'combindname',
                'type' => 'text',
                'label' => 'Name',
            ],
            [
                'name' => 'phone',
                'type' => 'text',
                'label' => 'Mobile Phone',
            ],
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
            ],
            [
                'name' => 'address',
                'type' => 'address',
                'label' => 'Address',
            ],
            [
                'name' => 'date_of_birth',
                'type' => 'date',
                'label' => 'Date of Birth',
            ],
        ]);
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    private function titleHeads($text,$class='mt-3')
    {
        return '<nav class="navbar navbar-light bg-light '.$class.'">
        <span class="navbar-brand mb-0 h4">'.$text.'</span>
        </nav>';
    }
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ContactRequest::class);

        $this->crud->addField([
            'name' => 'descr',
            'type' => 'custom_html',
            'label' => 'text',
            'value' => $this->titleHeads('Account Information'),
            'tab' => 'Contact Info',
        ]);
        // CRUD::setFromDb(); // fields
        $this->crud->addFields([
            [
                'name' => 'first_name',
                'type' => 'text',
                'label' => 'First Name',
                'wrapper' => ['class'=>'col-md-6 form-group'],
                'tab' => 'Contact Info',
            ], 
            [
                'name' => 'last_name',
                'type' => 'text',
                'label' => 'Last Name',
                'wrapper' => ['class'=>'col-md-6 form-group'],
                'tab' => 'Contact Info',
            ], 
            [
                'name' => 'phone',
                'type' => 'text',
                'label' => 'Phone',
                'wrapper' => ['class'=>'col-md-6 form-group'],
                'tab' => 'Contact Info',
            ], 
            [
                'name' => 'email',
                'type' => 'email',
                'label' => 'Email',
                'wrapper' => ['class'=>'col-md-6 form-group'],
                'tab' => 'Contact Info',
            ], 
            [
                'name' => 'address',
                'type' => 'address',
                'label' => 'Address',
                'wrapper' => ['class'=>'col-md-6 form-group'],
                'tab' => 'Contact Info',
            ], 
            [
                'name' => 'date_of_birth',
                'type' => 'date',
                'label' => 'Date of Birth',
                'wrapper' => ['class'=>'col-md-6 form-group'],
                'tab' => 'Contact Info',
            ], 
            [
                'name' => 'profile',
                'type' => 'image',
                'label' => 'Profile',
                'wrapper' => ['class'=>'col-md-6 form-group'],
                'tab' => 'Contact Info',
            ],
            [
                'name' => 'des',
                'type' => 'custom_html',
                'label' => 'text',
                'value' => $this->titleHeads('Description'),
                'tab' => 'Contact Info',
            ],
            [
                'name' => 'description',
                'type' => 'ckeditor',
                'label' => 'Description',
                'wrapper' => ['class'=>'col-md-12 form-group'],
                'tab' => 'Contact Info',
            ], 
            [
                'name' => 'identity_card',
                'type' => 'text',
                'label' => 'Identity Card',
                'wrapper' => ['class'=>'col-md-12 form-group'],
                'tab' => 'Other',
            ],
            [
                'name' => 'identity_card_photo',
                'type' => 'image',
                'label' => 'Identity Card Photo',
                'wrapper' => ['class'=>'col-md-12 form-group'],
                'tab' => 'Other',
            ],
            [
                'name' => 'occupation',
                'type' => 'text',
                'label' => 'Occupation',
                'wrapper' => ['class'=>'col-md-12 form-group'],
                'tab' => 'Other',
            ],
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }
    
    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    // public function index()
    // {
    // $uusers = User::all();
    //     $users = $this->userRepository->all();
    // }
}
