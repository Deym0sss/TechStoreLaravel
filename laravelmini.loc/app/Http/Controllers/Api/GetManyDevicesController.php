<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Http\Controllers\Controller;


class GetManyDevicesController extends Controller
{
    
    public function index()
    {
     
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        try {
            $ids = explode(',', $id);
            $devices = Device::whereIn('id', $ids)->get();

            return response()->json($devices);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], 500);
        
        }
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
