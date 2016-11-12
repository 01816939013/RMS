<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meal;
use App\Menu;
use App\MealItem;
use App\Item;
class MealsController extends Controller
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
        $meals = Meal::paginate(7);
        return view('Meals.Meals', compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $errors = array();
        $menus = Menu::all();
        return view('Meals.Create', compact('errors', 'menus'));
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
                $errors[0] = "Please Insert Meal Title";
            }
        } else {
            $errors[0] = "Please Insert Meal Title";
        }


        if(isset($input['status'])){
            if($input['status'] == -1){
                $errors[1] = "Please Select Meal Status";
            }
        } else {
            $errors[1] = "Please Select Meal Status";
        }

        if(isset($input['description'])){
            if(empty($input['description'])){
                $errors[2] = "Please Insert Meal Description";
            }
        } else {
            $errors[2] = "Please Insert Meal Description";
        }

        if(isset($input['image'])){
            $input['image'] = $this->upload($input['image']);
        } else {
            $input['image'] = 'images/06.jpg';
        }

        if(empty($errors)){
            $menuPrice = 0;
            foreach ($input['items'] as $item) {
                $item = Item::findOrFail($item);
                $menuPrice += $item->price - ($item->price * ($input['discount-'.$item->id] / 100));
            }
            $input['price'] = $menuPrice;
            $meal = Meal::create($input);

            foreach ($input['items'] as $item) {
                MealItem::create(['meal_id'=>$meal->id, 'item_id'=>$item, 'discount'=>$input['discount-'.$item]]);
            }

            $meals = Meal::paginate(7);
            \Session::flash('added_meal_success', 'Your Meal Added Successfully');
            return redirect('/Meals');
        } else {
            return view('Meals.create', compact('errors'));
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
        $meal = Meal::findOrFail($id);
        $mealItems = MealItem::where('meal_id', $meal->id)->get();

        $itemsIDs = array();
        foreach ($mealItems as $mealItem) {
            $itemsIDs[] = $mealItem->item_id;
            $itemsDiscounts[$mealItem->item_id] = $mealItem->discount;
        }
        $menus = Menu::all();
        $errors = array();
        return view('Meals.Edit', compact('meal', 'errors', 'menus', 'itemsIDs', 'itemsDiscounts'));
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
        $input = $request->all();
        $input['user_id'] = \Auth::user()->id;
        $meal = Meal::findOrFail($id);
        $errors = array();

        if(isset($input['title'])){
            if(empty($input['title'])){
                $errors[0] = "Please Insert Meal Title";
            }
        } else {
            $errors[0] = "Please Insert Meal Title";
        }


        if(isset($input['status'])){
            if($input['status'] == -1){
                $errors[1] = "Please Select Meal Status";
            }
        } else {
            $errors[1] = "Please Select Meal Status";
        }

        if(isset($input['description'])){
            if(empty($input['description'])){
                $errors[2] = "Please Insert Meal Description";
            }
        } else {
            $errors[2] = "Please Insert Meal Description";
        }


        if(isset($input['image'])){
            $input['image'] = $this->upload($input['image']);
        }

        if(empty($errors)){
            $meal->update($input);
            MealItem::where('meal_id', $id)->delete();
            foreach ($input['items'] as $item) {
                MealItem::create(['meal_id'=>$id, 'item_id'=>$item, 'discount'=>$input['discount-'.$item]]);
            }
            $meals = Meal::paginate(7);
            \Session::flash('updated_meal_success', 'Your Meal Updated Successfully');
            return redirect('/Meals');
        } else {
            return view('Meals.Edit', compact('errors', 'meal'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $meal = Meal::findOrFail($id);
            MealItem::where('meal_id', $meal->id)->delete();
            $meal->delete();
            \Session::flash('deleted_meal_success', 'Your Meal Deleted Successfully');
        }catch(\Exception $e){
            \Session::flash('deleted_meal_faild', 'Your Meal Deleted Faild '. $e->getMessage());
        }
        
        return redirect()->back();
    }
}
