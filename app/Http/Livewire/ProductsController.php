<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductsController extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $name,$bardcode,$cost,$price,$stock,$alerts,$categoryid,$search,$image,$selected_id,$pageTitle,$componentName;
    private $pagination = 4;

    public function paginationView(){
        return 'vendor.livewire.bootstrap';
    }
    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Productos';
        $this->categoryid = 'Elegir';
    }

    public function render()
    {
        if(strlen($this->search)>0)
            $products = Product::join('categories as c','c.id','products.category_id')
            ->select('products.*','c.name as category')
            ->where('products.name','like','%'.$this->search.'%')
            ->orWhere('products.bardcode','like','%'.$this->search.'%')
            ->orWhere('c.name','like','%'.$this->search.'%')
            ->orderBy('products.name','asc')
            ->paginate($this->pagination);
        else
            $products = Product::join('categories as c','c.id','products.category_id')
            ->select('products.*','c.name as category')
            ->orderBy('products.name','asc')
            ->paginate($this->pagination);

        return view('livewire.products.component', [
            'data' => $products,
            'categories' => Category::orderBy('name','asc')->get()
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Store(){
        $rules = [
            'name' => 'required|unique:products|min:3',
            'cost' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'categoryid' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'Nombre de producto requerido',
            'name.unique' => 'Ya existe el nombre del producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'cost.required' => 'El costo es requerido',
            'price.required' => 'El precio es requerido',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'Ingresa el valor minimo en existencias',
            'categoryid.not_in' => 'Elige el nombre de la categoría diferente de Elegir',
        ];
        $this->validate($rules,$messages);

        $product = Product::create([
            'name' => $this->name,
            'cost' => $this->cost,
            'price' =>$this->price,
            'bardcode'=>$this->bardcode,
            'stock' =>$this->stock,
            'alerts'=> $this->alerts,
            'category_id' => $this->categoryid
        ]);
       

        if($this->image){
            
            $customFileName = uniqid().'_.'.$this->image->extension();
            $this->image->storeAs('public/products',$customFileName); 
            $product->image = $customFileName;
            $product->save();
        }

        $this->resetUI();
        $this->emit('product-added','Producto Registrado');
    }


    public function Edit(Product $product){
        $this->selected_id=$product->id;
        $this->name = $product->name;   
        $this->bardcode=$product->bardcode;
        $this->cost = $product->cost;
        $this->price=$product->price;
        $this->stock = $product->stock;
        $this->alerts= $product->alerts;
        $this->categoryid = $product->category_id;
        $this->image=null;

        $this->emit('modal-show','Show modal');
    }

    public function Update(){
        $rules = [
            'name' => "required|min:3|unique:products,name,{$this->selected_id}",
            'cost' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'alerts' => 'required',
            'categoryid' => 'required|not_in:Elegir'
        ];

        $messages = [
            'name.required' => 'Nombre de producto requerido',
            'name.unique' => 'Ya existe el nombre del producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'cost.required' => 'El costo es requerido',
            'price.required' => 'El precio es requerido',
            'stock.required' => 'El stock es requerido',
            'alerts.required' => 'Ingresa el valor minimo en existencias',
            'categoryid.not_in' => 'Elige el nombre de la categoría diferente de Elegir',
        ];
        $this->validate($rules,$messages);

        $product = Product::find($this->selected_id);

        $product->update([
            'name' => $this->name,
            'cost' => $this->cost,
            'price' =>$this->price,
            'bardcode'=>$this->bardcode,
            'stock' =>$this->stock,
            'alerts'=> $this->alerts,
            'category_id' => $this->categoryid
        ]);

        if($this->image){
            $customFileName = uniqid().'_.'.$this->image->extension();

            $this->image->storeAs('public/products/',$customFileName);  
            $imageTemp = $product->image; //Imagen temporal
            $product->image = $customFileName;
            $product->save();

            if($imageTemp !=null){
                if(file_exists('public/products/'.$imageTemp)){
                    unlink('public/products/'.$imageTemp);
                }
            }
        }

        $this->resetUI();
        $this->emit('product-updated','Producto Actualizado');
    }

    public function resetUI(){
        $this->name = '';
        $this->bardcode = '';
        $this->cost = '';   
        $this->price = '';
        $this->stock = '';
        $this->alerts = '';
        $this->search = '';
        $this->categoryid = 'Elegir';
        $this->image = null;
        $this->selected_id = 0;
    }

    protected $listeners = ['deleteRow' => 'Destroy'];

    public function Destroy(Product $product){
        $imageTemp = $product->image;
        $product->delete();

        if($imageTemp != null){
            if(file_exists('public/products'.$imageTemp)){
                unlink('public/products'.$imageTemp);
            }
        }
        $this->resetUI();
        $this->emit('product-deleted','Producto Eliminado');
    }
}
