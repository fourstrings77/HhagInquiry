<?php

namespace HhagInquiry\Content\Extension;

use HhagInquiry\Content\Inquiry\InquiryDefinition;
use HhagInquiry\Content\Inquiry\Mapping\InquiryProductDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Attribute\ManyToOne;
use Shopware\Core\Framework\DataAbstractionLayer\EntityExtension;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToManyAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductExtension extends EntityExtension
{
    public function extendFields(FieldCollection $collection): void
    {
        $collection->add(
            new ManyToManyAssociationField('inquiries', InquiryDefinition::class, InquiryProductDefinition::class, 'product_id', 'inquiry_id')
        );
    }

    public function getDefinitionClass(): string
    {
       return ProductDefinition::class;
    }
}