<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\TicketMessage;
use Auth;

class TicketController extends Controller
{

	public function getTickets()
	{
		$tickets = Ticket::all()->where('user_id', Auth::id());
		return view('dashboard/vendor/tickets/all', compact('tickets'));
	}

    public function createTicket()
    {
    	return view('dashboard/vendor/tickets/create');
    }

    public function storeTicket(Request $request)
    {
    	//Create new ticket
    	$ticket = new Ticket;
    	$ticket->user_id = Auth::id();
    	$ticket->title = $request->title;
    	$ticket->status = 0;
    	$ticket->save();

    	//Get last added ticket ID to link it to the ticket messages between the vendor and the admins
    	$last_added_ticket_ID = Ticket::orderBy('created_at', 'desc')->first()->id;

    	//add the message to the messages table
    	$ticket_message = new TicketMessage;
    	$ticket_message->ticket_id = $last_added_ticket_ID;
    	$ticket_message->from_user_id = Auth::id();
    	$ticket_message->message = $request->message;
    	$ticket_message->save();

    	return redirect('vendor/tickets');

    }

    public function getTicket($id)
    {
    	$ticket = Ticket::find($id);
    	if ($ticket != '') {
    		
	    	if ($ticket->user_id == Auth::id()) {

	    	$ticket_messages = TicketMessage::all()->where('ticket_id', $id);
	    	return view('dashboard/vendor/tickets/ticket', compact('ticket', 'ticket_messages'));

		    }else{

		    	return view('404');
		    }

		}else{
		    return view('404');
		}
    }

    public function storeMessage(Request $request)
    {
  
    	//add the message to the messages table
    	$ticket_message = new TicketMessage;
    	$ticket_message->ticket_id = $request->ticket_id;
    	$ticket_message->from_user_id = Auth::id();
    	$ticket_message->message = $request->message;
    	$ticket_message->save();

    	return redirect('vendor/ticket/'.$request->ticket_id.'');
    }
}
