<?php

namespace App\Notifications;

use App\GetHelp;
use App\ProvideHelp;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HaveBeenMatched extends Notification implements ShouldQueue
{
	use Queueable;
	
	protected $provide_help;
	protected $get_help;
	
	
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(ProvideHelp $provide_help, GetHelp $get_help)
	{
		$this->provide_help = $provide_help;
		$this->get_help = $get_help;
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
			->subject('You have been matched')
			->greeting('Hello ' . $this->provide_help->user->client->first_name . '!')
			->line('You have been matched to pay ' . $this->get_help->user->client->first_name .
				' a sum of ' . env('CURRENCY_SYMBOL') . ' ' . number_format($this->get_help->amount, 2))
			->line('Account Details')
			->line('Account Name ' . $this->get_help->user->ClientBank->acc_name)
			->line('Account Number ' . $this->get_help->user->ClientBank->acc_number)
			->line('Bank ' . $this->get_help->user->ClientBank->bank->name)
			->line('Contact Phone ' . $this->get_help->user->phone)
			->line('')
			->level('Deadline ' . $this->provide_help->timer->more_time ? Carbon::parse($this->provide_help->timer->date_time_to)->addHour($this->provide_help->timer->more_time)->diffForHumans() : Carbon::parse($this->provide_help->timer->date_time_to)->diffForHumans())
			->line('Thank you for participating with ' . env('APP_NAME'));
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
