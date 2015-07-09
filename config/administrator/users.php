<?php 

return array (
	'title' => 'Users',
	'single' => 'User',
	'model' => 'App\User',
	'form_width' => 700,

	'filters' =>

	array (
		'email' => [ 'title' => 'Email' ],
		'name' => [ 'title' => 'name' ],
		'role' => [ 'type' => 'enum', 'options' => [ 'ADMIN', 'USER' ] ],
		'valid_email' => [ 'title' => 'Valid Email', 'type' => 'bool' ],
	),

	'rules' =>

	array (
		'email' => 'required|email',
		'role' => 'required',
	),


	'columns' => 

	array (
		'email' => 
		array (
			'title' => 'Email',
		),
		'name' =>
		array (
			'title' => 'Name',
		),
		'role' => 
		array (
			'title' => 'Role',
		),
		'created_at' =>
		array (
			'title' => 'Created At',
		),
		'referrer' =>
		array (
			'title' => 'Referrer',
			'relationship' => 'referrer',
			'select' => "(:table).email",
		),
	),

	'edit_fields' => 
	array (
		'email' => 
		array (
			'title' => 'Email',
			'type' => 'text',
		),
		'valid_email' =>
		array (
			'title' => 'Valid Email',
			'type' => 'bool',
		),
		'name' =>
		array (
			'title' => 'Name',
			'type' => 'text',
		),
		'password' =>
		array (
			'title' => 'Reset Password',
			'type' => 'password',
		),
		'referral_url' =>
		array (
			'title' => 'Referral URL',
			'type' => 'text',
			'editable' => false,
		),
		'referral_status_url' =>
		array (
			'title' => 'Referral Status URL',
			'type' => 'text',
			'editable' => false,
		),
		'ip_address' => 
		array (
			'title' => 'Signup IP Address',
			'type' => 'text',
			'editable' => false,
		),
		'created_at' => [
			'title' => 'Created At',
			'type' => 'text',
			'editable' => false,
		],
		'role' => 
		array (
			'title' => 'Role (Setting a user to USER to ADMIN will allow them access to this backend tool)',
			'type' => 'enum',
			'options' => [ 'ADMIN', 'USER' ],
		),
	),
);

