<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expense_name' => $this->faker->name(),
            'expense_for' => $this->faker->randomElement(['Electricity','Water','Gardening','Cleaning']),
            'amount' => $this->faker->numberBetween(200,2000),
            'paid_at' => $this->faker->dateTimeBetween('-1 year','now'),
            'payment_method' => $this->faker->randomElement(['Credit Card','Bank Transfer','Cash','Cheque']),
            'expense_notes' => $this->faker->text()
        ];
    }
}
