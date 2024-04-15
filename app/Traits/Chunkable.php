<?php

declare(strict_types=1);

namespace App\Traits;

use Generator;

trait Chunkable
{
  /**
   * Chunks a generator.
   *
   * @param Generator $generator
   * @param integer $size
   * @return Generator
   */
  private function chunk(Generator $generator, int $size = 100): Generator
  {
    $chunk = [];
    foreach ($generator as $item) {
      $chunk[] = $item;
      if (count($chunk) === $size) {
        yield $chunk;
        $chunk = [];
      }
    }
    if (!empty($chunk)) {
      yield $chunk;
    }
  }
}
