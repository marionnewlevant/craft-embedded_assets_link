<?php
/**
 * Embedded Assets Link plugin for Craft CMS 3.x
 *
 * Adds a link to the Embedded Asset in the Control Panel
 *
 * @link      http://marion.newlevant.com
 * @copyright Copyright (c) 2019 Marion Newlevant
 */

namespace marionnewlevant\embeddedassetslink\controllers;

use marionnewlevant\embeddedassetslink\EmbeddedAssetsLink;

use Craft;
use craft\web\Controller;

/**
 * @author    Marion Newlevant
 * @package   EmbeddedAssetsLink
 * @since     1.0.0
 */
class DefaultController extends Controller
{

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionEmbeddedAssetUrl()
    {
        $this->requireAcceptsJson();

        $elementId = (int)(Craft::$app->getRequest()->getBodyParam('elementId'));
        $elementType = Craft::$app->getRequest()->getBodyParam('elementType');
        $siteId = (int)(Craft::$app->getRequest()->getBodyParam('siteId'));
        
        $assetUrl = EmbeddedAssetsLink::$plugin->embeddedAssetsLinkService->assetUrl($elementId, $elementType, $siteId);
        
        if ($assetUrl)
        {
            $json = $this->asJson([
                'success' => true,
                'assetUrl' => $assetUrl,
            ]);
            return $json;

        }
        else
        {
            $json = $this->asJson([
                'success' => false,
                'error' => 'no assetUrl',
            ]);
            return $json;
        }
    }
}
