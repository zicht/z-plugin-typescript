<?php
/**
 * @author Joppe Aarts <joppe@zicht.nl>
 * @copyright Zicht Online <http://zicht.nl>
 */

namespace Zicht\Tool\Plugin\Typescript;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Zicht\Tool\Plugin as BasePlugin;

/**
 * Class Plugin
 *
 * @package Zicht\Tool\Plugin\Typescript
 */
class Plugin extends BasePlugin
{
    /**
     * @param ArrayNodeDefinition $rootNode
     * @return void
     */
    public function appendConfiguration(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('typescript')
                    ->children()
                        ->scalarNode('bin')
                            ->defaultValue('./node_modules/typescript/bin/tsc')
                        ->end()
                        ->scalarNode('source')
                            ->defaultValue('htmldev/src')
                        ->end()
                        ->scalarNode('typings_bin')
                            ->defaultValue('./node_modules/typings/dist/bin.js')
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
