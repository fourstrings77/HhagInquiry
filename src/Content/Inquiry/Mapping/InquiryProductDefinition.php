<?php

namespace HhagInquiry\Content\Inquiry\Mapping;

use HhagInquiry\Content\Inquiry\InquiryEntityDefinition;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\FkField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\ManyToOneAssociationField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;
use Shopware\Core\Framework\DataAbstractionLayer\MappingEntityDefinition;

class InquiryProductDefinition extends MappingEntityDefinition
{

    public const ENTITY_NAME = 'hhag_inquiry_product';
    public function getEntityName(): string
    {
        return self::ENTITY_NAME;
    }

    protected function defineFields(): FieldCollection
    {
        return new FieldCollection([
            (new FkField('inquiry_id', 'inquiryId', InquiryEntityDefinition::class))->addFlags(new PrimaryKey(), new Required()),
            (new FkField('product_id', 'productId', ProductDefinition::class))->addFlags(new PrimaryKey(), new Required()),

            new ManyToOneAssociationField('inquiry', 'inquiry_id', InquiryEntityDefinition::class, 'id'),
            new ManyToOneAssociationField('product', 'product_id', ProductDefinition::class, 'id'),
        ]);
    }
}