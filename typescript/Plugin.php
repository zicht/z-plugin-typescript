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
                            ->beforeNormalization()
                                ->always(function($v) {
                                    if (is_file($v)) {
                                        return realpath($v);
                                    }
                                })
                                ->end()
                            ->validate()
                                ->ifTrue(function($f) {
                                    return !is_file($f);
                                })
                                ->thenInvalid('File does not exist. Do you need to install typescript? npm install typescript')
                            ->end()
                        ->end()
                        ->scalarNode('source')->defaultValue('htmldev/src')->end()
                        ->scalarNode('typings_bin')
                            ->defaultValue('./node_modules/typings/dist/bin.js')
                            ->beforeNormalization()
                                ->always(function($v) {
                                    if (is_file($v)) {
                                        return realpath($v);
                                    }
                                })
                                ->end()
                            ->validate()
                                ->ifTrue(function($f) {
                                    return !is_file($f);
                                })
                                ->thenInvalid('File does not exist. Do you need to install typings? npm install typings')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
