<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function getAllActive($status) {
        $customers = Customer::where('status', $status)
            ->orderBy('first_name', 'desc')
            ->take(10)
            ->get();
        return response($customers);
    }

    public function index(Request $request)
    {
        $input = $request->all();
        if($request->get('search')){
            $customers = Customer::with('locations')->where("name", "LIKE", "%{$request->get('search')}%")
                ->orWhere('created_at','LIKE',"%{$request->get('search')}%")
                ->paginate(5);
        }else{
            $customers = Customer::with('locations')->paginate(5);
        }
        return response($customers);
    }

    public function create()
    {

    }

    public function show($id)
    {
        $item = Customer::find($id);
        return response($item);
    }

    public function edit($id)
    {
        $item = Customer::find($id);
        return response($item);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|unique:posts|max:50',
            'last_name' => 'required|unique:posts|max:50',
            'location_id' => 'required',
            'community_id' => 'required',
            'village_id' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        Customer::where("id",$id)->update($input);
        $item = Customer::find($id);
        return response($item);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|unique:posts|max:50',
            'last_name' => 'required|unique:posts|max:50',
            'location_id' => 'required',
            'community_id' => 'required',
            'village_id' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $create = Customer::create($input);
        return response($create);
    }

    public function destroy($id)
    {
        return Customer::where('id',$id)->delete();
    }

    public  function disable(Request $request, $id) {
        try{
            $customers= Customer::findOrFail($id);
            $customers->status = $request[0];
            $customers->updated_at = $request['$updated_at'];
            $customers->save();
            return response($customers);
        }
        catch(ModelNotFoundException $err){
            //Show error page
        }
    }
}
