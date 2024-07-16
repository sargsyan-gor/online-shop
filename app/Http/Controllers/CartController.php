<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Post;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartPage(Cart $cart)
    {
        return view('posts/cart',compact($cart));
    }

    public function storeCart(Post $post)
    {
        $userId = auth()->id();
        $existingCard = Cart::where('user_id', $userId)
            ->where('post_id', $post->id)
            ->first();
        if ($existingCard) {
            $existingCard->balance++;
            $existingCard->save();
        } else {
            $card = new Cart();
            $card->user_id = $userId;
            $card->post_id = $post->id;
            $card->balance = 1;
            $card->save();
        }
        return redirect()->route('index')->with('success', 'Post added to cart successfully');
    }
}
