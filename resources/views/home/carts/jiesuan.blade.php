@extends('layout.homes')

@section('title',$title)

@section('content')
<link href="/homes/css/jsstyle.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/homes/js/address.js"></script>

<div style="margin-top: 40px;border-top: 2px solid #d2364c"></div>
			<div class="concent">
				<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						<div class="control">
							<div class="tc-btn createAddr theme-login am-btn am-btn-danger"><a href="/home/address">使用新地址</a></div>
						</div>
						<div class="clear"></div>
						<ul>
							@foreach($addrs as $k => $v)
							<div class="per-border"></div>
							<li class="user-addresslist @if($v->status== 1) defaultAddr @endif">

								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                   							<span class="buy-user">{{$v->name}}</span>
										<span class="buy-phone">{{$v->phone}}</span>
										</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">										
										<span class="province">{{$v->address}}</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">详细地址：</span>
										<span class="buy--address-detail">

										<span class="street">{{$v->xiangxiaddress}}</span>
									</div>
									@if ($v->status == 1)
									<ins class="deftip">默认地址</ins>
									@endif
								</div>
								<div class="address-right">
									<a href="../person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									@if($v->status == 1)
									<a href="#" class="hidden">设为默认</a>
									<span class="new-addr-bar hidden">|</span>
									@else
									<a href="javascript:void(0);" class="addrdefault" aid="{{$v->id}}">设为默认</a>
									@endif
								</div>

							</li>
							@endforeach
						</ul>
						<script type="text/javascript">
							$('.addrdefault').click(function(){
								var aid = $(this).attr('aid');
								var shua = $(this)
								$.get('/home/addrdefault',{aid:aid},function(data){
									if(data == 1){
										location.reload(true);
									}
								})
							})

						</script>

						<div class="clear"></div>
					</div>
					<!--物流 -->
					<div class="logistics">
						<h3>选择物流方式</h3>
						<ul class="op_express_delivery_hot">
							<li data-value="yuantong" class="OP_LOG_BTN  ">
								<input class="sku-line" type="radio" name="kuaidi" value="圆通">
								<i class="c-gap-right" style="background-position:0px -468px"></i>圆通
								<span></span>
							</li>
							<li data-value="shentong" class="OP_LOG_BTN  " id="kuaidi">
								<input class="sku-line" type="radio" name="kuaidi" value="申通">
								<i class="c-gap-right" style="background-position:0px -1008px"></i>申通
								<span></span>
							</li>
							<li data-value="yunda" class="OP_LOG_BTN  " id="kuaidi">
								<input class="sku-line" type="radio" name="kuaidi" value="韵达">
								<i class="c-gap-right" style="background-position:0px -576px"></i>韵达
								<span></span>
							</li>
							<li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last " id="kuaidi">
								<input class="sku-line" type="radio" name="kuaidi" value="中通">
								<i class="c-gap-right" style="background-position:0px -324px"></i>中通
								<span></span>
							</li>
							<li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom" id="kuaidi">
								<input class="sku-line" type="radio" name="kuaidi" value="顺丰">
								<i class="c-gap-right" style="background-position:0px -180px"></i>顺丰
								<span></span>
							</li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--支付方式-->
					<div class="logistics">
						<h3>选择支付方式</h3>
						<ul class="pay-list">
							<li class="pay card"><img src="/homes/images/wangyin.jpg" />银联<span></span></li>
							<li class="pay qq"><img src="/homes/images/weizhifu.jpg" />微信<span></span></li>
							<li class="pay taobao"><img src="/homes/images/zhifubao.jpg" />支付宝<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							<h3>确认订单信息</h3>
							<div class="cart-table-th">
								<div class="wp">

									<div class="th th-item">
										<div class="td-inner">商品信息</div>
									</div>
									<div class="th th-price">
										<div class="td-inner">单价</div>
									</div>
									<div class="th th-amount">
										<div class="td-inner">数量</div>
									</div>
									<div class="th th-sum">
										<div class="td-inner">金额</div>
									</div>
									<div class="th th-oplist">
										<div class="td-inner">配送方式</div>
									</div>

								</div>
							</div>
							<div class="clear"></div>
							@php
								$zong = 0;
							@endphp
							@foreach($data as $k => $v)
							<tr class="item-list">
								<div class="bundle  bundle-last">
									<div class="bundle-main">
										<ul class="item-content clearfix">
											<div class="pay-phone">
												<li class="td td-item">
													<div class="item-pic">
														<a href="#" class="J_MakePoint">
															<img src="{{$v->imgs}}" class="itempic J_ItemImg"></a>
													</div>
													<div class="item-info">
														<div class="item-basic-info">
															<a href="#" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v->gname}}</a>
														</div>
													</div>
												</li>
												<li class="td td-info">
													<div class="item-props">
														<span class="sku-line">规格: {{$v->size}}</span>
														<span class="sku-line">口味：{{$v->leixing}}</span>
													</div>
												</li>
												<li class="td td-price">
													<div class="item-price price-promo-promo">
														<div class="price-content">
															<em class="J_Price price-now">{{$v->price-2}}</em>
														</div>
													</div>
												</li>
											</div>
											<li class="td td-amount">
												<div class="amount-wrapper ">
													<div class="item-amount ">
														<span class="phone-title">购买数量</span>
														<em tabindex="0" class="J_ItemSum number">{{$v->cnt}}</em>
													</div>
												</div>
											</li>
											<li class="td td-sum">
												<div class="td-inner">
													<em tabindex="0" class="J_ItemSum number">{{$v->cnt*($v->price-2)}}</em>
												</div>
											</li>
											<li class="td td-oplist">
												<div class="td-inner">
													<span class="phone-title">配送方式</span>
													<div class="pay-logis">
														快递<b class="sys_item_freprice">10</b>元
													</div>
												</div>
											</li>

										</ul>
									</div>
								</div>
							</tr>
							@php
								$money = $v->cnt*($v->price-2);
								$zong += $money;
								$zong += 10;

								session(['zong'=>$zong]);
							@endphp

							@endforeach
						</div>
					</div>
							<div class="pay-total">
						<!--留言-->
							<div class="order-extra">
								<div class="order-user-info">
									<div id="holyshit257" class="memo">
										<label>买家留言：</label>
										<input type="text" placeholder="选填,对本次交易的说明（建议填写已经和卖家达成一致的说明）" name="liuyan" class="memo-input J_MakePoint c2c-text-default memo-close">
										<div class="msg hidden J-msg">
											<p class="error">最多输入500个字符</p>
										</div>
									</div>
								</div>

							</div>

							<div class="clear"></div>
							</div>
							<!--含运费小计 -->
							<div class="buy-point-discharge ">
								<p class="price g_price ">
									合计（含运费） <span>¥</span><em class="pay-sum">{{$zong}}</em>
								</p>
							</div>

							<!--信息 -->
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{$zong}}</em>
											</span>
										</div>

										<div id="holyshit268" class="pay-address">

											<p class="buy-footer-address">
												<span class="buy-line-title buy-line-title-type">寄送至：</span>
												<span class="street">{{session("addr")['xiangxiaddress']}}</span>
											</p>
											<p class="buy-footer-address">
												<span class="buy-line-title">收货人：</span>
												<span class="buy-address-detail">   
                                         <span class="buy-user">{{session("addr")['name']}}</span>
												</span>
											</p>
											<p class="buy-footer-address">
												<span class="buy-line-title buy-line-title-type">联系电话：</span>
												<span class="buy-phone">{{session("addr")['phone']}}</span>
											</p>
										</div>
									</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<a id="J_Go" href="javascript:void(0)" class="btn-go" tabindex="0" title="点击此按钮，提交订单">提交订单</a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
@stop

@section('js')
<script type="text/javascript">
	$("input[name=kuaidi]").click(function(){
		kuaidi = $(this).val();
	})

	$('input[name=liuyan]').blur(function(){
		liuyan = $(this).val().trim();
	})

	$("#J_Go").click(function(){
		window.location.href = "/home/cheng?kuaidi="+kuaidi+"&liuyan="+liuyan;
	})
</script>

@stop