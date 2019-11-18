<?php
namespace App\Repositories;
use App\Models\Message;
use App\Services\MessageService;


class MessageRepository implements MessageService{

	protected $message;

	public function __construct(Message $message){
		$this->message = $message;
	}

	public function GetAll($user_id){
		return $this->message->where('user_id',$user_id)->get();
	}



}