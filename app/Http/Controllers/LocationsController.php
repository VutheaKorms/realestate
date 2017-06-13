<?php

namespace App\Http\Controllers;
use App\Models\Location;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status) {
        $locations = Location::where('status', $status)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();
        return response($locations);
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $locations = Location::where("name", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $locations = Location::paginate(5);
        }
        return response($locations);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $item = Location::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = Location::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'status' => 'required',
        ]);

        $input = $request->all();
        Location::where("id",$id)->update($input);
        $item = Location::find($id);
        return response($item);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'status' => 'required',
        ]);

        $input = $request->all();
        $create = Location::create($input);
        return response($create);
    }

    public function destroy($id)
    {
        return Location::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        try{
            $locations= Location::findOrFail($id);
            $locations->status = $request[0];
            $locations->updated_at = $request['$updated_at'];
            $locations->save();
            return response($locations);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }
}
