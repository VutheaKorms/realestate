<?php

namespace App\Http\Controllers;
use App\Models\Property;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status) {
        $properties = Property::where('status', $status)
            ->orderBy('price', 'desc')
            ->take(10)
            ->get();
        return response($properties);
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $properties = Property::where("price", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $properties = Property::paginate(5);
        }
        return response($properties);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $item = Property::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = Property::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'price' => 'required',
            'room' => 'required',
            'category' => 'required',
            'bed-room' => 'required',
            'bath-room' => 'required',
            'size' => 'required',
            'location_id' => 'required',
            'community_id' => 'required',
            'village_id' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        Property::where("id",$id)->update($input);
        $item = Property::find($id);
        return response($item);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'price' => 'required',
            'room' => 'required',
            'category' => 'required',
            'bed-room' => 'required',
            'bath-room' => 'required',
            'size' => 'required',
            'location_id' => 'required',
            'community_id' => 'required',
            'village_id' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $create = Property::create($input);
        return response($create);
    }

    public function destroy($id)
    {
        return Property::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        try{
            $properties= Property::findOrFail($id);
            $properties->status = $request[0];
            $properties->updated_at = $request['$updated_at'];
            $properties->save();
            return response($properties);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }
}
