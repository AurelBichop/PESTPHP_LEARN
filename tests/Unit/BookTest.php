<?php


test('a book can be created using a named constructor', function () {

    $author = \App\Entity\Author::create(
        id: 321,
        name: 'John Doe',
        bio: 'This is a bio'
    );

    // ACT
    $book = \App\Entity\Book::create(
        id: 123,
        title: 'Test book',
        yearPublished: 1999,
        author: $author
    );

    // ASSERT
    expect($book)->toBeInstanceOf(\App\Entity\Book::class)
        ->and($book->getId())->toBe(123)
        ->and($book->title)->toBe('Test book')
        ->and($book->yearPublished)->toBe(1999)
        ->and($book->author)->toBe($author)
        ->and($book->author->name)->toBe('John Doe')
        ->and(json_encode($book))->toMatchJson([
            'id' => 123,// private props won't be serialized
            'title' => 'Test book',
            'yearPublished' => 1999,
            'author' => [
                'id' => 321,
                'name' => 'John Doe',
                'bio' => 'This is a bio'
            ]
        ])
    ;
});