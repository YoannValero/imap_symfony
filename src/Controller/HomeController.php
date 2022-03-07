<?php

namespace App\Controller;

use App\Entity\Email;
use App\Repository\EmailRepository;
use Doctrine\Persistence\ManagerRegistry;
use SecIT\ImapBundle\Service\Imap;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $connection;

    public function __construct(Imap $imap) {
        $this->connection = $imap->get('example_connection');
    }
    /**
     * @Route("/mails", name="app_home")
     */
    public function index(ManagerRegistry $em): Response
    {  
        $mails_ids = $this->connection->searchMailbox('UNSEEN');
        
        $emails = [];

        foreach ($mails_ids as $mail_id ) {
            $email = $this->connection->getMail($mail_id, false);

            $emails[] = [
                "from" => (isset($email->fromName)) ? $email->fromAddress : "",
                "to" => $email->to ,
                "subject" => $email->subject,
	            "message_id" =>$mail_id,
	            "date" =>$email->date,
                // "text" => $email->textHtml
            ];            
        }

        // $email = $this->connection->getMail($mails_ids[50], false);

        // $emails[] = [
        //     "from" => (isset($email->fromName)) ? $email->fromAddress : "",
        //     "to" => $email->to ,
        //     "subject" => $email->subject,
        //     "message_id" =>$mails_ids[50],
        //     "text" => $email->textHtml
        // ];          

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "mails" => $emails
        ]);
    }


    /**
     * @Route("/mails/{mail_id}", name="get_mail")
     */
    public function getMail($mail_id) {
        $email =  $this->connection->getMail($mail_id, false);

        return $this->render('home/mail.html.twig', [
            "mail" => $email
        ]);
    }

    /**
     * @Route("/mails/{mail_id}/iframe", name="display_mail_iframe")
     */
    public function displayEmailOnIframe($mail_id) {

        $email = $this->connection->getMail($mail_id, false);

        return new Response($email->textHtml);
    }
}