<?php

use Illuminate\Support\Facades\Input;
use Vinelab\NeoEloquent\Tests\Functional\Relations\HyperMorphTo\Post;
use Illuminate\Http\Response;

class ProductController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $post = new stdClass();

        $post->companyHash      = Input::get('companyHash');
        $post->productId        = Input::get('productId');
        $post->productPrice     = Input::get('productPrice');
        $post->productImg       = Input::get('productImg');
        $post->productStatus    = Input::get('productStatus');

        $setProductNeo4j = new SetProduct();

        if($post->companyHash AND $post->productId AND $post->productPrice AND $post->productImg AND $post->productStatus > null){

            return json_encode($setProductNeo4j->createProduct($post));
        }

        return (new Response(json_encode(array('error' => 'campos obrigatorios nao preenchidos!')), 400))
            ->header('Content-Type', 400);

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
     * @param  int  $companyHash
	 * @return Response
	 */
	public function show($companyHash,$id)
	{

        $indication = new GetIndication();

        return $indication->indication($companyHash,$id);

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $post = new stdClass();

        $post->companyHash      = Input::get('companyHash');
        $post->productId        = Input::get('productId');
        $post->productPrice     = Input::get('productPrice');
        $post->productImg       = Input::get('productImg');
        $post->productStatus    = Input::get('productStatus');

        $setProductNeo4j = new SetProduct();
        $setProductNeo4j->updateProduct($post);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
