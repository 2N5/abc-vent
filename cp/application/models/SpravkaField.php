<?php
class SpravkaField extends ModelTable {
	static $table = 'spravki_fields';
	public $safe = array('id', 'id_spravka', 'id_field');
}