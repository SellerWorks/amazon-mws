<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Preparation instructions for shipping an item to the Amazon Fulfillment Network.
 */
final class PrepInstruction
{
    const POLYBAGGING = 'Polybagging';                      // Indicates that polybagging is required.
    const BUBBLE_WRAPPING = 'BubbleWrapping';               // Indicates that bubble wrapping is required.
    const TAPING = 'Taping'                                 // Indicates that taping is required.
    const BLACK_SHRINK_WRAPPING = 'BlackShrinkWrapping';    // Indicates that black shrink wrapping is required.
    const LABELING = 'Labeling';                            // Indicates that the FNSKU label should be applied to the item.
    const HANG_GARMENT = 'HangGarment';                     // Indicates that the item should be placed on a hanger.
}
