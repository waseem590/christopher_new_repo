<!-- all seller offers -->
$seller_offers = User::whereHas('user_offers', function ($query) {
    return $query->where('offer_type', '=', true);
})->get();


<!-- authenticated user buyers and seller offers -->
$user= Auth::user();
$buyer_offers = Offer::whereHas('users', function($query){
    return $query->where('user_id',$user->id));
})->get();

$buyer_offers = $user->user_offers;
$filter_buyer_offer= [];
$filter_seller_offer= [];
foreach($buyer_offers as $buy_offer){
    if($buy_offer->offer_type == false){
       $filter_buyer_offer[] = $buy_offer; 
    }
    else{
        $filter_seller_offer[]= $buy_offer;
    }
}

<!-- match buyer requested offer -->
$matched_buyer_offers = [];
foreach($filter_buyer_offer as $buy_off){
    $buy_methods = $buy_off->offer_methods;
    foreach($seller_offers as $sell_off){
        $sell_methods = $sell_off->offer_methods;
        if($sell_off->price == $buy_off->price){
            $buy_methods_key = array_column($buy_methods, 'id');
            $sell_methods_key = array_column($sell_methods, 'id');
            $intersectedValues = array_intersect($buy_methods_key, $sell_methods_key);
            if($intersectedValues)
            {
                $matched_buyer_offers[$buy_off->id]=$sell_off->id;
            }
        } 
    }
}

public function match_offers(){

$user= Auth::user();    
$seller_offers = Offers::with('users')->where('offer_type',true)->where('user_id','!=',$user->id)->latest()->get();
$buyer_offers = Offers::with('users')->where('offer_type',false)->where('user_id','=',$user->id)->latest()->get();

$matched_offers = [];
foreach($buyer_offers as $buy_off){
    $buy_methods = $buy_off->offer_methods->toArray();
    $matched_buyer_offers = [];
    $sell_offers = [];
    foreach($seller_offers as $sell_off){
        $sell_methods = $sell_off->offer_methods->toArray();
        if($sell_off->price == $buy_off->price){
            $buy_methods_key = array_column($buy_methods, 'id');
            $sell_methods_key = array_column($sell_methods, 'id');
            $intersectedValues = array_intersect($buy_methods_key, $sell_methods_key);
            if($intersectedValues)
            {
                $sell_offers[] = $sell_off;
            }
        } 
    }
    $matched_buyer_offers[$buy_off->id] = $sell_offers;
    $matched_offers[] = $matched_buyer_offers;
}
return $matched_offers;
}