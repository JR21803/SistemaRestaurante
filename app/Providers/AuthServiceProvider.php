<?php

namespace App\Providers;

use App\Models\IngredientInventory;
use App\Models\Menu;
use App\Models\Order;
use App\Models\User;
use App\Policies\InventoryPolicy;
use App\Policies\MenuPolicy;
use App\Policies\OrderPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $policies = [
        Order::class => OrderPolicy::class,
        User::class => UserPolicy::class,
        Menu::class => MenuPolicy::class,
        IngredientInventory::class => InventoryPolicy::class,
    ];


    public function boot(): void
    {
        
    }
}
