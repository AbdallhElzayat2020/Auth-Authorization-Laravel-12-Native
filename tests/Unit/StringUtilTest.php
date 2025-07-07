<?php

test('string can be reversed', function () {
    // Arrange
    $original = 'Hello World';
    
    // Act
    $reversed = strrev($original);
    
    // Assert
    expect($reversed)->toBe('dlroW olleH');
});

test('string can be converted to uppercase', function () {
    // Arrange
    $original = 'hello world';
    
    // Act
    $uppercase = strtoupper($original);
    
    // Assert
    expect($uppercase)->toBe('HELLO WORLD');
});