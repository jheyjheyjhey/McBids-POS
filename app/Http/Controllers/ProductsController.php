<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckIfAdmin;
use App\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware(CheckIfAdmin::class, ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          =>  'required',
            'price'         =>  'required',
            'description'   =>  'required',
            'photo'         =>  'required|image64:jpeg,jpg,png'
        ]);

        if ($validator->fails()) {
            return response(array(
                'success'   =>  false,
                'error'     =>  $validator->errors()
            ));
        }

        else {
            $image = file_get_contents($request->photo);
            $imageData = $request->get('photo');
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];

            $img = Image::make($image)->save(storage_path('images')."/".$fileName);

            try {
                $post = new Products();
                $post->name = $request->name;
                $post->description = $request->description;
                $post->price = $request->price;
                $post->photo = $fileName;
                $post->stock = 100;
                $post->save();

                return response(array(
                    'success' => true,
                    'last_insert_id' => $post->id
                ));
            } catch (\Exception $e) {
                return response(array(
                    'success' => false,
                    'error' => $e->getMessage()
                ));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        $data = $products::all();
        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products $products
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products, int $id)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $products)
    {
        $id = $request->id;

        $data = $products::find($id)->update(array(
            'name'          =>  $request->name,
            'description'   =>  $request->description,
            'price'         =>  $request->price
        ));

        return response(array('updated'=>true));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products $products
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $products, $id)
    {
        try{
            $data = $products::find($id);
            Storage::delete($data->photo);
            $data->delete();

            return response(array(
                'deleted' => true
            ));
        }
        catch (\Exception $e){
            return response(array(
                'deleted' => false,
                'error' => $e->getMessage()
            ));
        }
    }
}
