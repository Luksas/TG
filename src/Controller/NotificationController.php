<?php

namespace App\Controller;

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
        $request = new SendSmsNotificationDto();
        $request->setPhoneNumber("+1111111");
        $request->setTitle("Sms from xxx.");
        $request->setText("Text from xxx.");
        $request->setChannelName(NotificationChannelInterface::CHANNEL_SMS);

        $this->notificationSendingService->sendNotification($request);

        return new Response(Response::HTTP_ACCEPTED);
    }
}
