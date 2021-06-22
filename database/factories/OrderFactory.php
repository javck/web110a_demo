<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = $this->faker->randomElement(['A','B','C']);
        $paid = rand(0,1);
        if($paid){
            $pay_type = $this->faker->randomElement(['P01','P02','P03','P04']);
        }else{
            $pay_type = null;
        }
        return [
            'serial' => $status . '-' . $this->faker->isbn13,
            'user_id' => rand(1,10),
            'status' =>  $this->faker->randomElement(['TBC','TBP','ALC','ALD','CLD']),
            'type' => $status,
            'schedule_at' => Carbon::now()->addDays(rand(0,7)),
            'table_serial' => $this->faker->optional()->randomElement(['A','B','C','D','E','F']) . rand(1,30),
            'pay_type' => $pay_type,
            'receive_name' => $this->faker->name,
            'receive_phone' => $this->faker->phoneNumber,
            'receive_address' => $this->faker->address,
            'paided' => $paid,
            'remark' => $this->faker->optional()->realText(100),
            'paid_serial' => $this->faker->isbn13,
            'paid_remark' => $this->faker->optional()->realText(100),
            'total' => rand(1000,100000)
        ];
    }
}
