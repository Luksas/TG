<?php

namespace App\Service;

use App\Dto\AbstractSendNotificationDto;
use App\Exception\NotificationChannelFailureException;
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
        //  -- fetch the messages from queue and send them
        //  -- on failure: requeue them (depending on some logic, like requeue x time later or requeue on a different channel name)
        // Not implementing rabbit due to time constraints.

        $this->send($request, $request->getChannelType());
    }

    private function send(AbstractSendNotificationDto $request, int $nextChannel): void
    {
        try {
            $channel = $this->notificationChannelService->getChannel($nextChannel);

            $channel->send($request);
        } catch (NotificationChannelFailureException $exception) {
            if ($request->canRetry()) {
                $request->incrementRetryCount();

                // Here it is important to know, that the separate channel has to accept same type of data, so re-mapping or shared Dto objects would be required.
                $this->send($request, $request->getFailOverChannelType());
            } else {
                // Well, we cannot retry anymore, something wrong happened, send to logging/monitoring system.

                echo "Something is wrong, we ran out of channels!".$exception->getMessage();
            }
        } catch (Exception $exception) {
            // Something wrong happened, send to logging/monitoring system.

            echo "Big error: ".$exception->getMessage();
        }
    }
}
