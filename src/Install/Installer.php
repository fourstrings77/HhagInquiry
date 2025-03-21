<?php

namespace HhagInquiry\Install;

use Shopware\Core\Framework\Context;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Filter\EqualsFilter;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\DataAbstractionLayer\EntityRepository;
use Shopware\Core\Framework\Uuid\Uuid;
use Shopware\Core\System\Language\LanguageDefinition;
use Shopware\Core\System\StateMachine\StateMachineDefinition;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Installer
{

    private ?EntityRepository $stateMachineRepository;
    private ?EntityRepository $stateMachineStateRepository;
    private ?EntityRepository $stateMachineStateTranslationRepository;
    private ?EntityRepository $languageRepository;

    private ?EntityRepository $numberRangeTypeRepository;
    private ?EntityRepository $numberRangeRepository;
    private Context $context;
    public function __construct(ContainerInterface $container, Context $context)
    {

        $this->stateMachineRepository = $container->get('state_machine.repository');
        $this->stateMachineStateRepository = $container->get('state_machine_state.repository');
        $this->stateMachineStateTranslationRepository = $container->get('state_machine_state_translation.repository');
        $this->languageRepository = $container->get('language.repository');
        $this->numberRangeRepository = $container->get('number_range.repository');
        $this->numberRangeTypeRepository = $container->get('number_range_type.repository');
        $this->context = $context;
    }

    public function createInquiryStates(): void
    {
        $stateExists = (bool) $this->stateMachineRepository->search((new Criteria())->addFilter(
            new EqualsFilter('technicalName', 'inquiry_state')
        ), $this->context)->first();

        if($stateExists){
            return;
        }

        $stateMachineId = Uuid::randomHex();

        $this->stateMachineRepository->create([
            [
                'id' => $stateMachineId,
                'name' => 'Inquiries',
                'technicalName' => 'inquiry_state',
                'createdAt' => new \DateTimeImmutable(),
            ]
        ], $this->context);

        $states = [
            ['technicalName' => 'neu', 'de' => 'Neu', 'en' => 'New'],
            ['technicalName' => 'in_bearbeitung', 'de' => 'In Bearbeitung', 'en' => 'In Progress'],
            ['technicalName' => 'abgeschlossen', 'de' => 'Abgeschlossen', 'en' => 'Completed']
        ];

        $languageId = $this->languageRepository->search(
            (new Criteria())
                ->addFilter(new EqualsFilter('name', 'English')),
            $this->context
        )->first()->getId();

        foreach ($states as $state) {
            $stateId = Uuid::randomHex();

            $this->stateMachineStateRepository->create([
                [
                    'id' => $stateId,
                    'technicalName' => $state['technicalName'],
                    'name' => $state['de'],
                    'stateMachineId' => $stateMachineId,
                    'createdAt' => new \DateTimeImmutable(),
                ]
            ], $this->context);

            $this->stateMachineStateTranslationRepository->insert([
                [
                    'languageId' => $languageId,
                    'stateMachineStateId' => $stateId,
                    'name' => $state['en'],
                    'createdAt' => new \DateTimeImmutable(),
                ]
            ], $this->context);
        }
    }

    public function createInquiryNumberrange(): void {

        $rangeExists = (bool) $this->numberRangeTypeRepository->search((new Criteria())->addFilter(
            new EqualsFilter('technicalName', 'inquiry_number')
        ), $this->context)->first();

        if($rangeExists){
            return;
        }
        $typeId = Uuid::randomHex();
        $this->numberRangeTypeRepository->create([[
            'id' => $typeId,
            'technicalName' => 'inquiry_number',
            'typeName' => 'Inquiry Number',
            'global' => true,
        ]], $this->context);



        $this->numberRangeRepository->create([[
            'id' => Uuid::randomHex(),
            'typeId' => $typeId,
            'global' => true,
            'name' => 'Inquiry Number Range',
            'pattern' => 'INQ-{n}',
            'start' => 10000,
            'description' => 'Nummernkreis für Anfragen',
        ]], $this->context);

    }
}