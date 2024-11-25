<?php

namespace App\Models;
use CodeIgniter\Model;

class AccountModel extends Model
{
	protected $table = 'account';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'name',
		'email',
		'password',
		'created_at',
		'reset_token',
		'reset_token_expiration'
	];

	protected $useTimestamps = true;
	protected $createdField = 'created_at';
	protected $updatedField = null;

	public function getAccountByEmail($email)
	{
		return $this->where('email', $email)->first();
	}

	public function setResetToken($email, $token, $expiration)
	{
		return $this->where('email', $email)
					->set([
						'reset_token' => $token,
						'reset_token_expiration' => $expiration,
					])
					->update();
	}

	public function verifyResetToken($token)
	{
		$account = $this->where('reset_token', $token)
						->where('reset_token_expiration >=', date('Y-m-d H:i:s'))
						->first();

		return $account ? $account : null;
	}

	public function createAccount($registrationData)  
	{
		$query = "INSERT INTO account (name, email, password, created_at, reset_token, reset_token_expiration)
        VALUES ('" . $registrationData['name'] . "', '" . $registrationData['email'] . "', '" . $registrationData['password'] . "', NOW(), NULL, NULL)";

		$this->query($query);
	}
}
