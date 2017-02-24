<?php

namespace App\Notifications;

use App\ConfirmEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewClient extends Notification
{
	use Queueable;
	protected $confirmation;
	
	/**
	 * Create a new notification instance.
	 *
	 * @param ConfirmEmail $confirmation
	 */
	public function __construct(ConfirmEmail $confirmation)
	{
		$this->confirmation = $confirmation;
	}
	
	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}
	
	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{
		return (new MailMessage)
			->subject('Account Verification')
			->greeting('Hello ' . $this->confirmation->user->client->first_name)
			->line('Welcome to '.env('APP_NAME').', Kindly confirm your email below.')
			->action('Confirm Email', url("dashboard/confirm_email/" . $this->confirmation->confirmation_code))
			->line('Thank you for using our application!');
	}
	
	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		return [
			//
		];
	}
}
