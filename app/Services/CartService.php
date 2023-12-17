<?php

namespace App\Services;
use App\Models\Inventory;

class CartService
{

    public function addToCart(int $id): array
    {
        // get data from session (this equals Session::get(), use empty array as default)
        $shoppingCart = session('shoppingCart', []);

        if (!isset($shoppingCart[$id])) {
            $inventory = Inventory::findOrFail($id);
            $shoppingCart[$id] = [
                'inventory_id' => $id,
            ];
        }

        // update the session data (this equals Session::put() )
        session(['shoppingCart' => $shoppingCart]);
        return $shoppingCart;
    }


    public function removeFromCart(int $productId): array
    {
        $shoppingCart = session('shoppingCart', []);


        unset($shoppingCart[$productId]);

        // Update the session data
        session(['shoppingCart' => $shoppingCart]);

        return $shoppingCart;
    }

    public function getCartCount(): int
    {
        // Get data from session (use empty array as default)
        $shoppingCart = session('shoppingCart', []);

        // Calculate the total count of items in the cart
        $totalCount = count($shoppingCart);

        return $totalCount;
    }

    public function getCartContent(): array
    {
        $shoppingCart = session('shoppingCart', []);

        return $shoppingCart;
    }
}
