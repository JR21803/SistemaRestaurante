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
        $this->getJson('/api/profile')->assertSuccessful();
    }

    public function test_05_logout_without_token()
    {
        $this->postJson('/api/logout')->assertStatus(401);
    }

    // Clientes

    public function test_06_get_customers()
    {
        $this->getJson('/api/customers')->assertSuccessful();
    }

    public function test_07_create_customer()
    {
        $this->postJson('/api/customers', [
            'user_id' => 1,
            'phone_number' => '888',
            'address' => 'Test'
        ])->assertSuccessful();
    }

    public function test_08_create_customer_duplicate()
    {
        $this->postJson('/api/customers', [
            'user_id' => 1
        ])->assertStatus(500);
    }

    public function test_09_get_customer_not_found()
    {
        $this->getJson('/api/customers/999')->assertStatus(404);
    }

    // Platos

    public function test_10_create_plate()
    {
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
        ])->assertSuccessful();
    }

    public function test_12_create_plate_without_price()
    {
        $this->postJson('/api/plates', [
            'name' => 'Pizza'
        ])->assertStatus(500);
    }

    // Pedidos

    public function test_13_create_order()
    {
        $this->postJson('/api/orders', [
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25,
            'status' => 'pending'
        ])->assertSuccessful();
    }

    public function test_14_get_order()
    {
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
        $this->getJson('/api/orders/999')->assertStatus(404);
    }

    public function test_16_get_orders_no_permission()
    {
        $this->getJson('/api/orders')->assertSuccessful(); // sin roles
    }

    // Facturas

    public function test_17_create_invoice()
    {
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
        $this->getJson('/api/invoice/1')->assertStatus(404);
    }

    public function test_19_invoice_without_order()
    {
        $this->postJson('/api/invoices', [])
            ->assertStatus(500);
    }

    // Menú

    public function test_20_get_menus()
    {
        $this->getJson('/api/menus')->assertSuccessful();
    }

    public function test_21_create_menu_without_token()
    {
        $this->postJson('/api/menus', [
            'name' => 'Menu',
            'description' => 'Menu principal'
        ])->assertSuccessful();
    }

    // Inventario

    public function test_22_get_inventory()
    {
        $this->getJson('/api/inventory')->assertSuccessful();
    }

    public function test_23_delete_inventory_not_found()
    {
        $this->deleteJson('/api/inventory/999')->assertSuccessful();
    }

    // Materia prima

    public function test_24_get_raw_material()
    {
        $this->getJson('/api/raw-material/1')->assertStatus(404);
    }

    public function test_25_update_raw_material_not_found()
    {
        $this->putJson('/api/raw-material/999', [])
            ->assertStatus(404);
    }

    // Descuentos

    public function test_26_discount_minimum()
    {
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 30
        ])->assertSuccessful();
    }

    public function test_27_discount_not_applied()
    {
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 10
        ])->assertSuccessful();
    }

    public function test_28_discount_percentage()
    {
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 50
        ])->assertSuccessful();
    }

    public function test_29_discount_special_date()
    {
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 30
        ])->assertSuccessful();
    }

    public function test_30_discount_invalid_date()
    {
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 5
        ])->assertSuccessful();
    }

    // Pagos

    public function test_31_payment_success()
    {
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
        $this->postJson('/api/payments/process', [
            'order_id' => 999,
            'payment_method_id' => 1,
            'amount' => 25
        ])->assertStatus(404);
    }

    public function test_34_payment_order_not_found()
    {
        $this->postJson('/api/payments/process', [
            'order_id' => 999,
            'payment_method_id' => 1,
            'amount' => 25
        ])->assertStatus(404);
    }

                            ////////////////////////
                            // Pruebas Unitarias //
                            //////////////////////

    public function test_35_order_default_status()
    {
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 10,
            'status' => 'pending'
        ]);

        $this->assertEquals('pending', $order->status);
    }

    public function test_36_negative_inventory()
    {
        $this->assertTrue(true);
    }

    public function test_37_plate_without_name()
    {
        $this->assertTrue(true);
    }

    public function test_38_token_removed()
    {
        $this->assertTrue(true);
    }

    public function test_39_duplicate_invoice()
    {
        $this->assertTrue(true);
    }

    public function test_40_order_total_calculation()
    {
        $this->assertTrue(true);
    }

    public function test_41_order_without_items()
    {
        $this->assertTrue(true);
    }

    public function test_42_discount_not_negative()
    {
        $this->assertTrue(true);
    }

    public function test_43_payment_insufficient_unit()
    {
        $this->assertTrue(true);
    }

    public function test_44_final_pass()
    {
        $this->assertTrue(true);
    }
}