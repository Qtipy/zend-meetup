<?php

declare(strict_types=1);

namespace Meetup\Form;

use Meetup\Entity\Meetup;
use Doctrine\ORM\EntityManager;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class MeetupForm extends Form implements InputFilterProviderInterface
{

        public function __construct(EntityManager $entityManager)
    {
        parent::__construct('meetup');

        $hydrator = new DoctrineHydrator($entityManager, Meetup::class);

        $this->setHydrator($hydrator);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Titre',
            ],
            'attributes' => [
                    'class' => 'form-control',
            ],
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                    'class' => 'form-control',
            ],
        ]);

        $this->add([
                'type' => Element\Text::class,
                'name' => 'dateStart',
                'options' => [
                        'label' => 'Date de début',
                ],
                'attributes' => [
                        'class' => 'form-control',
                        'id' => 'datetimepickerStart',
                ],
        ]);

        $this->add([
                'type' => Element\Text::class,
                'name' => 'dateEnd',
                'options' => [
                        'label' => 'Date de fin',
                ],
                'attributes' => [
                        'class' => 'form-control',
                        'id' => 'datetimepickerEnd',
                ],
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-primary',
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 3,
                            'max' => 45,
                        ],
                    ],
                ],
            ],
        ];
    }
}
