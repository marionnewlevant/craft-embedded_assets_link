$(function () { // for namespacing if nothing else...
  var g_lastRequest = null;

  // called every second to look for new elements to add the embedded asset link to
  var addLinks = function() {
    // find the assets not yet tagged w/ class .embeddedAssetsLink
    // NOTE: trying and failing to filter on data-type attribute...
    var $elements = $('.field .input .element:not(.embeddedAssetsLink)');

    $elements.each(function() {
      var $thisElement = $(this);
      var $label = $thisElement.find('.label');
      $thisElement.addClass('embeddedAssetsLink');

      if ($thisElement.data('type') == 'craft\\elements\\Asset') {
        // phone home to get the embedded asset url for the element
        g_lastRequest = Craft.postActionRequest(
          'embedded-assets-link/default/embedded-asset-url',
          {
            elementType: $thisElement.data('type'),
            elementId: $thisElement.data('id'),
            siteId: $thisElement.data('site-id')
          },
          function(response, textStatus) {
            if (textStatus == 'success' && response && response['assetUrl']) {
              // add the link to the dom
              $thisElement.addClass('embeddedAssetsLinkYes');
              var $a = $('<a>', {
                class: 'embeddedAssetsLink',
                target: '_blank',
                href: response['assetUrl']
              });
              $a.insertBefore($label);
            }
          }
        );
      }
    });
  };

  addLinks();
  window.setInterval(addLinks, 1000);
});