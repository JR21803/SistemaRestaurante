<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Ingredient;
use App\Models\Plate;
use Laravel\Sanctum\Sanctum;


class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123456')
        ]);

        

        $this->client = Client::create([
            'user_id' => 1,
            'phone_number' => '77777777',
            'address' => 'San Salvador'
        ]);

        $this->employee = Employee::create([
            'user_id' => 1,
            'phone_number' => '77777777',
            'salary' => 500
        ]);

        $this->paymentMethod = PaymentMethod::create([
            'name' => 'cash'
        ]);
    }

    // Autenticación

    public function test_01_login_success()
    {
        $this->postJson('/api/login', [
            'email' => 'admin@test.com',
            'password' => '123456'
        ])->assertSuccessful();
    }

    public function test_02_login_wrong_password()
    {
        $this->postJson('/api/login', [
            'email' => 'admin@test.com',
            'password' => 'wrong'
        ])->assertStatus(401);
    }

    public function test_03_login_email_not_found()
    {
        $this->postJson('/api/login', [
            'email' => 'fake@test.com',
            'password' => '123456'
        ])->assertStatus(401);
    }

    public function test_04_profile()
    {

        $this->actingAs($this->user);

        $this->getJson('/api/profile')->assertSuccessful();
    }

    public function test_05_logout_without_token()
    {
        $this->postJson('/api/logout')->assertStatus(401);
    }

    // Clientes

    public function test_06_get_customers()
    {
        Sanctum::actingAs($this->user);
        $this->getJson('/api/customers')->assertSuccessful();
    }

    public function test_07_create_customer()
    {
        Sanctum::actingAs($this->user);


        $user2 = User::create([
            'name' => 'user2',
            'email' => 'user2@test.com',
            'password' => bcrypt('123456')
        ]);



        $this->postJson('/api/customers', [
            'user_id' => 2,
            'phone_number' => '888',
            'address' => 'Test'
        ])->assertSuccessful();
    }

    public function test_08_create_customer_duplicate()
    {
        Sanctum::actingAs($this->user);

        $this->postJson('/api/customers', [
            'user_id' => 1,
            'phone_number' => '99990000',
            'address' => 'Test'
        ])->assertStatus(422);
    }

    public function test_09_get_customer_not_found()
    {
        Sanctum::actingAs($this->user);
        $this->getJson('/api/customers/999')->assertStatus(404);
    }

    // Platos

    public function test_10_create_plate()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/plates', [
            'name' => 'Pizza',
            'description' => 'Pizza italiana',
            'price' => 10
        ])->assertSuccessful();
    }

    public function test_11_create_plate_without_token()
    {

        $this->postJson('/api/plates', [
            'name' => 'Pizza',
            'description' => 'Pizza italiana',
            'price' => 10
        ])->assertStatus(401);
    }

    public function test_12_create_plate_without_price()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/plates', [
            'name' => 'Pizza',
            'description' => 'Test'
        ])->assertStatus(422);
    }

    // Pedidos

    public function test_13_create_order()
    {
        Sanctum::actingAs($this->user);


        $plate = Plate::create([
            'name' => 'Test',
            'description' => 'Test',
            'price' => 10
        ]);

        $this->postJson('/api/orders', [
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25,
            'status' => 'pending',
            'items' => [
                [
                    'plate_id' => $plate->id,
                    'quantity' => 2,
                    'price' => 10
                ]
            ]
        ])->assertSuccessful();
    }

    public function test_14_get_order()
    {
        Sanctum::actingAs($this->user);
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25,
            'status' => 'pending'
        ]);

        $this->getJson("/api/orders/$order->id")->assertSuccessful();
    }

    public function test_15_get_order_not_found()
    {
        Sanctum::actingAs($this->user);
        $this->getJson('/api/orders/999')->assertStatus(404);
    }

    public function test_16_get_orders_no_permission()
    {
        $this->getJson('/api/orders')->assertStatus(401); // sin roles
    }

    // Facturas

    public function test_17_create_invoice()
    {
        Sanctum::actingAs($this->user);
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25,
            'status' => 'pending'
        ]);

        $this->postJson('/api/invoices', [
            'order_id' => $order->id
        ])->assertSuccessful();
    }

    public function test_18_get_invoice()
    {
        Sanctum::actingAs($this->user);
        $this->getJson('/api/invoice/1')->assertStatus(404);
    }

    public function test_19_invoice_without_order()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/invoices', [])
            ->assertStatus(422);
    }

    // Menú

    public function test_20_get_menus()
    {
        Sanctum::actingAs($this->user);

        $this->getJson('/api/menus')->assertSuccessful();
    }

    public function test_21_create_menu_without_token()
    {
        $this->postJson('/api/menus', [
            'name' => 'Menu',
            'description' => 'Menu principal'
        ])->assertStatus(401);
    }

    // Inventario

    public function test_22_get_inventory()
    {
        Sanctum::actingAs($this->user);
        $this->getJson('/api/inventory')->assertSuccessful();
    }

    public function test_23_delete_inventory_not_found()
    {
        Sanctum::actingAs($this->user);
        $this->deleteJson('/api/inventory/999')->assertStatus(404);
    }

    // Materia prima

    public function test_24_get_raw_material()
    {
        Sanctum::actingAs($this->user);
        $this->getJson('/api/raw-material/1')->assertStatus(404);
    }

    public function test_25_update_raw_material_not_found()
    {
        Sanctum::actingAs($this->user);
        $this->putJson('/api/raw-material/999', [])
            ->assertStatus(404);
    }

    // Descuentos

    public function test_26_discount_minimum()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 30
        ])->assertSuccessful();
    }

    public function test_27_discount_not_applied()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 10
        ])->assertSuccessful();
    }

    public function test_28_discount_percentage()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 50
        ])->assertSuccessful();
    }

    public function test_29_discount_special_date()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 30
        ])->assertSuccessful();
    }

    public function test_30_discount_invalid_date()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 5
        ])->assertSuccessful();
    }

    // Pagos

    public function test_31_payment_success()
    {
        Sanctum::actingAs($this->user);
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25,
            'status' => 'pending'
        ]);

        $this->postJson('/api/payments/process', [
            'order_id' => $order->id,
            'payment_method_id' => 1,
            'amount' => 25
        ])->assertSuccessful();
    }

    public function test_32_payment_insufficient()
    {
        Sanctum::actingAs($this->user);
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25
        ]);

        $this->postJson('/api/payments/process', [
            'order_id' => $order->id,
            'payment_method_id' => 1,
            'amount' => 10
        ])->assertStatus(400);
    }

    public function test_33_payment_valid_method()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/payments/process', [
            'order_id' => 999,
            'payment_method_id' => 1,
            'amount' => 25
        ])->assertStatus(404);
    }

    public function test_34_payment_order_not_found()
    {
        Sanctum::actingAs($this->user);
        $this->postJson('/api/payments/process', [
            'order_id' => 999,
            'payment_method_id' => 1,
            'amount' => 25
        ])->assertStatus(404);
    }


}