<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use Illuminate\Http\Request;
use App\postmodel;
use App\User;
use App\Order;
use App\individual_car;
use App\car_postmodel;
use Illuminate\Support\Facades\Storage;
use Session;
use Stripe\Charge;
use Stripe\Stripe;
class carcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }


    public function index()
    {
        $posts = car_postmodel::orderBy('created_at','desc')->paginate(3);
        return view('carpost.cars')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('carpost.createcar');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'car_name'=>'required',
            'price'=>'required',
            'car_image'=>'image|nullable|max:1999',
            'more_pic1'=>'image|nullable|max:1999',
            'more_pic2'=>'image|nullable|max:1999',
            'more_pic3'=>'image|nullable|max:1999',
            'more_pic4'=>'image|nullable|max:1999'     
        ]);
        //$picarrays=array($request->input('more_pic1'),$request->input('more_pic2'),$request->input('more_pic3'),$request->input('more_pic4'));
        $post =new car_postmodel;
        if($request->hasFile('more_pic1')){
            //Get filename with extension
            $filenameWithExt=$request->file('more_pic1')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('more_pic1')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('more_pic1')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        $post->pic1=$fileNameToStore;
        if($request->hasFile('more_pic2')){
            //Get filename with extension
            $filenameWithExt=$request->file('more_pic2')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('more_pic2')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('more_pic2')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        $post->pic2=$fileNameToStore;

        if($request->hasFile('more_pic3')){
            //Get filename with extension
            $filenameWithExt=$request->file('more_pic3')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('more_pic3')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('more_pic3')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        $post->pic3=$fileNameToStore;

        if($request->hasFile('more_pic4')){
            //Get filename with extension
            $filenameWithExt=$request->file('more_pic4')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('more_pic4')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('more_pic4')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        $post->pic4=$fileNameToStore;

        if($request->hasFile('car_image')){
            //Get filename with extension
            $filenameWithExt=$request->file('car_image')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('car_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('car_image')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        $post->car_name=$request->input('car_name');
        $post->price=$request->input('price');
        $post->more_info=$request->input('more_info');
        $post->quantity=$request->input('quantity');
        $post->user_id=auth()->user()->id;
        $post->car_image=$fileNameToStore;
        $post->save();
        $car_post = $post;
            for($i = 0 ;$i<$request->input('quantity');$i++){ //tuhain too hemjeend taarsan mashinig ind-d storeloh
                $ind_car = new individual_car();
                $ind_car->post_id = $car_post->id;
                $ind_car->save();
            }
        return redirect('/car_posts')->with('success','Your car post added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = car_postmodel::find($id);
        if(!Session::has('cart')){
            $post->dummy_quantity = $post->quantity;
            $post->save();
        }
        //rate hiih heseg         rate hiih esehig view deeree bish controller deeree shiidej bn
        //herew rate =1 bol rate hiine ugui bol hiihku
        //terig shiidehdee tuhain hereglegch ni tuhain hargalzah post-d baih mashinudin ali negig awsanb bol
        //eswel ugui bol gedgees hamaaruulj shiidne
        if(Auth::user()){
            $rate = 0;        
            $ind_cars = individual_car::All();   
            foreach($ind_cars as $ind_car){ 
                if($ind_car->post_id == $post->id){
                    if($ind_car->owner_id == auth()->user()->id){
                        $rate = 1;
                    }
                }
            }
            $data['rate'] = $rate;
        }
        
        $data['post'] = $post;
        return view('carpost.cars_detail')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = car_postmodel::find($id);
        //check for correct user
        if(auth()->user()->isadmined != '1'){
            if(auth()->user()->id !==$post->user_id){
                return redirect('/posts')->with('error','Unauthorized Page');
            }
        }
        return view('carpost.editcar')->with('post',$post);
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
        $this->validate($request,[
            'car_name'=>'required',
            'price'=>'required',
            'quantity' => 'required'
        ]);
        $post =car_postmodel::find($id);
        if($request->hasFile('more_pic1')){
            //Get filename with extension
            $filenameWithExt=$request->file('more_pic1')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('more_pic1')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('more_pic1')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        if($request->hasFile('more_pic1')){
            Storage::delete('public/car_image/'.$post->pic1);
            $post->pic1=$fileNameToStore;
        }
        if($request->hasFile('more_pic2')){
            //Get filename with extension
            $filenameWithExt=$request->file('more_pic2')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('more_pic2')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('more_pic2')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        if($request->hasFile('more_pic2')){
            Storage::delete('public/car_image/'.$post->pic2);
            $post->pic2=$fileNameToStore;
        }
        

        if($request->hasFile('more_pic3')){
            //Get filename with extension
            $filenameWithExt=$request->file('more_pic3')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('more_pic3')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('more_pic3')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        if($request->hasFile('more_pic3')){
            Storage::delete('public/car_image/'.$post->pic3);
            $post->pic3=$fileNameToStore;
        }

        if($request->hasFile('more_pic4')){
            //Get filename with extension
            $filenameWithExt=$request->file('more_pic4')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('more_pic4')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('more_pic4')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        if($request->hasFile('more_pic4')){
            Storage::delete('public/car_image/'.$post->pic4);
            $post->pic4=$fileNameToStore;
        }

        if($request->hasFile('car_image')){
            //Get filename with extension
            $filenameWithExt=$request->file('car_image')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just extension
            $extension=$request->file('car_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension; 
            //upload image
            $path=$request->file('car_image')->storeAs('/public/car_image',$fileNameToStore);
        }
        else{
            $fileNameToStore= 'default_car.jpg';
        }
        if(auth()->user()->isadmined != '1'){
            if(auth()->user()->id !==$post->user_id){
                return redirect('/posts')->with('error','Unauthorized Page');
            }
        }
        $post->car_name=$request->input('car_name');
        $post->price=$request->input('price');
        $oldqty = $post->quantity;
        $post->more_info=$request->input('more_info');
        $post->quantity=$request->input('quantity');
        if($request->hasFile('car_image')){
            $post->car_image=$fileNameToStore;
        }
        $post->save();

        if($request->quantity<$oldqty){//shine too hemjee ni huuchnaasaa baga baiwal
            $ind_cars = individual_car::All();
            $i = 0;
                foreach($ind_cars as $ind_car){
                    if($oldqty - $request->input('quantity')>$i){
                        if($ind_car->post_id == $post->id){
                            if($ind_car->owner_id=='0'){
                                $ind_car->delete();
                                $i +=1;
                            }
                        }
                    }
                }
        }

        if($request->quantity>$oldqty){//shine too hemjee ni huuchnaasaa ikh baiwal
            for($i = 0 ;$i<$request->input('quantity') - $oldqty;$i++){
                $ind_car = new individual_car();
                $ind_car->post_id = $post->id;
                $ind_car->save();
            } 
        }

        return redirect('/car_posts')->with('success','Your car just edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=car_postmodel::find($id);
        //check 4 correct user
        if(auth()->user()->isadmined != '1'){
            if(auth()->user()->id !==$post->user_id){
                return redirect('/posts')->with('error','Unauthorized Page');
            }
        }
        
        if($post->car_image!='default_car.jpg'){
            //delete image
            Storage::delete('public/car_image/'.$post->car_image);
        }
        if($post->pic1!='default_car.jpg'){
            //delete image
            Storage::delete('public/car_image/'.$post->pic1);
        }
        if($post->pic2!='default_car.jpg'){
            //delete image
            Storage::delete('public/car_image/'.$post->pic2);
        }
        if($post->pic3!='default_car.jpg'){
            //delete image
            Storage::delete('public/car_image/'.$post->pic3);
        }
        if($post->pic4!='default_car.jpg'){
            //delete image
            Storage::delete('public/car_image/'.$post->pic4);
        }
        $post->delete();
        return redirect('/car_posts')->with('success','Post removed');
    }

    public function getAddToCard(Request $request,$id){ //sagsand baraa hiih
        $post = car_postmodel::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart -> add($post,$post->id);
        $request->session()->put('cart',$cart);
        //baraanii toog shienchleh
        $post->dummy_quantity -= 1;
        $post->save();
        // $temp = $post->quantity;  baraanii toog shinechleh
        // $temp -= 1;
        // $post->quantity=$temp;
        // $post->save();

        return redirect('/car_posts/'.$id)->with('success','Product added');
    }

    public function getReduceByOne($id){
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect('/rent');
    }

    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);

        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
            
        
        return redirect('/rent');
    }

    public function getCart(){ //sagsand bga baraanuudig haruulahad ashiglasan class
        if(!Session::has('cart')){
            return view('pages.rent'); //products ni post shig
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('pages.rent',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
    }


    //1 hun 2 udaa unelgee uguhgui baih arga: Tuhain baraan deer unelegdsen esehig 0 eswel 1-eer ugnu mun tuhain hun baraa unelsen esehig 0 esul 1-eer ugn. Harin tuhain baraag tuhain hereglegcch unelsen esehig
    // 0 da 1-iin urjwereer olno herew urjwer 1 garwal rated gsn ug  0 garwal unrated gsn ug 
    public function submitrate(Request $request,$id){ //mashin awsan humuus rate/unelgee uguh heseg
            $rate = $request->rate;
            $post = car_postmodel::find($id);
            $user = User::find(auth()->user()->id);

            $is_that_ind_car_rated =0;
            $ind_cars = individual_car::All();   
            foreach($ind_cars as $ind_car){ //tuhain post-d hargalzah id-tai mashin rate-luulsen esehig awah
                if($ind_car->post_id == $post->id){
                    if($ind_car->owner_id == auth()->user()->id){
                        $is_that_ind_car_rated = $ind_car->israted;
                    }
                }
            }
            $multiplerated = $is_that_ind_car_rated * auth()->user()->isusedrate;
            if($multiplerated==0){ //rate-luuleegui bwl
                $user->isusedrate = 1;
                $rate = ($rate + $post->rate)/2;
                if($rate%1>=0.5){
                    $rate = $rate - $rate%1+1;
                }
                else{
                    $rate = $rate - $rate%1;
                }
                $post->rate = $rate;
                $ind_cars = individual_car::All();   
                foreach($ind_cars as $ind_car){         //tuhain post-d hargalzah id-tai mashind rateluullee gsn            
                    if($ind_car->post_id == $post->id){ //id-g uguh
                        if($ind_car->owner_id == auth()->user()->id){
                            $ind_car->israted=1;
                            $ind_car->save();
                        }
                    }
                }
                $user->save();
                $post->save();
                return redirect('/car_posts')->with('success','Thanks for submitting rate');
            }
            else{
                return redirect('/car_posts')->with('error','Submit failed. You already rated this product !');
            }
            
    }

     public function getCheckout(){ 
        if(!Session::has('cart')){
             return view('pages.rent'); //products ni post shig
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('pages.checkout',['total'=>$total]);
        //return view('pages.rent',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
    }

    public function postCheckout(Request $request){
        if(!Session::has('cart')){
             return view('pages.rent'); //products ni post shig
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $order = new Order();
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->payment_id = '1';
        Auth::user()->orders()->save($order);
        $order1 = Order::find($order->id);
        // awsan too hemjeeg huuhcin too hemjeenes hasah heseg
        foreach($cart->items as $item){
            $car_post = car_postmodel::find($item['item']['id']); //ali mashinii post orsniig olno nissan 16
            $oldqty = $car_post->quantity; //tuhain post-nd bga mashinii too hemjeg olno  3
            $newqty = $oldqty - $item['qty']; //olson too hemjeenees cart-d bga tuhain post-d hargalzah toog hasna 2
            $car_post->quantity = $newqty; //post-in too hemjeend shine toog oruulj bn 3-2=1
            $ind_cars = individual_car::All(); 
            $i = 0;
                foreach($ind_cars as $ind_car){ //$item->qty-tai tentseh shirheg mashind owner id uguh
                    if($item['qty']>$i){
                        if($ind_car->post_id == $car_post->id){
                            if($ind_car->owner_id == '0'){
                                $ind_car->owner_id = auth()->user()->id;
                                $i +=1;
                                $ind_car->save();
                            }
                        }
                    }
                }
            $car_post->save();
        }
        Session::forget('cart');
        return redirect('/car_posts')->with('success','Successfully purchased products');

    }


    public function isdelivered($id){ //order irsen esehiiig harah
        $order = Order::find($id);
        $order->isorder_delivered = 1;
        $order->save();
        return redirect('/dashboard')->with('success','Thanks');
    }
}



// Stripe::setApiKey('sk_test_51HsqHABoftEZlmVcJ8R3fFaj6d1wxUPT2m9CgjAN7y1Z2KFGanpdQ0ah7jYCqJ6QZjHvXTvdPdaKwiqdnAB7OuBF00qrHtEmba');
        // try{
        //     Charge::create(array(
        //         "amount"=>$cart->totalPrice * 100,
        //         "currency"=>"usd", 
        //         "source" => $request->input('stripeToken'),
        //         "description" => "Test Charge"
        //     ));
        // }
        // catch(\Exception $e){
        //     return redirect()->route('checkout')->with('error',$e->getMessage());
        // }  