<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Post;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartPage()
    {
        $carts = auth()->user()->cart;
        return view('posts/cart', compact('carts'));
    }

    public function storeCart($postId)
    {
        $userId = auth()->id();
        $existingCard = Cart::where('user_id', $userId)
            ->where('post_id', $postId)
            ->first();

        if ($existingCard) {
            $existingCard->balance++;
            $existingCard->save();
        } else {
            $card = new Cart();
            $card->user_id = $userId;
            $card->post_id = $postId;
            $card->balance = 1;
            $card->save();
        }

        return redirect()->route('index')->with('success', 'Post added to cart successfully');
    }
}
