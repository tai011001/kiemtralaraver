<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\T_food;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $foods =DB::table('t_food')->select('*');
        $foods=$foods->get();
        return view('home', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foods=T_food::all();
        return view('add',compact('foods'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Kiểm tra giá trị description, model, produced_on
        $this->validate($request, 
            [
                //Kiểm tra giá trị rỗng
                'description' => 'required',
                'name' => 'required',
                'unit_price'=> 'required',
                'promotion_price'=> 'required',
                'produced_on' => 'required',
                'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
            ],
            [
                //Tùy chỉnh hiển thị thông báo
                'description.required' => 'Bạn chưa nhập mô tả!',
                'name.required' => 'Chưa nhập tên',
                'unit_price.required' => 'Chưa nhập giá tiền',
                'promotion_price.required' => 'chưa nhập giá tiền khuyến mãi',
                'produced_on.required' => 'Bạn chưa nhập ngày sản xuất!',
                'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                'image_file.max' => 'Hình thẻ giới hạn dung lượng không quá 10MB',
            ]        
        );
         //kiểm tra file tồn tại
         $name='';
         if($request->hasfile('image_file'))
         {
             $file = $request->file('image_file');
             $name=time().'_'.$file->getClientOriginalName();
             $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
             $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
         }
        $food=new T_food();
        $food->description=$request->input('description');
        $food->name=$request->input('name');
        $food->unit_price=$request->input('unit_price');
        $food->promotion_price=$request->input('promotion_price');
        $food->produced_on=$request->input('produced_on');
        $food->image=$name;
        $food->save();
        return redirect('home')->with('success','Bạn đã thêm thành công');
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
        $food=T_food::find($id);
       return view('detail',compact('food'));
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
        //
    }
}
