<?php

namespace Tbb\Form\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * Booking action
     *
     * @return void
     */
    protected $_pageFactory;


    public function execute()
    {
        // 1. POST request : Get booking data
        $post = (array) $this->getRequest()->getPost();

        if (!empty($post)) {
            // Retrieve your form data
            $firstname   = $post['firstname'];
            $lastname    = $post['lastname'];
            $phone       = $post['phone'];
            $bookingDate = $post['bookingDate'];
            $bookingTime = $post['bookingTime'];
            $email       = $post['email'];

// Send Mail functionality starts from here
            $from = $post['email'];
            $nameFrom = $firstname.' '.$lastname;
            $to = "louise@burhouse.com";
            $nameTo = "Burhouse";
            $body = "
                <div>
                    <div>Name: ".$firstname." ".$lastname."</div>              
                    <div>Email: ".$email."</div>
                    <div>Booking Date/Time: ".$bookingDate." @ ".$bookingTime."</div>
                </div>";

            $email = new \Zend_Mail();
            $email->setSubject("Visit showroom booking form");
            $email->setBodyHtml($body);     // use it to send html data
//$email->setBodyText($body);   // use it to send simple text data
            $email->setFrom($from, $nameFrom);
            $email->addTo($to, $nameTo);
            $email->send();



            // Doing-something with...

            // Display the succes form validation message
            $this->messageManager->addSuccessMessage('Your message has been sent!');

            // Redirect to your form page (or anywhere you want...)
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/booking');

            return $resultRedirect;
        }
        // 2. GET request : Render the booking page
        $this->_view->loadLayout();
        $this->_view->renderLayout();

    }
}