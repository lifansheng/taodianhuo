@extends('layout.homes')

@section('title',$title)

@section('content')
<link href="/homes/css/sustyle.css" rel="stylesheet" type="text/css" />

<div class="take-delivery">
 <div class="status">
   <h2>您已成功付款</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>¥{{session('zong')}}</em></li>
       <div class="user-info">
         <p>收货人：{{session('addr')['name']}}</p>
         <p>联系电话：{{session('addr')['phone']}}</p>
         <p>收货地址：{{session('addr')['address']}}</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
     <div class="option">
       <span class="info">您可以: </span>
        <a href="/" class="J_MakePoint"><span>继续逛逛</span></a>
        <a href="/person/order" class="J_MakePoint"><span>交易详情</span></a>
     </div>
    </div>
  </div>
</div

@stop

@section('js')

@stop