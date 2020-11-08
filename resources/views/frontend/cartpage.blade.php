@extends('frontendtemplate')

@section('content')
   
    <div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-black"> Your Shopping Cart </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container mt-5">
		
		<!-- Shopping Cart Div -->
		<div class="row mt-5 shoppingcart_div">
			<div class="col-12">
				<a href="{{route('mainpage')}}" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>
		</div>

		<div class="row mt-5 shoppingcart_div">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th> Photo </th>
							<th> Name </th>
							<th colspan="2"> Qty </th>
							<th> Price </th>
							<th> Total </th>
						</tr>
					</thead>
					<tbody class="tbodyone">
						
					</tbody>
					<tfoot>
						<tr> 
							<td colspan="5"> 
								<textarea class="form-control notes" placeholder="Any Request..." required="">
					
								</textarea>
							</td>
							<td colspan="3">
                            

                            
                                @role('customer')
                            	<button class="btn btn-secondary btn-block mainfullbtncolor checkout"> 
									Check Out 
								</button>
								@else
								<button class="btn btn-secondary btn-block mainfullbtncolor"> 
									Sign IN Check Out 
								</button>
								@endrole

							</td>
						</tr>
					</tfoot>
				</table>
 
    
  
			</div>
		</div>

		
		

	</div>



@endsection

@section('script')
    <script type="text/javascript" src="{{asset('my_asset/js/custom.js')}}"></script>
     <script type="text/javascript">
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      
       $(document).ready(function () {
        $('.checkout').click(function () {
        
          let notes = $('.notes').val();
          let order = localStorage.getItem('items'); // JSON String
          $.post("{{route('order.store')}}",{order:order,notes:notes},function (response) {
            console.log(response);
            localStorage.clear();
            location.href="/";
          });
      });

    })

  </script>
    
@endsection