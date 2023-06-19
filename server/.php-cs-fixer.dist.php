<?php

$finder = PhpCsFixer\Finder::create()->in([
    __DIR__.'/database',
    __DIR__.'/tests',
    __DIR__.'/src',
]);

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12' => true,
    '@Symfony' => true,
    '@PhpCsFixer' => true,
    '@PHP80Migration' => true,
    '@PHP82Migration' => true,
    'strict_param' => true,
    'declare_strict_types' => true,
    'ordered_class_elements' => true,
    'no_unused_imports' => true,
])->setFinder($finder);
