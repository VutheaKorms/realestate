<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Access\Response;
use App\Models\Type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status) {
        $brands = Type::where('status', $status)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();
        return response($brands);
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $types = Type::where("name", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $types = Type::paginate(5);
        }
        return response($types);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $item = Type::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = Type::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'status' => 'required',
        ]);

        $input = $request->all();
        Type::where("id",$id)->update($input);
        $item = Type::find($id);
        return response($item);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'status' => 'required',
        ]);

        $input = $request->all();
        $create = Type::create($input);
        return response($create);
    }

    public function destroy($id)
    {
        return Type::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        try{
            $type= Type::findOrFail($id);
            $type->status = $request[0];
            $type->updated_at = $request['$updated_at'];
            $type->save();
            return response($type);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }

}
