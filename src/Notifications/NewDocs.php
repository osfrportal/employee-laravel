<?php
namespace Osfrportal\OsfrportalLaravel\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewDocs extends Notification implements ShouldQueue
//class NewUser extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Создание нового экземпляра уведомления
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Получение каналов доставки уведомления
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Получение шаблона почтового уведомления
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Получение массива уведомления
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Добавлен документ для ознакомления',
        ];
    }
}
