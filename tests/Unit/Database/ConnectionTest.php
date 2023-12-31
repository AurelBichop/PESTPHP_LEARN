<?php

it('returns a valid PDO instance', function() {

    // ARRANGE
    $connection = new \App\Database\Connection('sqlite::memory:');

    // ACT
    $pdo = $connection->getPdo();

    // ASSERT
    expect($pdo)->toBeInstanceOf(PDO::class);
});
