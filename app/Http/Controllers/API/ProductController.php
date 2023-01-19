<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = Product::with('category')->get();

            return response([
                "status"    => 200,
                "data"      => $result,
                "message"   => 'Data Terkirim'
            ], 200);
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response([
                "status"    => 200,
                "data"      => $result,
                "message"   => 'Data Tersimpan'
            ], 200);
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = Product::where('id', $id)->with('category')->first();
            if(!$result){
                return response([
                    "status" => 400,
                    "message"=> 'Data tidak ditemukan!',
                ],400);
            }
            return response([
                "status"    => 200,
                "data"      => $result,
                "message"   => 'Data Terkirim'
            ], 200);
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = Product::find($id)->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response([
                "status"    => 200,
                "data"      => $result,
                "message"   => 'Data Terubah'
            ], 200);
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            date_default_timezone_set("Asia/Jakarta");

            $result = Product::find($id);
            if(!$result){
                return response([
                    "status"=> 400,
                    "message"   => 'Data Tidak ditemukan'
                ], 400);
            }

            $result->delete();

            return response([
                "status"=> 200,
                "message"   => 'Data Terhapus'
            ], 200);
        } catch (Exception $e) {
            return response([
                "status" => 400,
                "message"=> $e->getMessage(),
            ]);
        }
    }
}
