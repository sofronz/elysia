<?php

// .php-cs-fixer.php

use PhpCsFixer\Config;
use PhpCsFixer\Fixer\Basic\BlankLineAfterOpeningTagFixer;
use PhpCsFixer\Fixer\Basic\NoEmptyStatementFixer;
use PhpCsFixer\Fixer\ControlStructure\SwitchCaseSemicolonFixer;
use PhpCsFixer\Fixer\FunctionNotation\NoSpacesAfterFunctionNameFixer;

return (new Config())
    ->setRules([
        '@PSR2' => true, // Apply PSR-2 standards
        'array_syntax' => ['syntax' => 'short'], // Use short array syntax []
        'binary_operator_spaces' => [
            'default' => 'align_single_space_minimal', // Align binary operators with minimal space
        ],
        'blank_line_after_opening_tag' => true, // Add a blank line after opening PHP tag
        'no_empty_statement' => true, // Remove empty statements
        'switch_case_space' => true, // Ensure that switch case statements are properly formatted
        'no_spaces_after_function_name' => true, // Remove spaces after function names
        'ordered_imports' => [
            'sort_algorithm' => 'length',
        ],
    ])
    ->setFinder(
        (new PhpCsFixer\Finder())
            ->in(__DIR__) // Targeting the current directory (project root)
            ->notPath('vendor') // Exclude the vendor folder
            ->name('*.php') // Only target PHP files
    );
