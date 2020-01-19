<?php


namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Department;
use App\Notification\ContactNotification;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class APIContactController extends AbstractController
{


    /**
     * If the request is valid, store the contact data
     * and send an email using ContactNotification
     *
     * @param Request $request
     * @param ContactNotification $notification
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @return Response
     */
    public function addContact(Request $request, ContactNotification $notification,
                               EntityManagerInterface $entityManager, ValidatorInterface $validator): Response {

            $data = json_decode($request->getContent());
            $contact = new Contact();
            $contact->setFirstname($data->firstname);
            $contact->setLastname($data->lastname);
            $contact->setEmail($data->email);
            $contact->setMessage($data->message);
            $department = $this->getDoctrine()->getRepository(Department::class)->find($data->department);
            $contact->setDepartment($department);

            $errors = $validator->validate($contact);

            if (count($errors) > 0) {
                $errorsString = (string) $errors;
                return new Response($errorsString, 400);
            }

            // Send an email to the department's manager
            $notification->notify($contact);

            $entityManager->persist($contact);
            $entityManager->flush();

            return new Response('Request Successful', 201);

        }

}