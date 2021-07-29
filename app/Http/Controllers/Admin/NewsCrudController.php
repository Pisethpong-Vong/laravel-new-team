<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NewsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NewsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NewsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\News::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/news');
        CRUD::setEntityNameStrings('news', 'news');
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
        $this->crud->addColumns([
            [
                'name' => 'id',
                'type' => 'text',
                'label' => 'ID', 
            ],
            [
                'name' => 'image',
                'type' => 'image',
                'label' => 'Image',
                'width' => '70px',
                'height' => '70px', 
            ],
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Title', 
            ],
            [
                'name' => 'category',
                'type' => 'text',
                'label' => 'Category', 
            ],
            [
                'name' => 'status',
                'type' => 'text',
                'label' => 'Status', 
            ],
            [
                'name' => 'format',
                'type' => 'text',
                'label' => 'Format', 
            ],
            [
                'name' => 'publish_at',
                'type' => 'text',
                'label' => 'Publish at', 
            ],
            [
                'name' => 'expired_date',
                'type' => 'text',
                'label' => 'Expired Date', 
            ],
            [
                'name' => 'source',
                'type' => 'text',
                'label' => 'Source', 
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
    protected function setupCreateOperation()
    {
        CRUD::setValidation(NewsRequest::class);

        // CRUD::setFromDb(); // fields
        $this->crud->addFields([
            [
                'name' => 'title',
                'type' => 'text',
                'label' => 'Title',
                'tab' => 'English',
            ],
            [
                'name' => 'format',
                'label' => "Format",
                'type' => 'select2_from_array',
                'options' => ['News' => 'News', 'two' => 'Ads'],
                'allows_null' => false,
                'default' => 'News',
                'tab' => 'English',
            ],
            [
                'name' => 'status',
                'type' => 'select2_from_array',
                'options' => ['Pending Review'=>'Pending Review', 'Draft'=>'Draft', 'Approve'=>'Approve'],
                'allows_null' => false,
                'default' => 'Pending Review',
                'label' => 'Status',
                'tab' => 'English',
            ],
            [
                'name' => 'publish_at',
                'type' => 'datetime',
                'label' => 'Publish at',
                'tab' => 'English',
            ],
            [
                'name' => 'expired_date',
                'type' => 'date',
                'label' => 'Expired Date',
                'tab' => 'English',
            ],
            [
                'name' => 'category',
                'type' => 'select2_from_array',
                'options' =>[
                                'Hots News'=>'Hots News',
                                'Funny News'=>'Funny News', 
                                'Society News'=>'Society News',
                                'Sports News'=>'Sports News',
                                'Covid News'=>'Covid News',
                            ],
                'allows_null' => false,
                'default' => 'one',
                'label' => 'Category',
                'tab' => 'English',
            ],
            [
                'name' => 'ref_link',
                'type' => 'text',
                'label' => 'Ref Link',
                'tab' => 'English',
            ],
            [
                'name' => 'source',
                'type' => 'text',
                'label' => 'Source',
                'tab' => 'English',
            ],
            [
                'name' => 'image',
                'type' => 'image',
                'label' => 'Image',
                'tab' => 'English',
            ],
            [
                'name' => 'description',
                'type' => 'ckeditor',
                'label' => 'Description',
                'tab' => 'English',
            ],
            [
                'name' => 'title_kh',
                'type' => 'text',
                'label' => 'Title Khmer',
                'tab' => 'Khmer',
            ],
            [
                'name' => 'source_kh',
                'type' => 'text',
                'label' => 'Source Khmer',
                'tab' => 'Khmer',
            ],
            [
                'name' => 'description_kh',
                'type' => 'ckeditor',
                'label' => 'Description Khmer',
                'tab' => 'Khmer',
            ],
            [
                'name' => 'title_th',
                'type' => 'text',
                'label' => 'Title Thai',
                'tab' => 'Thai',
            ],
            [
                'name' => 'source_th',
                'type' => 'text',
                'label' => 'Source Thai',
                'tab' => 'Thai',
            ],
            [
                'name' => 'description_th',
                'type' => 'ckeditor',
                'label' => 'Description Thai',
                'tab' => 'Thai',
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
}
