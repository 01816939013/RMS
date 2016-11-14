<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Menu;
use Session;
class ItemsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $items = Item::paginate(7);
        return view('Items.Items', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $menus = Menu::pluck('title', 'id');
        $errors = array();
        return view('Items.Create', compact('menus', 'errors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input = $request->all();
        $input['user_id'] = \Auth::user()->id;
        $errors = array();

        if (isset($input['title'])) {
            if (empty($input['title'])) {
                $errors[0] = "Please Insert Item Title";
            }
        } else {
            $errors[0] = "Please Insert Item Title";
        }

        if (isset($input['menu_id'])) {
            if ($input['menu_id'] == -1) {
                $errors[1] = "Please Select Item Menu";
            }
        } else {
            $errors[1] = "Please Select Item Menu";
        }

        if (isset($input['status'])) {
            if ($input['status'] == -1) {
                $errors[2] = "Please Select Item Status";
            }
        } else {
            $errors[2] = "Please Select Item Status";
        }

        if (isset($input['description'])) {
            if (empty($input['description'])) {
                $errors[3] = "Please Insert Item Description";
            }
        } else {
            $errors[3] = "Please Insert Item Description";
        }

        if (isset($input['price'])) {
            if (empty($input['price'])) {
                $errors[4] = "Please Insert Item Price";
            }
        } else {
            $errors[4] = "Please Insert Item Price";
        }

        if (isset($input['image'])) {
            $input['image'] = $this->upload($input['image']);
        } else {
            $input['image'] = 'images/06.jpg';
        }

        if (empty($errors)) {
            try{
                Item::create($input);
                $items = Item::paginate(7);
                // \Session::flash('added_item_success', 'Your Item Added Successfully');
                //session()->flash('success_message', 'Your Item Added Successfully');
                flash('Your Item Added Successfully');
                return redirect('/Items');
            } catch(\Exception $e) {
                session()->flash('error_message', 'Added Item Exception '.$e->getMessage());
            }
        } else {
            $menus = Menu::pluck('title', 'id');
            return view('Items.create', compact('errors', 'menus'));
        }
    }

    public function upload($file) {
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s') . $sha1 . "." . $extension;
        $path = public_path('images/');
        $file->move($path, $filename);
        return 'images/' . $filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $item = Item::findOrFail($id);
        $errors = array();
        $menus = Menu::pluck('title', 'id');
        return view('Items.Edit', compact('item', 'errors', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input = $request->all();
        $input['user_id'] = \Auth::user()->id;
        $item = Item::findOrFail($id);
        $errors = array();

        if (isset($input['title'])) {
            if (empty($input['title'])) {
                $errors[0] = "Please Insert Item Title";
            }
        } else {
            $errors[0] = "Please Insert Item Title";
        }

        if (isset($input['menu_id'])) {
            if ($input['menu_id'] == -1) {
                $errors[1] = "Please Select Item Menu";
            }
        } else {
            $errors[1] = "Please Select Item Menu";
        }

        if (isset($input['status'])) {
            if ($input['status'] == -1) {
                $errors[2] = "Please Select Item Status";
            }
        } else {
            $errors[2] = "Please Select Item Status";
        }

        if (isset($input['description'])) {
            if (empty($input['description'])) {
                $errors[3] = "Please Insert Item Description";
            }
        } else {
            $errors[3] = "Please Insert Item Description";
        }

        if (isset($input['price'])) {
            if (empty($input['price'])) {
                $errors[4] = "Please Insert Item Price";
            }
        } else {
            $errors[4] = "Please Insert Item Price";
        }

        if (isset($input['image'])) {
            $input['image'] = $this->upload($input['image']);
        }

        if (empty($errors)) {
            $item->update($input);
            $items = Item::paginate(7);
            // \Session::flash('updated_item_success', 'Your Item Updated Successfully');
            //session()->flash('success_message', 'Your Item Updated Successfully');
            flash()->success('Your Item Updated Successfully');
            return redirect('/Items');
        } else {
            $menus = Menu::pluck('title', 'id');
            return view('Items.Edit', compact('errors', 'menus', 'item'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            Item::findOrFail($id)->delete();
            // \Session::flash('deleted_item_success', 'Your Item Deleted Successfully');
            //session()->flash('success_message', 'Your Item Deleted Successfully');
            flash()->success('Your Item Deleted Successfully');
        } catch (\Exception $e) {
            //\Session::flash('deleted_item_faild', 'Your Item Deleted Faild ' . $e->getMessage());
            //session()->flash('error_message', 'Your Item Deleted Faild ' . $e->getMessage());
            flash()->error('Your Item Deleted Exception '.$e->getMessage());
        }

        return redirect()->back();
    }

}
