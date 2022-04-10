<?php

namespace App\Service;

use App\Dto\AbstractSendNotificationDto;
use Symfony\Component\Config\Definition\Exception\Exception;

class NotificationSendingService
{
    private NotificationChannelService $notificationChannelService;

    /**
     * @param NotificationChannelService $notificationChannelService
     */
    public function __construct(NotificationChannelService $notificationChannelService)
    {
        $this->notificationChannelService = $notificationChannelService;
    }

    public function sendNotification(AbstractSendNotificationDto $request): void
    {
        // This logic would be better done using a message processor.
        // Instead of sending messages here, messages should be stored into a message processor queue
        // Workers (consumers) would then:
        //  -- fetch the messages and send them
        //  -- on failure: requeue and retry them (requeue depending on some logic, like requeue x time later or requeue with a different provider)
        // Not implementing rabbit due to time constraints.

        try {
            $channel = $this->notificationChannelService->getChannel($request->getChannelName());

            $channel->send($request);
        } catch (Exception $exception) {
            // Logging of issues should be done here, won't do it thought.
            // Here we could also do remapping


            $channel = $this->notificationChannelService->getChannel($request->getFailOverChannelName());

            $channel->send($request);
        }
    }
}
