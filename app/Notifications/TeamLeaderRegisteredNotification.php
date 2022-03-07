<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class TeamLeaderRegisteredNotification extends Notification
{
    use Queueable;

	/**
	 * @var User $user
	 */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
			->subject('Új csapatvezető regisztráció | meet.kvsc.info')
			->greeting('Szia!')
			->line('Egy új csapatvezető regisztrált a meet.kvsc.info oldalra vagy pedig egy meglévő felhasználó beállította az egyesületét annak érdekében, hogy nevezni tudjon, így lehet, hogy nevezési jogosultságot kell adni neki.')
			->line('Név: ' . $this->user->name)
			->line('Email: ' . $this->user->email)
			->line('Egyesület: ' . $this->user->team->name)
			->line('Regisztrált: ' . $this->user->created_at->format('Y.m.d H:i'))
			->action('Megnézem', route('admin:users.edit', $this->user))
			->salutation(new HtmlString("Üdv,<br>meet.kvsc.info"));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
