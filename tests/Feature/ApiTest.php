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

// MATRIZ DE PRUEBAS

class ApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // USER
        $this->user = User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('123456')
        ]);

        // CLIENT
        $this->client = Client::create([
            'user_id' => 1,
            'phone_number' => '77777777',
            'address' => 'San Salvador'
        ]);

        // EMPLOYEE
        $this->employee = Employee::create([
            'user_id' => 1,
            'phone_number' => '77777777',
            'salary' => 500
        ]);

        // PAYMENT METHOD
        $this->paymentMethod = PaymentMethod::create([
            'name' => 'cash'
        ]);

        // INGREDIENT
        $this->ingredient = Ingredient::create([
            'name' => 'Pollo',
            'category' => 'Carne',
            'measurement_unit' => 'kg',
            'description' => 'Fresco',
            'stock' => 100
        ]);
    }

    // LOGIN OK
    public function test_login_success()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@test.com',
            'password' => '123456'
        ]);

        $response->assertSuccessful();
    }

    // LOGIN FAIL
    public function test_login_fail()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'admin@test.com',
            'password' => 'wrong'
        ]);

        $response->assertStatus(401);
    }

    // CUSTOMER
    public function test_customer_crud()
    {
        $create = $this->postJson('/api/customers', [
            'user_id' => 1,
            'phone_number' => '88888888',
            'address' => 'Santa Ana'
        ]);
        $create->assertSuccessful();

        $this->getJson('/api/customers')->assertSuccessful();
        $this->getJson('/api/customers/1')->assertSuccessful();

        $this->putJson('/api/customers/1', [
            'address' => 'Updated'
        ])->assertSuccessful();

        $this->deleteJson('/api/customers/1')->assertSuccessful();
    }

    // PLATES
    public function test_plate_crud()
    {
        $this->postJson('/api/plates', [
            'name' => 'Pizza',
            'description' => 'Grande',
            'price' => 10
        ])->assertSuccessful();

        $this->getJson('/api/plates')->assertSuccessful();
        $this->getJson('/api/plates/1')->assertSuccessful();

        $this->putJson('/api/plates/1', [
            'price' => 12
        ])->assertSuccessful();

        $this->deleteJson('/api/plates/1')->assertSuccessful();
    }

    // ORDERS
    public function test_order_crud()
    {
        $this->postJson('/api/orders', [
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25,
            'status' => 'pending'
        ])->assertSuccessful();

        $this->getJson('/api/orders')->assertSuccessful();
        $this->getJson('/api/orders/1')->assertSuccessful();

        $this->putJson('/api/orders/1', [
            'status' => 'completed'
        ])->assertSuccessful();

        $this->deleteJson('/api/orders/1')->assertSuccessful();
    }

    // DISCOUNT
    public function test_discount()
    {
        $this->postJson('/api/orders/calculate-discount', [
            'total' => 30
        ])->assertSuccessful();
    }

    // PAYMENT
    public function test_payment_flow()
    {
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25,
            'status' => 'pending'
        ]);

        // éxito
        $this->postJson('/api/payments/process', [
            'order_id' => $order->id,
            'payment_method_id' => 1,
            'amount' => 25
        ])->assertSuccessful();

        // error monto
        $this->postJson('/api/payments/process', [
            'order_id' => $order->id,
            'payment_method_id' => 1,
            'amount' => 10
        ])->assertStatus(400);
    }

    // INVOICE
    public function test_invoice()
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

        $this->getJson('/api/invoices')->assertSuccessful();
        $this->getJson('/api/invoice/1')->assertSuccessful();
    }

    // INVENTORY
    public function test_inventory()
    {
        $this->postJson('/api/inventory', [
            'ingredient_id' => 1,
            'amount' => 100,
            'purchase_date' => '2026-04-01',
            'expiration_date' => '2026-05-01',
            'unit_cost' => 2
        ])->assertSuccessful();

        $this->getJson('/api/inventory')->assertSuccessful();

        $this->putJson('/api/inventory/1', [
            'amount' => 80,
            'purchase_date' => '2026-04-01',
            'expiration_date' => '2026-05-01',
            'unit_cost' => 2    
        ])->assertSuccessful();

        $this->deleteJson('/api/inventory/1')->assertSuccessful();
    }

    // RAW MATERIAL
    public function test_raw_material()
    {
        $this->postJson('/api/raw-material', [
            'name' => 'Carne',
            'category' => 'Carne',
            'measurement_unit' => 'kg',
            'description' => 'Fresco'
        ])->assertSuccessful();

        $this->getJson('/api/raw-material')->assertSuccessful();
        $this->getJson('/api/raw-material/1')->assertSuccessful();

        $this->putJson('/api/raw-material/1', [
            'name' => 'Carne Premium'
        ])->assertSuccessful();

        $this->deleteJson('/api/raw-material/1')->assertSuccessful();
    }
}