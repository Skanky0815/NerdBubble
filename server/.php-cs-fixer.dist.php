<?php

$finder = PhpCsFixer\Finder::create()->in([
    __DIR__.'/app',
    __DIR__.'/database',
    __DIR__.'/tests',
]);

$config = new PhpCsFixer\Config();

return $config->setRules([
    '@PSR12:risky' => true,
    '@Symfony:risky' => true,
    '@PhpCsFixer:risky' => true,
    '@PHP80Migration:risky' => true,
    '@PHP82Migration' => true,
    'strict_param' => true,
    'declare_strict_types' => true,
    'ordered_class_elements' => true,
    'no_unused_imports' => true,
])->setFinder($finder);
