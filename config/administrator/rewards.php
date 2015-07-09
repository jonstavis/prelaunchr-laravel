<?php 

return array (
	'title' => 'Rewards',
	'single' => 'Reward',
	'model' => 'App\Reward',
	'form_width' => 700,

	'columns' => 

	array (
		'num_referrals' => 
		array (
			'title' => 'Required Referrals',
		),
		'title' =>
		array (
			'title' => 'Name',
		),
		'created_at' =>
		array (
			'title' => 'Created At',
		),
	),

	'edit_fields' => 
	array (
		'num_referrals' => 
		array (
			'title' => '# of Required Referrals',
			'type' => 'number',
		),
		'title' =>
		array (
			'title' => 'Name',
			'type' => 'text',
		),
		'description' =>
		array (
			'title' => 'Description',
			'type' => 'textarea',
		),
	),
);


