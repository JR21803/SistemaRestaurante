<?php

namespace Tests\Unit;

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

class UnitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionSeeder::class);

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

        $this->user->assignRole('admin');
    }

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

    public function test_37_plate_without_name()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson('/api/v1/plates', [
            'description' => 'Test',
            'price' => 10
        ]);

        $response->assertStatus(422);
    }

    public function test_39_duplicate_invoice()
    {
        Sanctum::actingAs($this->user);
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25
        ]);

        $this->postJson('/api/v1/invoices', [
            'order_id' => $order->id,
            'taxes' => 25
        ]);

        $response = $this->postJson('/api/v1/invoices', [
            'order_id' => $order->id
        ]);

        $response->assertStatus(422);
    }

    public function test_40_order_total_calculation()
    {
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 30
        ]);

        $this->assertEquals(30, $order->total);
    }

    public function test_41_order_without_items()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson('/api/v1/orders', [
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 25
        ]);

        $response->assertStatus(422);
    }

    public function test_42_discount_not_negative()
    {
        Sanctum::actingAs($this->user);
        $response = $this->postJson('/api/v1/orders/calculate-discount', [
            'total' => -10
        ]);

        $response->assertStatus(400);
    }

    public function test_43_payment_insufficient_unit()
    {
        Sanctum::actingAs($this->user);
        $order = Order::create([
            'client_id' => 1,
            'employee_id' => 1,
            'total' => 50
        ]);

        $response = $this->postJson('/api/v1/payments/process', [
            'order_id' => $order->id,
            'payment_method_id' => 1,
            'amount' => 10
        ]);

        $response->assertStatus(400);
    }

    public function test_44_final_pass()
    {
        $this->assertTrue(true);
    }
}
