<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\DeviceInfo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class DeviceController extends Controller
{
    public function store(Request $request)
    {
        try {
       
            $data = $request->all();
            
      
            if (isset($data['img'])) {
         
                $imgData = explode(',', $data['img']);
                $imgEncoded = end($imgData);
                $imgDecoded = base64_decode($imgEncoded);
       
                $fileName = uniqid() . '.jpg';
        
                Storage::disk('public')->put( $fileName, $imgDecoded);

                $data['img'] = $fileName;
            }
            
        
            $device = Device::create($data);
            
        
            if (isset($data['info'])) {
                $info = json_decode($data['info']);
                foreach ($info as $i) {
                    DeviceInfo::create([
                        'title' => $i->title,
                        'description' => $i->description,
                        'device_id' => $device->id,
                    ]);
                }
            }
            
            return response()->json($device);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function index(Request $request)
{
    try {
        $brandId = $request->input('brandId');
        $typeId = $request->input('typeId');
        $limit = $request->input('limit', 10);
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $limit;

        $query = Device::query();

        if ($brandId && !$typeId) {
            $query->where('brand_id', $brandId);
        }

        if (!$brandId && $typeId) {
            $query->where('type_id', $typeId);
        }

        if ($brandId && $typeId) {
            $query->where('brand_id', $brandId)
                ->where('type_id', $typeId);
        }

        $devices = $query->get();

        $totalCount = $query->count();

        return response()->json([
            'totalCount' => $totalCount,
            'devices' => $devices,
        ]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Unspecified error'], 400);
    }
}

public function show($id)
{
    try {
  
        $device = Device::find($id);
        $deviceInfo = DeviceInfo::where('device_id', $id)->get();

        if (!$device) {
            return response()->json(['error' => 'Device not found.'], 404);
        }

        return response()->json(['device' => $device, 'deviceInfo' => $deviceInfo]);
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return response()->json(['error' => 'An error occurred while fetching the device data.'], 500);
    }
}

 

    public function destroy($id)
    {
        try {
            $deviceToDelete = Device::destroy($id);
            return response()->json($deviceToDelete);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'An error occurred.'], 500);
        
        }
    }
}
