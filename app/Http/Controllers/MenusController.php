<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Menu;
class MenusController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(7);
        return view('Menus.Menus', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $errors = array();
        return view('Menus.Create', compact('errors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = \Auth::user()->id;
        $errors = array();

        if(isset($input['title'])){
            if(empty($input['title'])){
                $errors[0] = "Please Insert Menu Title";
            }
        } else {
            $errors[0] = "Please Insert Menu Title";
        }

        if(isset($input['type'])){
            if($input['type'] == -1){
                $errors[1] = "Please Select Menu Type";
            }
        } else {
            $errors[1] = "Please Select Menu Type";
        }

        if(isset($input['status'])){
            if($input['status'] == -1){
                $errors[2] = "Please Select Menu Status";
            }
        } else {
            $errors[2] = "Please Select Menu Status";
        }

        if(isset($input['description'])){
            if(empty($input['description'])){
                $errors[3] = "Please Insert Menu Description";
            }
        } else {
            $errors[3] = "Please Insert Menu Description";
        }

        if(isset($input['image'])){
            $input['image'] = $this->upload($input['image']);
        } else {
            $input['image'] = 'images/06.jpg';
        }

        if(empty($errors)){
            Menu::create($input);
            $menus = Menu::paginate(7);
            \Session::flash('added_menu_success', 'Your Menu Added Successfully');
            return view('Menus.Menus', compact('menus'));
        } else {
            return view('Menus.create', compact('errors'));
        }

    }

    public function upload($file) {
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s').$sha1.".".$extension;
        $path = public_path('images/');
        $file->move($path, $filename);
        return 'images/'.$filename;   
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id)->delete();
        \Session::flash('deleted_menu_success', 'Your Menu Deleted Successfully');
        return redirect()->back();
    }
}
