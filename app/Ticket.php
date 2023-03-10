<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'title',
        'employee_id',
        'priority',
        'end_date',
        'description',
        'ticket_code',
        'created_by',
        'status',
    ];

    public function ticketUnread()
    {
        if(\Auth::user()->type == 'employee')
        {

            return TicketReply:: where('ticket_id', $this->id)->where('is_read', 0)->where('created_by', '!=', \Auth::user()->id)->count('id');
        }
        else
        {
            return TicketReply:: where('ticket_id', $this->id)->where('is_read', 0)->where('created_by', '!=', \Auth::user()->creatorId())->count('id');

        }
    }

    public function createdBy()
    {
        return $this->hasOne('App\user', 'id', 'created_by');
    }
}
