<?php

namespace App\Http\Controllers;
use App\Models\PropertyType;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class PropertyTypesController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status) {
        $propertyTypes = PropertyType::where('status', $status)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();
        return response($propertyTypes);
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $propertyTypes = PropertyType::where("name", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $propertyTypes = PropertyType::paginate(5);
        }
        return response($propertyTypes);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $item = PropertyType::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = PropertyType::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'status' => 'required',
        ]);

        $input = $request->all();
        PropertyType::where("id",$id)->update($input);
        $item = PropertyType::find($id);
        return response($item);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'status' => 'required',
        ]);

        $input = $request->all();
        $create = PropertyType::create($input);
        return response($create);
    }

    public function destroy($id)
    {
        return PropertyType::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        try{
            $propertyTypes= PropertyType::findOrFail($id);
            $propertyTypes->status = $request[0];
            $propertyTypes->updated_at = $request['$updated_at'];
            $propertyTypes->save();
            return response($propertyTypes);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }
}
