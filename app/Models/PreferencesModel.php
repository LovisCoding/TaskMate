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
		var_dump($preferences);
		return $this->where('account_id', $idAccount)
			->set([
				'days_reminder_deadline' => !empty($preferences['days_reminder_deadline']) ? (int)$preferences['days_reminder_deadline'] : 7,
				'rows_per_page' => !empty($preferences['rows_per_page']) ? (int)$preferences['rows_per_page'] : 5,
				'pagination_pages' => !empty($preferences['pagination_pages']) ? (int)$preferences['pagination_pages'] : 5,
				'displayed_days_in_calendar' => !empty($preferences['displayed_days_in_calendar']) ? $preferences['displayed_days_in_calendar'] : 7,
			])
			->update();
	}
}
