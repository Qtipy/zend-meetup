<?php

declare(strict_types=1);

namespace Meetup\Controller;

use Meetup\Entity\Meetup;
use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;

    /**
     * @var MeetupForm
     */
    private $meetupForm;

    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetup' => $this->meetupRepository->findAll(),
        ]);
    }
    public function meetupAction()
    {
            return new ViewModel([
                    $id = $this->params()->fromRoute( 'id' ),
                    'meetup' => $this->meetupRepository->find($id),
            ]);
    }

    public function addAction()
    {
        $form = $this->meetupForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $meetup = $this->meetupRepository->createMeetupFromNameAndDescriptionAndDatestartAndDateend(
                    $form->getData()['title'],
                    $form->getData()['description'],
                    $form->getData()['dateStart'],
                    $form->getData()['dateEnd']
                );
                $this->meetupRepository->add($meetup);
                return $this->redirect()->toRoute('meetup');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function updateAction()
    {
        $form = $this->meetupForm;

        $id = $this->params()->fromRoute( 'id' );

        $meetup = $this->meetupRepository ->find($id);

        $form->bind($meetup);


        /* @var $request Request */
        $request = $this->getRequest();
        if($request->isPost())
        {
                $form->setData($request->getPost());
                if($form->isValid())
                {
                        $meetup = $form->getData();
                        $this->meetupRepository->save($meetup);
                        return $this->redirect()->toRoute('meetup');
                }
        }

        $form->prepare();

        return new ViewModel([
        'form' => $form,
        'meetup' => $meetup,
        ]);
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');
        $this->meetupRepository->delete($id);
        return $this->redirect()->toRoute('meetup');
    }
}
