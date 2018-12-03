<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Address;
use App\Http\Requests\AddressRequest;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $res = Address::orderBy('id', 'asc')->where(function($query) use($request){

                //检测关键字
                $name = $request->input('name');
                $address = $request->input('address');
                $phone = $request->input('phone');

                //如果用户名不为空
                if (!empty($name)) {
                    $query->where('name', 'like','%'.$name.'%');
                    # code...
                }

                //如果地址不为空
                if (!empty($address)) {
                    $query->where('address','like','%'.$address.'%');
                    # code...
                }


                //如果电话不为空
                if (!empty($phone)) {
                    $query->where('phone','like','%'.$phone.'%');
                    # code...
                }
            })->paginate($request -> input('num', 10));
        // dd($res);
        return view('admin.address.index',['title' => '收货信息','request' => $request, 'res' => $res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.address.add', ['title' => '添加链接']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $res = $request -> except('_token');


try{

            $data = Address::create($res);
            
            if($data){
                return redirect('admin/address')->with('success','添加成功');
            }

        }catch(\Exception $e){

            return back()->with('error','添加失败');
        }
    }
// }
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

        $res = Address::find($id);
        return view('admin.address.edit',['title' => '收货信息修改','res' => $res
    ]);
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
    $res = $request -> except('_token','_method');
// dd($res);
     try{

            $data = Address::where('id', $id) ->update($res);
                // dd($data);
           
              
            
        }catch(\Exception $e){

            return back()->with('error','修改失败');
        }
          return redirect('/admin/address')->with('success', '修改成功');
                # code...
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { $res = Address::destroy($id);
        
 
        try{

           
if ($res) {
           
                return redirect('/admin/address')-> with('success','删除成功');
                # code...
            }
        }catch(\Exception $e){

            return back() ->with('error','删除失败');
        }
    }
}
