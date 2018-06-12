<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StockAdjustmentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $itemname;
    protected $stock_id;
    protected $stock_adjusted;
    protected $stock_quantity;
    protected $stock_type;
    protected $stock_remarks;

    public function __construct($itemname,$stock_adjusted,$stock_quantity,$stock_type,$stock_remarks,$stock_id)
    {
        //
        $this->itemname= $itemname;
        $this->stock_adjustedby= $stock_adjusted;
        $this->stock_quantity= $stock_quantity;
        $this->stock_type= $stock_type;
        $this->stock_remarks= $stock_remarks;
        $this->stock_id= $stock_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'itemname'=> $this->itemname,
            'stock_adjustedby'=>$this->stock_adjustedby,
            'stock_quantity'=>$this->stock_quantity,
            'stock_type'=>$this->stock_type,
            'stock_remarks'=>$this->stock_remarks,
            'stock_id'=>$this->stock_id,

        ];
    }
}
