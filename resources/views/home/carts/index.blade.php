@extends('layout.homes')

@section('title',$title)

@section('content')
<style>
		.cart-empty{
			height: 98px;
		    padding: 80px 0 120px;
		    color: #333;

		}

		.cart-empty .message{
			height: 98px;
		    padding-left: 341px;
		    background: url(/homes/gwc/no-login-icon.png) 250px 22px no-repeat;
		}

		.cart-empty .message .txt {
		    font-size: 14px;
		}
		.cart-empty .message li {
		    line-height: 38px;
		}

		ol, ul {
		    list-style: outside none none;
		}

		.ftx-05, .ftx05 {
			color: #005ea7;
		}
		
		a {
		    color: #666;
		    text-decoration: none;
		    margin:0px;
		    padding:0px;
		    font-size:14px;
		}
		
	</style>
<!--购物车 -->
<div style="margin-top: 40px;border-top: 2px solid #d2364c"></div>
		<form action="/home/jiesuan" method="post">
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">
									
								</div>
							</div>
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
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
							<div class="bundle-main">
								@foreach($rs as $k => $v)
								<ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox ">
											<input class="check" id="J_CheckBox_170037950254" gid="{{$v->gid}}" name="carid[]" type="checkbox">
											<label for="J_CheckBox_170037950254"></label>
										</div>
									</li>
									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="{{$v['goodcar']->imgs}}" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" class="item-title J_MakePoint" data-point="tbcart.8.11">{{$v['goodcar']->gname}}</a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props"><!-- item-props-can class样式-->
											<span class="sku-line">{{$v['goodcar']->size}}</span>
											<span class="sku-line">{{$v['goodcar']->color}}</span>
											<!-- <span tabindex="0" class="btn-edit-sku theme-login">修改</span>
											<i class="theme-login am-icon-sort-desc"></i> -->
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<span class="J_Price price">{{$v['goodcar']->price}}</span> 
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<input class="minus am-btn" name="" type="button" value="-" />
													<input class="text_box" name="" type="text" value="1" style="width:30px;" />
													<input class="plus am-btn" name="" type="button" value="+" />
								  				</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<span tabindex="0" class="J_ItemSum number">{{$v['goodcar']->price}}</span> 
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a title="移入收藏夹" class="btn-fav" href="#">移入收藏夹</a>
											<a href="javascript:void(0)" data-point-url="#" class="delete">删除</a>
										</div>
									</li>
								</ul>
								@endforeach
							</div>
						</div>
					</tr>
					<div class="clear"></div>
				<div class="float-bar-wrapper alls">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<a href="javascript:void(0)" class="quan">全选</a>
					</div>
					<div class="operations">
						<a href="javascript:void(0)" hidefocus="true" class="deleteAll">删除</a>
						<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">
							<span class="txt">已选商品</span>
							<em id="J_SelectedItemsCount">0</em><span class="txt">件</span>
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<span id="J_Total">0</span></strong>
						</div>
						<div class="">
							{{csrf_field()}}
							<!-- <a href="javascript:void(0)"  > -->
								<input type="submit" id="J_Go" class="submit-btn submit-btn-disabled btn-area" name="" style="background:red;border-color:red">
							
						</div>
					</div>
				</div>
				</div>
			</form>
				<div class="cart-empty" style='display:none'>
					    <div class="message">
					        <ul>
					            <li class="txt">
					                购物车空空的哦~，去看看心仪的商品吧~
					            </li>
					            <li class="mt10">
					                <a href="/" class="ftx-05">
					                    去购物&gt;
					                </a>
					            </li>
					            
					        </ul>
					    </div>
				</div>

@stop

@section('js')

	<script type="text/javascript">

		// 加
		$('.plus').click(function(){
			// 获取数量的值
			var pv = $(this).prev().val();
			// console.log(pv);

			pv++;
			$(this).prev().val(pv);

			// 库存问题

			// 获取单价
			var prc = $(this).parents('ul').find('.price').text().trim();
			// console.log(prc);

			// 封装一个函数
			function accMul(arg1, arg2){
				var m = 0, s1 = arg1.toString(), s2 = arg2.toString();

				try {m += s1.split(".")[1].length } catch (e) { }
				try { m += s2.split(".")[1].length } catch (e) { }
				return Number(s1.replace(".","")) * Number(s2.replace(".","")) / Math.pow(10,m)
			}

			// 小计 单价 * pv
			$(this).parents('ul').find('.number').text(accMul(pv , prc));

			totals()
		})

		// 减
		$('.minus').click(function(){

			//获取值
			var pv = $(this).next().val();

			pv--;

			if(pv <= 1){

				pv =1;
			}

			$(this).next().val(pv);


			//获取单价
			var prc = $(this).parents('ul').find('.price').text().trim();

			function accMul(arg1, arg2) {

		        var m = 0, s1 = arg1.toString(), s2 = arg2.toString();

		        try { m += s1.split(".")[1].length } catch (e) { }

		        try { m += s2.split(".")[1].length } catch (e) { }

		        return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)

			}

			//让小计发生改变
			$(this).parents('ul').find('.number').text(accMul(prc, pv));

			totals()

		})

		// 选择
		$('.check').click(function(){
			totals()
		})

		function totals()
		{
			function accAdd(arg1,arg2){
				var r1,r2,m;  
			    try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}  
			    try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}  
			    m=Math.pow(10,Math.max(r1,r2))  
			    return (arg1*m+arg2*m)/m 
			}

			var pcr = 0;
			var sum = 0;

			// 遍历
			$(':checkbox:checked').each(function(){
				// 获取小计
				pcr = parseFloat($(this).parents('ul').find('.number').text());

				sum = accAdd(sum, pcr);
			})

			// 让总计发生改变
			$('#J_Total').text(sum);
		}

		// 全选
		$('.quan').click(function(){
			$('.check').attr('checked',true);

			totals()
		})

		// 删除
		$('.delete').click(function(){
			var rs = confirm('删除商品?');
			if(!rs) return;

			// 参数发送到控制器中ID
			// 获取参数
			var gid = $(this).parents('ul').find('.check').attr('gid');
			var rem = $(this);
			$.get('/home/shopcart',{gid:gid},function(data){
				if(data == 1){
					rem.parents('ul').remove();

					// 刷新
					nums()
				}
			})
		})

		$('jiesuan').click(function(){
			var duo = $('input[type=checkbox]').val();
			console.log(duo);
		})

		function nums(){
			//获取tr 的数量
			var rs = $('.clearfix').length;
			if(rs == 0){
				// location.reload();
				// location.href='/home/cart';

				$('.cart-empty').show();
				$('.alls').hide();
				$('.cart-table-th').hide();
			}
			
		}
		nums()
	</script>

@stop


