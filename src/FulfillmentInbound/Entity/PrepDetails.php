<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * A preparation instruction, and who is reponsible for that preparation.
 */
final class PrepDetails
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
