<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

use SellerWorks\Amazon\Common\Serializer\MetadataInterface;

/**
 * A preparation instruction, and who is reponsible for that preparation.
 */
final class PrepDetails implements MetadataInterface
{
    /**
     * @var PrepInstruction
     */
    public $PrepInstruction;

    /**
     * @var string
     */
    public $PrepOwner;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'PrepInstruction'   => ['type' => 'choice', 'choices' => [
                'Polybagging',
                'BubbleWrapping',
                'Taping',
                'BlackShrinkWrapping',
                'Labeling',
                'HangGarment',
            ]],
            'PrepOwner'         => ['type' => 'choice', 'choices' => ['AMAZON', 'SELLER']],
        ];
    }
}
