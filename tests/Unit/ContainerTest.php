<?php
use Core\Container;

test('it can resolve something out of the container', function () {
    // arrange
    $container = new Container();

    $container->bind('foo', fn() => 'bar');

    // act - do action
    $result = $container->resolve('foo');

    // assert/expect - confirm whether or not it actually worked
    expect($result)->toEqual('bar');

});