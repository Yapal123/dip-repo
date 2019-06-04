<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Manufacturer;
use App\Unit;
use DB;
use App\User;
use App\Client;
use App\Order;
use App\Status;


class UserController extends Controller
{
	public function catalog(request $request)
	{
		$un = new Unit;
		$man = new Manufacturer;
		$uns = $un->all();
		$mans = $man->all();
		$product = new Product;
		$error = '';
		$data =  DB::table('products')->join('categories','products.category_id','=','categories.id')
		->join('manufacturers','products.manufacturer_id','=','manufacturers.id')
		->join('units','products.unit_id','=','units.id')->select('*','products.id');
		if ($request->has('price') AND $request->price != '') {
			$data->where('price',$request->price);
		}
		if ($request->has('units')) {
			$data->whereIn('unit_id',$request->units);
		}
		if ($request->has('mans')) {
			$data->whereIn('manufacturer_id',$request->mans);
		}
		$prods = $data->paginate(6);
		if (count($prods) == 0) {
			$error = 'Не найдено';
		}
		return view('users.products',['prods'=>$prods,'uns'=>$uns,'mans'=>$mans,'error'=>$error]);
	}
    public function cart()
    {
    	return view('users.cart');
    }

    public function checkOrder()
    {	$orders = new Order;


    	return view('users.orderCheck');
    }

    public function allOrders()
    {	
    	$orders =  DB::table('orders')->join('users','orders.profile_id','=','users.id')
		->join('products','orders.product_id','=','products.id')
		->join('statuses','orders.status_id','=','statuses.id')
		->select('*')
		->groupBy('orders.order_number')
		->get();
	
		
		
    	return view('users.allOrders',['orders'=>$orders]);
    }
    public function addProduct()
    {
    	$units = Unit::all();
    	$manufacturers = Manufacturer::all();
    	$categories = Category::all();
    	return view('users.addProduct',['units'=>$units,'mans'=>$manufacturers,'cats'=>$categories]);
    }
    public function log()
    {
    	return view('users.login');
    }

    public function reg()
    {
    	return view('users.register');
    }

    public function regHandle(request $request)
    {
    	$users = new User;
    	$clients = new Client;
    	$check = $users->where('login',$request->login)->get();

    	if (count($check) > 0) {
    		session()->flash('error','1');
    		return redirect()->back();
    	} else {
    		    	$id = $clients->insertGetId([
    		'full_name' => $request->fullName,
    		'birth_date' => $request->bday,
    		'city' => $request->city,
    		'street' => $request->street,
    		'phone' => $request->phone,
    	]);

    	$users->insert([
    		'login' => $request->login,
    		'email'=> $request->email,
    		'password'=> $request->password,
    		'client_id' =>$id ,
    		'role_id' => 1,
    			]);
    	session()->flash('error','2');
    	return redirect()->back();
    	}

    		
    		
    }

    public function logHandle(request $request)
    {
    	$users = new User;

    	$check = $users->where('login',$request->login)->where('password',$request->password)->first();
    	if (!empty($check)) {
			session(['auth'=>'1']);
			session(['user_id'=>$check->id]);
    		session()->forget('error');
    		if ($check->role_id == 1) {
    			session(['role'=>'1']);

    		} else{
    			session(['role'=>'2']);
    		}
    	} else {
    		session(['error'=>'1']);
    		return redirect()->back();
    	}
    	return redirect()->route('catalog');
    }


    public function logout()
    {
    	session()->forget('auth');
    	session()->forget('roler');
    	session()->forget('user_id');
    	return redirect()->back();
    }


    public function addToCart($id)
    {

		$data =  DB::table('products')->join('categories','products.category_id','=','categories.id')
		->join('manufacturers','products.manufacturer_id','=','manufacturers.id')
		->join('units','products.unit_id','=','units.id')->select('*','products.id');


        $product = $data->where('products.id',$id)->get();

        if(!$product) {
 
            abort(404);
 
        }
 
        $cart = session()->get('cart');
 
        // if cart is empty then this the first product
        if(!$cart) {
 
            $cart = [
                    $id => [
                    	'prod_id' => $product[0]->id,
                        "title" => $product[0]->title,
                        "quantity" => 1,
                        "manufacturer" => $product[0]->manufacturer_title,
                        "price" => $product[0]->price,
                        "category" => $product[0]->category_title,
                        
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
 
            $cart[$id]['quantity']++;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
        	'prod_id' => $product[0]->id,
            "title" => $product[0]->title,
            "quantity" => 1,
            "manufacturer" => $product[0]->manufacturer_title,
            "price" => $product[0]->price,
            "category" => $product[0]->category_title,
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

 	public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }
 
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    } 

    public function createOrder()
    {
    	$orders = new Order;
    	$statuses = new Status;
    	$rand = rand(1,10000);

    	foreach (session('cart') as $id => $prod) {
    		$orders->insert([
    			'order_number' => $rand,
    			'profile_id' => session()->get('user_id'),
    			'product_id' => $prod['prod_id'],
    			'quantity' => $prod['quantity'],
    			'status_id' => 2,
    			'total' => $prod['quantity'] * $prod['price'],
    		]);
    	}
    	session()->forget('cart');
    	return view('users.thx',['number'=>$rand]);
    }

    public function getOrder(request $request)
    {
    	$orders = new Order;
    	$statuses = new Status;
    	$ords = DB::table('orders')->join('statuses','orders.status_id','=','statuses.id')
    	->join('products','orders.product_id','=','products.id')->select('*')->where('order_number',$request->orderNum)->get();

    	return view('users.orderFound',['ords'=>$ords]);
    }

    public function myOrders()
    {
    	$orders = new Order;
    	$statuses = new Status;
    	$ords = DB::table('orders')->join('statuses','orders.status_id','=','statuses.id')
    	->join('products','orders.product_id','=','products.id')->select('*')->where('profile_id',session('user_id'))->get();

    	return view('users.myOrders',['ords'=>$ords]);
    }

    public function addHandle(request $request)
    {
    	$products = new Product;

    	$id = $products->insertGetId([
    		'title'=>$request->title,
    		'category_id'=>$request->category,
    		'manufacturer_id'=>$request->manufacturer,
    		'unit_id'=>$request->units,
    		'description'=>$request->descr,
    		'price'=>$request->price,

    	]);
	    	if ($request->has('img')) {
    		$image = $request->file('img');
    		
    		$nameImg = $id.'.jpg';
    		 $destinationPath = public_path('\img');
    		 $image->move($destinationPath, $nameImg);
    	}
    	session()->flash('message','Успешно');
    	return redirect()->back();
    }

    public function editOrder($orderNumber)
    {
    	$orders =  DB::table('orders')->join('users','orders.profile_id','=','users.id')
		->join('products','orders.product_id','=','products.id')
		->join('statuses','orders.status_id','=','statuses.id')
		->select('*')
		->where('order_number',$orderNumber)
		->groupBy('orders.order_number')
		->get();
		$statuses = Status::all();
    	return view('users.editOrder',['orders'=>$orders,'statuses'=>$statuses]);
    }

    public function updateStatus(request $request,$orderNumber)
    {
    	DB::table('orders')->where('order_number',$orderNumber)->update(['status_id'=>$request->status]);

    	return redirect()->back();
    }

    public function deleteOrder($id)
    {
    	DB::table('orders')->where('order_number',$id)->delete();
    	return redirect()->back();
    }


}
