<?php
/**
 * Embedded Assets Link plugin for Craft CMS 3.x
 *
 * Adds a link to the Embedded Asset in the Control Panel
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2019 Marion Newlevant
 */

namespace marionnewlevant\embeddedassetslink;

use marionnewlevant\embeddedassetslink\assetbundles\EmbeddedAssetsLink\EmbeddedAssetsLinkAsset;

use Craft;
use craft\base\Plugin;

/**
 * Class EmbeddedAssetsLink
 *
 * @author    Marion Newlevant
 * @package   EmbeddedAssetsLink
 * @since     1.0.0
 *
 * @property  EmbeddedAssetsLinkServiceService $embeddedAssetsLinkService
 */
class EmbeddedAssetsLink extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var EmbeddedAssetsLink
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        if (Craft::$app->getRequest()->getIsCpRequest() && !Craft::$app->getUser()->getIsGuest() && !Craft::$app->getRequest()->getIsAjax())
        {
            // Register our asset bundle
            Craft::$app->getView()->registerAssetBundle(EmbeddedAssetsLinkAsset::class);
        }

        Craft::info(
            Craft::t(
                'embedded-assets-link',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

}
