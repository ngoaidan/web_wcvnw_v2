<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cart;
use Auth;

class OrderController extends Controller
{
	/**
	  * An Order Status: Order Submitted -> Processing -> Confirmed -> Assigned   ----> Picked ------> Delievered
	  *                  (Đã nhập đơn hàng) (Đang xử lý)  (Xác nhận)  (Đã phân công)   (Đã lấy hàng)   (Đã giao hàng)
	  * In case deliver on Wednesday & Saturday:
	  */

	/**
	 *addOrder
	 *
	 * Insert an order for customer into DB
	 * @param $cart ($product_id, $farmer_id, $product_id, $quantity)
	 *        $customer_id: customer to be inserted for
	 * @return array of products in its categories 
	 */

	public function addOrder(Request $request)
	{
		$data = $request->data;
		$phone = $data["sdt"];
        $email = $data["email"];
        $name  = $data["ten"];
        $address = $data["diaChi"];
        $district = $data["selectQuan"];
        $payment = $data["thanhToan"];
        $promotion_code = $data["maGiamGia"];

         $items = Cart::content();
         $orderPossible = 1;
         $counter = 1;
         foreach ($items as $item) {
         	$combine[$counter++] = $item->id;
         	$combine[$counter++] = $item->options["farmer_id"];
         	$combine[$counter++] = $item->qty;
		}

		$numbers = DB::select('SELECT p.`unit` "unit", tr.`price_farmer` "price_farmer", p.`unit_quantity` "unit_quantity", (tr.`capacity` - tr.`sold`) AS "quantity_left" FROM `products` p, `trading` tr WHERE p.`id` = tr.`product_id` AND tr.`status` = '1' AND tr.`farmer_id` = ? AND p.`id` = ? AND (tr.`capacity` - tr.`sold`)/p.`unit_quantity` >= ?', [$combine]);

		return response()->json($numbers);

		// foreach ($numbers as $number) {
		// 	if($number->quantity_left < $qty * $numbers[0]->unit_quantity)
		// 	{
		// 		$item->options["error"] = 1;
		// 		$orderPossible = 0;
		// 		// var_dump($item);die();
		// 		Cart::update($item->rowId, $item->options["error"]);
		// 	}
		// }

         }
         if($orderPossible == 0){
         	$msg['Cart'] = Cart::content();
       		return response()->json($msg); 
         }

		 // var_dump($items);var_dump($phone);die();

         if(Auth::check()) {
         	$user = Auth::user();
         	$customer_id = $user->connected_id;
         }
         else 
         {
         	//check if data exist in db (email and phone)
         	$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `phone` = ? OR `email` = ?', [$phone, $email]);
         	//if not yet in db, create customer into db
         	if(!$customer_id) {
         		DB::insert('INSERT INTO customers(`name`, `phone`, `email`, `address`, `district`) VALUES(?,?,?,?,?)', [$name, $phone, $email, $address, $district]);
         		$customer_id = DB::select('SELECT `id` FROM `customers` WHERE `phone` = ? OR `email` = ?', [$phone, $email]);
         	}
         	$customer_id = $customer_id[0]->id;
         }
        
// Create Order_id and return after adding the order successfully.
        //#34256789
        $order_id = DB::select('SELECT `order_id` "order_id" FROM `uniqueids` WHERE `id` = 1');
        $order_id = $order_id[0]->order_id;
        DB::statement('UPDATE `uniqueids` SET `order_id` = `order_id`+1 WHERE `id` = 1');

         DB::insert('INSERT INTO g_orders(`order_id`, `customer_id`, `payment`, `promotion_code`, `delivery_address`, `delivery_phone`, `delivery_district`) VALUES(?,?,?,?,?,?,?)', [$order_id, $customer_id, $payment, $promotion_code, $address, $phone, $district]);

 		// $items = Cart::content();
		$msg['order_id'] = $order_id;

		foreach ($items as $item) {

			$product_id = $item->id;
			$farmer_id = $item->options["farmer_id"];
			$price = $item->price;
			$qty = $item->qty;
			
			//receive numbers and check if quantity_left is >= order quantity
			$numbers = DB::select('SELECT p.`unit` "unit", tr.`price_farmer` "price_farmer", p.`unit_quantity` "unit_quantity", (tr.`capacity` - tr.`sold`) AS "quantity_left" FROM `products` p, `trading` tr WHERE p.`id` = tr.`product_id` AND tr.`farmer_id` = ? AND p.`id` = ?', [$farmer_id, $product_id]);
			
			if($numbers[0]->quantity_left < $qty * $numbers[0]->unit_quantity)
			{
				$item->options["error"] = 1;
				// var_dump($item);die();
				Cart::update($item->rowId, $item->options["error"]);
			}
			else{
				$quantity = $qty * $numbers[0]->unit_quantity;
				$price_farmer = $qty * $numbers[0]->price_farmer;
				$unit = $numbers[0]->unit;

	         	$m_order = DB::insert('INSERT INTO m_orders(`order_id`, `farmer_id`, `product_id`, `quantity`, `unit`, `price`, `price_farmer`, `created_at`) VALUES(?,?,?,?,?,?,?, CURRENT_TIMESTAMP)', [$order_id, $farmer_id, $product_id, $quantity, $unit, $price, $price_farmer]);

	         	//update trading table
	        	DB::statement('UPDATE `trading` SET `sold_count` = `sold_count`+ ?, `sold` = `sold` + ? WHERE `farmer_id` = ? AND `product_id` = ?', [$qty, $quantity, $farmer_id, $product_id]);
			}
         	

		}
		Cart::destroy();
 		$msg['Cart'] = Cart::content();
       // return $order_id;
       	return response()->json($msg);

	}
	

	/**
	 *cancelOrder
	 *
	 * Insert an order for customer into DB
	 * @param $cart ($product_id, $farmer_id, $product_id, $quantity)
	 *        $customer_id: customer to be inserted for
	 * @return array of products in its categories 
	 */

	public function cancelOrder($customer_id, $cart)
	{
		// 
		return 0;
	}
	

}
