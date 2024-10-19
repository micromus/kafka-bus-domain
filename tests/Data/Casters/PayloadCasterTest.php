<?php

use Micromus\KafkaBusMessages\Data\Casters\PayloadCaster;
use Micromus\KafkaBusMessages\Workbench\Data\CategoryPayload;

it('can cast an array', function () {
    $caster = new PayloadCaster(CategoryPayload::class);

    $rawAttributes = [
        'id' => 202410192219,
        'name' => 'Тестовая категория',
    ];

    /** @var CategoryPayload $castedValue */
    $castedValue = $caster->cast($rawAttributes, 'category');

    expect($castedValue)
        ->toBeInstanceOf(CategoryPayload::class)
        ->and($castedValue->id)
        ->toBe(202410192219)
        ->and($castedValue->name)
        ->toBe('Тестовая категория');
});

it('can cast from array when value is null', function () {
    $castedValue = (new PayloadCaster(CategoryPayload::class, true))
        ->cast(null, 'category');

    expect($castedValue)
        ->toBeNull();
});


it('can not cast from array when value is not array', function () {
    (new PayloadCaster(CategoryPayload::class))
        ->cast(202410192219, 'category');
})->throws(InvalidArgumentException::class);

it('can not cast from array when value is null', function () {
    (new PayloadCaster(CategoryPayload::class))
        ->cast(null, 'category');
})->throws(InvalidArgumentException::class);
