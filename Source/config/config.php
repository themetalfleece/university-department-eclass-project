<?php
return [
    'department' => [
        'name' => 'Η.Μ.Τ.Υ.'
    ],
	'google-recaptcha' => [
		'site-key' => '',
		'secret-key' => ''
	],
	'user' => [
		'roles' => [
			'admin', 'student', 'professor', 'secretary'
		],
		'rolesTranslated' => [
			'admin' => __('Διαχειριστής'),
			'student' => __('Μαθητής'),
			'professor' => __('Καθηγητής'),
			'secretary' => __('Γραμματέας')
		],
		'defaultTimezone' => 'Europe/Athens',
		'defaultPicture' => '/img/user/default.png',
		'profile-pictures-dir' => [
			'absolute' => WWW_ROOT . '/img/user-profile-pictures/',
			'relative' => '/img/user-profile-pictures/'
		]
	],
	'student' => [
		'levels' => ['undergraduate', 'postgraduate'],
		'levelsTranslated' => [
			'undergraduate' => __('Προπτυχιακός'),
			'postgraduate' => __('Μεταπτυχιακός')
		],
		'courses' => [
			'perPage' => 6
		]
	],
	'professor' => [
		'titles' => ['lecturer', 'assoc_prof', 'assis_prof', 'professor'],
		'titlesTranslated' => [
			'lecturer' => __('Λέκτορας'),
			'associate_prof' => __('Αναπληρωτής Καθηγητής'),
			'assistant_prof' => __('Επίκουρος Καθηγητής'),
			'professor' => __('Καθηγητής')
		]
	],
	'course' => [
		'statuses' => [
			'attending', 'registered', 'passed'
		],
		'statusesTranslated' => [
			'attending' => __('Παρακολουθείται'),
			'registered' => __('Δηλωμένο'),
			'passed' => __('Περασμένο')
		],
		'levels' => ['undergraduate', 'postgraduate'],
		'levelsTranslated' =>  [
			'undergraduate' => __('Προπτυχιακό'),
			'postgraduate' => __('Μεταπτυχιακό')
		],
		'types' => ['teaching', 'laboratory'],
		'typesTranslated' => [
			'teaching' => __('Διδασκαλία'),
			'laboratory' => __('Εργαστήριο')
		],
		'examMeans' => ['final_exam'],
		'examMeansTranslated' => [
			'final_exam' => __('Τελική εξέταση')
		],
		'perPage' => 6
	],
	'classroom' => [
		'types' => [
			'laboratory', 'theater'
		],
		'typesTranslated' => [
			'laboratory' => __('Εργαστήριο'),
			'theater' => __('Αμφιθέατρο')
		]
	],
	'schedule' => [
		'days' => [
			0 => __('Δευτέρα'),
			1 => __('Τρίτη'),
			2 => __('Τετάρτη'),
			3 => __('Πέμπτη'),
			4 => __('Παρασκευή'),
			5 => __('Σάββατο'),
			6 => __('Κυριακή')
		]
	],
	'sector' => [
		'sectors' => ['main', 'telecommunications', 'pc', 'energy', 'robots'],
		'sectorsTranslated' => [
			'main' => __('Κορμός'),
			'telecommunications' => __('Τηλεπικοινωνιών & Τεχνολογίας Πληροφορίας'),
			'pc' => __('Ηλεκτρονικής & Υπολογιστών'),
			'energy' => __('Συστημάτων Ηλεκτρικής Ενέργειας'),
			'robots' => __('Συστημάτων & Αυτομάτου Ελέγχου'),
		]
	],
	'sendgrid' => [
		'api-key' => ''
	]
];
