<?php

it('retrieves the correct book 1 data from the book API', function(){
    //ARRANGE

    //ACT
    $response = $this->json(method: 'GET',uri: '/book/1');

    //ASSERT
    expect($response->getStatusCode())->toBe(200)
        ->and($response->getBody())->toMatchJson([
            'id' => 1,
            'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
            'year_published' => 2008,
            'author' => [
                'id' => 1,
                'name' => 'Robert C. Martin',
                'bio' => 'This is an author'
            ]
        ]);
});

it('retrieves the correct book 2 data from the book API', function(){
    //ARRANGE

    //ACT
    $response = $this->json(method: 'GET',uri: '/book/2');

    //ASSERT
    expect($response->getStatusCode())->toBe(200)
        ->and($response->getBody())->toMatchJson([
            'id' => 2,
            'title' => 'Refactoring: Improving the Design of Existing Code',
            'year_published' => 1999,
            'author' => [
                'id' => 2,
                'name' => 'Martin Fowler',
                'bio' => 'Martin\'s bio'
            ]
        ]);
});