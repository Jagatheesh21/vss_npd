<div>
@livewire('parent-child',[
    'parentModelName' => 'App\\Models\\Categories',
    'parentLabel' => 'Category',
    'parentInputName'=> 'category_id',
    'childModelName' => 'App\\Models\\Type',
    'childInputName'=>'Type',
    'relationshipFieldName' => 'category_id'
])
</div>