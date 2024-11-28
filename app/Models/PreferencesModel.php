<?php

namespace App\Models;
use CodeIgniter\Model;

class PreferencesModel extends Model
{
	protected $table = 'preferences';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'days_reminder_deadline',
		'rows_per_page',
		'pagination_pages',
		'displayed_days_in_calendar',
	];


	public function getPreferencesByIdAccount($idAccount)
	{
		return $this->where('account_id', $idAccount)->first();
	}
	public function setPreferences($idAccount, $preferences)
	{
		return $this->where('account_id', $idAccount)
			->set([
				'days_reminder_deadline' => $preferences['days_reminder_deadline'],
				'rows_per_page' => $preferences['rows_per_page'],
				'pagination_pages' => $preferences['pagination_pages'],
				'displayed_days_in_calendar' => $preferences['displayed_days_in_calendar'],
			])
			->update();
	}
}
