<?php
/**
 * Embedded Assets Link plugin for Craft CMS 3.x
 *
 * Adds a link to the Embedded Asset in the Control Panel
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2019 Marion Newlevant
 */

namespace marionnewlevant\embeddedassetslink\services;

use marionnewlevant\embeddedassetslink\EmbeddedAssetsLink;

use spicyweb\embeddedassets\Plugin as EmbeddedAssets;

use Craft;
use craft\base\Component;

/**
 * @author    Marion Newlevant
 * @package   EmbeddedAssetsLink
 * @since     1.0.0
 */
class EmbeddedAssetsLinkService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function assetUrl(int $elementId, string $elementType, int $siteId)
    {
        $element = Craft::$app->elements->getElementById($elementId, $elementType, $siteId);

        $embeddedAsset = EmbeddedAssets::$plugin->methods->getEmbeddedAsset($element);
        if ($embeddedAsset)
        {
            return $embeddedAsset->url;
        }

        return null;
    }
}
