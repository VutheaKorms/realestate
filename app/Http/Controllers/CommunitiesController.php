<?php

namespace App\Http\Controllers;
use App\Models\Community;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class CommunitiesController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status) {
        $communities = Community::where('status', $status)
            ->orderBy('name', 'desc')
            ->take(10)
            ->get();
        return response($communities);
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $communities = Community::with('locations')->where("name", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $communities = Community::with('locations')->paginate(5);
        }
        return response($communities);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $item = Community::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = Community::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'location_id' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        Community::where("id",$id)->update($input);
        $item = Community::find($id);
        return response($item);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:posts|max:50',
            'location_id' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $create = Community::create($input);
        return response($create);
    }

    public function destroy($id)
    {
        return Community::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        try{
            $communities= Community::findOrFail($id);
            $communities->status = $request[0];
            $communities->updated_at = $request['$updated_at'];
            $communities->save();
            return response($communities);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }
}
