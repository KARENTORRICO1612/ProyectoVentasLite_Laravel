<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads; //trait
use Livewire\WithPagination;

class CategoriesController extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $name, $search, $image, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorías';
    }

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) >0)
        $data = Category::where('name','like','%' .$this->search . '%')->paginate($this->pagination);
        else
        $data = Category::orderBy('id','desc')->paginate($this->pagination);
        
        return view('livewire.category.categories',['categories'=> $data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id){
        $record = Category::find($id);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal','show modal!');
    }


    public function Store(){
        $rules = [
            'name' => 'required|unique:categories|min:3'
        ];

        $messages = [
            'name.required' => 'Nombre de la categoria es requerido',
            'name.unique' => 'Ya existe la categoría',
            'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres'
        ];

        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name
        ]);

        $customFileName;
        if($this->image){
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/categorias',$customFileName);
            $category->image = $customFileName;
            $category->save();
        }
        $this->resetUI();
        $this->emit('category-added','Categoría Registrada');
    }

    public function Update(){
        $rules = [
            'name' => "required|min:3|unique:categories,name,{$this->selected_id}"
        ];
        $messages=[
            'name.required' => 'Nombre de la categoria es requerido',
            'name.min' => 'El nombre de la categoria debe tener al menos 3 caracteres',
            'name.unique' => 'El nombre de la categoria ya existe'
        ];

        $this->validate($rules, $messages);

        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name
        ]);

        if($this->image){
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/categorias',$customFileName);
            $imageName = $category->image;

            $category->image = $customFileName;
            $category->save();

            if($imageName !=null){
                if(file_exists('storage/categorias'.$imageName)){
                    unlink('storage/categorias'.$imageName);
                }
            }
        }
        $this->resetUI();
        $this->emit('category-updates','Categoria actualizada');
    }


    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function resetUI(){
        $this->name = '';
        $this->image = null;
        $this->search='';
        $this->selected_id = 0;
    }

    public function Destroy(Category $category){
       // $category = Category::find($id);
        //dd(category)
        $imageName = $category->image; //imagen temporal
        $category->delete();

        if($imageName !=null){
            unlink('storage/categorias/'.$imageName);
        }
        $this->resetUI();
        $this->emit('category-deleted','Categoria eliminada');
    }
}
