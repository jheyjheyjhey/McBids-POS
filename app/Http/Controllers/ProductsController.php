<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckIfAdmin;
use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
        try{
            $post = new Products();
            $post->name         = $request->name;
            $post->description  = $request->description;
            $post->price        = $request->price;
            $post->photo        = base64_encode($request->name);
            $post->stock        = 100;
            $post->save();

            return response(array(
                'success'           =>  true,
                'last_insert_id'    =>  $post->id
            ));
        }
        catch (\Exception $e){
            return response(array(
                'success'   =>  false,
                'error'     =>  $e->getMessage()
            ));
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
            $products::find($id)->delete();
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
