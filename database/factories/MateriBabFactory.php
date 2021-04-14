<?php

namespace Database\Factories;

use App\Models\TrainingChapter;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingChapterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrainingChapter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'materi_id' => $this->faker->word,
        'video' => $this->faker->word,
        'keterangan' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
