

$(document).ready(function(){

    		 showdata();
    		 count();

               $(".addtocartBtn").click(function(){
			var id=$(this).data('id');
			var name=$(this).data("name");
			var photo=$(this).data("photo");
			var price=$(this).data("price");

			var item={
				id:id,
				name:name,
				photo:photo,
				price:price,
				qty:1,
			}

			var itemlist=localStorage.getItem("items");

			var ItemArray;
			if(itemlist==null){
				ItemArray=[];
			}else{
				ItemArray=JSON.parse(itemlist);
			}
			var status=false;
			$.each(ItemArray,function(i,v){
				if(v.id==id){
					
					v.qty++;
					status=true;
				}
			})

			if(!status){
				ItemArray.push(item);	
			}
			var itemstring=JSON.stringify(ItemArray);
			localStorage.setItem("items", itemstring);
			// showdata();
			// count();
			
		   })


               function showdata(){
			var itemlist=localStorage.getItem("items");
			var itemArray=JSON.parse(itemlist);
			// console.log(itemArray);
			
			var html="";
			var total=0;
			$.each(itemArray,function(i,v){
				var subtotal=v.qty*v.price;
				total+=subtotal;
				html+=`<tr>
				
				<td><img src="${v.photo}" width="50px" height ="50px"></td>

				<td>${v.name}</td>

				<td><button class="btnplus" data-id="${i}"> + </button>${v.qty}<button class="btnminus" data-id="${i}"> - </button></td>
				<td>${v.price}</td>
				<td>${subtotal} <button data-id="${i}" class="remove">Remove</button></td>
				</tr>`

			})
			html+=`<tr><td colspan="5">Total</td><td>${total}</td></tr>`
			
			$(".tbodyone").html(html);
			
			count();

		   }

     
     		$("tbody").on("click",".remove",function(){
			//alert("ok");
			var id=$(this).data("id");
			//console.log(id);
			var itemlist=localStorage.getItem("items");
			var ItemArray=JSON.parse(itemlist);
			ItemArray.splice(id,1);
			var itemstring=JSON.stringify(ItemArray);
			localStorage.setItem("items", itemstring);
			showdata();
			count();
			
		})

         function count(){
		var cart = localStorage.getItem('items');
		if (cart) {
			var cartArray = JSON.parse(cart);
			var total =0;
			var noti = 0;
			$.each(cartArray, function(i,v){

				var unitprice = v.price;
				var discount = v.discount;
				var qty = v.qty;
				if (discount) {
					var price = discount;
				}
				else{
					var price = unitprice;
				}
				var subtotal = price * qty;

				noti += qty ++;
				total += subtotal ++;
			})
			$('.cartNoti').html(noti);
			$('.cartTotal').html(total+' Ks');
		}
		else{
			$('.cartNoti').html(0);
			$('.cartTotal').html(0+' Ks');
		}
	}
		// function count(){
		// 	var totalcount=0;
		// 	var itemlist=localStorage.getItem("items");
		// 	if(itemlist){
		// 		ItemArray=JSON.parse(itemlist);
		// 		$.each(ItemArray,function(i,v){
		// 			totalcount+=v.qty;
		// 		})
		// 	}
		// 	$(".cartNoti").html(totalcount);
		// }

		 $("tbody").on("click",".btnplus", function(){

		 	// alert("ok");

		 	var id=$(this).data("id");


		 	var itemlist=localStorage.getItem("items");
		 	var itemarray = JSON.parse(itemlist);


		 	$.each(itemarray, function(i,v){
                if(i==id){
		 		v.qty++;
		 	}
		 		// alert(v.qty);
		   		


		   
		 	})
		 	 var itemstring = JSON.stringify(itemarray);
		    localStorage.setItem("items", itemstring);

		    showdata();
		    count();
		    




		 })


		 $("tbody").on("click",".btnminus", function(){

		 	// alert("ok");

		 	var id=$(this).data("id");


		 	var itemlist=localStorage.getItem("items");
		 	var itemarray = JSON.parse(itemlist);


		 	$.each(itemarray, function(i,v){
                if(i==id){
		 		v.qty--;
		 		if(v.qty<1){
		 			itemarray.splice(id,1);
		 		}
		 	}
		 		// alert(v.qty);
		   		

       
		   
		 	})
		 	 var itemstring = JSON.stringify(itemarray);
		    localStorage.setItem("items", itemstring);

		    showdata();
		    count();




		 

    	})

		
    


		


    })