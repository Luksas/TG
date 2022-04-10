<?php

namespace App\Controller;

use App\Dto\SendEmailNotificationDto;
use App\Dto\SendSmsNotificationDto;
use App\Service\NotificationChannelInterface;
use App\Service\NotificationSendingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    private NotificationSendingService $notificationSendingService;

    /**
     * @param NotificationSendingService $notificationSendingService
     */
    public function __construct(NotificationSendingService $notificationSendingService)
    {
        $this->notificationSendingService = $notificationSendingService;
    }

    #[Route('/notification/send', name: 'notification_send')]
    public function send(Request $rawRequest): Response
    {
        // Not adding authentication, request verification and processing.
        // Such thing could be done depending on business logic, e.g. if current API client has specific channels assigned to them etc.

        // Run sms.
        $smsRequest = new SendSmsNotificationDto();
        $smsRequest->setPhoneNumber("+1111111");
        $smsRequest->setTitle("Sms from xxx.");
        $smsRequest->setText("Text from xxx.");
        $smsRequest->setChannelType(NotificationChannelInterface::CHANNEL_SMS);
        $smsRequest->setFailOverChannelType(NotificationChannelInterface::CHANNEL_SMS_BACKUP);

        $this->notificationSendingService->sendNotification($smsRequest);

        // Run email.
        $emailRequest = new SendEmailNotificationDto();
        $emailRequest->setTitle("Sms from xxx.");
        $emailRequest->setChannelType(NotificationChannelInterface::CHANNEL_EMAIL);
        $emailRequest->setFailOverChannelType(NotificationChannelInterface::CHANNEL_EMAIL);

        $this->notificationSendingService->sendNotification($emailRequest);

        return new Response(Response::HTTP_ACCEPTED);
    }
}
