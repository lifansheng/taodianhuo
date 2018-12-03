@extends('layout.homes')

@section('title',$title)

@section('content')
<link href="/homes/css/sustyle.css" rel="stylesheet" type="text/css" />

<div class="take-delivery">
 <div class="status">
   <h2>您已成功付款</h2>
   <div class="successInfo">
     <ul>
       <li>付款金额<em>¥9.90</em></li>
       <div class="user-info">
         <p>收货人：艾迪</p>
         <p>联系电话：15871145629</p>
         <p>收货地址：湖北省 武汉市 武昌区 东湖路75号众环大厦</p>
       </div>
             请认真核对您的收货信息，如有错误请联系客服
                               
     </ul>
     <div class="option">
       <span class="info">您可以</span>
        <a href="/person/order" class="J_MakePoint">查看<span>已买到的宝贝</span></a>
        <a href="/person/order" class="J_MakePoint">查看<span>交易详情</span></a>
     </div>
    </div>
  </div>
</div

@stop

@section('js')

@stop