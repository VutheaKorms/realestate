<?php

namespace App\Http\Controllers;
use App\Models\Village;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class VillagesController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status) {
        $villages = Village::where('status', $status)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();
        return response($villages);
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $villages = Village::with('communities')->where("name", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $villages = Village::with('communities')->paginate(5);
        }
        return response($villages);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $item = Village::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = Village::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'community_id' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        Village::where("id",$id)->update($input);
        $item = Village::find($id);
        return response($item);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'community_id' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $create = Village::create($input);
        return response($create);
    }

    public function destroy($id)
    {
        return Village::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        try{
            $villages= Village::findOrFail($id);
            $villages->status = $request[0];
            $villages->updated_at = $request['$updated_at'];
            $villages->save();
            return response($villages);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }
}
