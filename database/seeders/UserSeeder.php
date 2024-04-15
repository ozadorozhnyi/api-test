<?php

declare(strict_types=1);

namespace Database\Seeders;

use Exception;
use Generator;
use App\Models\User;
use App\Traits\Chunkable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
  use Chunkable;

  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    list("count" => $count, "chunk" => $chunk) = config('api.seeder.users');

    DB::beginTransaction();
    User::query()->delete();
    try {
      foreach ($this->chunk($this->users($count), $chunk) as $chunk) {
        User::insert($chunk);
      }
      DB::commit();
    } catch (Exception $e) {
      if (DB::transactionLevel() > 0) {
        DB::rollback();
      }
      throw $e;
    }
  }

  /**
   * Generates a chunk of user's instances.
   *
   * @param integer $count
   * @return Generator
   */
  private function users(int $count): Generator
  {
    $now  = now();

    for ($i = 0; $i < $count; $i++) {
      yield array_merge(
        User::factory()->make()->toArray(),
        [
          'created_at' => $now,
          'updated_at' => $now,
        ]
      );
    }
  }
}
