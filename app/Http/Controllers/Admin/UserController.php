<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // rwequest ajax dari library DataTables
        if(request()->ajax()){
            $query = User::query();
            // memberikan action edit dan hapus
            return datatables::of($query)->addColumn('action', function($item){
                return ' 
                    <div class="btn-group">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" data-toggle="dropdown">Aksi</button>
                            <div class="dropdown-menu">
                                <a href="' .route('user.edit', $item->id). '" class="dropdown-item">Sunting</a>
                                <form action="' .route('user.destroy',$item->id). '" method="POST">
                                    ' .method_field('delete'). csrf_field() . '
                                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div> 
                ';
            })->rawColumns(['action'])->make();
        }
        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrfail($id); // jika tidak ditemuakan akan ke 404
        return view('pages.admin.user.edit', compact('item'));
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
        $data = $request->all();
        $item = User::findOrFail($id);

        // membuat request pw jika pw diganti dan tidak
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $item->update($data);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}
