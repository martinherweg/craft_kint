<?php
/**
 * Kint plugin for Craft CMS
 *
 * Adds Kint, an in-app PHP debugger, for use in Twig and PHP.
 **
 * @author    Mildly Geeky
 * @copyright Copyright (c) 2016 Mildly Geeky
 * @link      http://www.mildlygeeky.com
 * @package   Kint
 * @since     1.1.0
 */

namespace Craft;

class KintPlugin extends BasePlugin
{
    public function init()
    {
        require_once __DIR__ . '/vendor/autoload.php';
        $settings = craft()->plugins->getPlugin('kint')->getSettings();
        \Kint_Renderer_Rich::$theme = $settings->kintDisplayTheme;
        \Kint::$max_depth = $settings->kintMaxDepth;


        /**
         * ddd() was removed from kint core so we have to create it on our own and alias it in kint
         * @param array ...$v
         */
        function ddd(...$v){
            d(...$v);
            exit;
        }
        \Kint::$aliases[] = 'ddd';
    }

    public function getName()
    {
         return 'Kint';
    }

    public function getDescription()
    {
        return Craft::t('Adds Kint, an in-app PHP debugger, for use in Twig and PHP.');
    }

    public function getDocumentationUrl()
    {
        return 'https://github.com/mildlygeeky/craft_kint/blob/master/README.md';
    }

    public function getReleaseFeedUrl()
    {
        return 'https://raw.githubusercontent.com/mildlygeeky/craft_kint/master/releases.json';
    }

    public function getVersion()
    {
        return '1.1.0';
    }

    public function getSchemaVersion()
    {
        return '1.0.0';
    }

    public function getDeveloper()
    {
        return 'Mildly Geeky';
    }

    public function getDeveloperUrl()
    {
        return 'https://www.mildlygeeky.com';
    }

    protected function defineSettings()
    {
        return array(
            'kintDisplayTheme' => array(
                AttributeType::Mixed,
                'default' => 'original.css'
            ),
            'kintMaxDepth' => array(
                AttributeType::String,
                'default' => '7'
            )
        );
    }

    public function getSettingsHtml()
    {
       return craft()->templates->render('kint/settings', array(
           'settings' => $this->getSettings()
       ));
   }

    public function addTwigExtension()
    {
        Craft::import('plugins.kint.twigextensions.KintTwigExtension');
        return new KintTwigExtension();
    }

}
