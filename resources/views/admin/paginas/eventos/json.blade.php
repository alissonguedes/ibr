@php

	$e = [];

	if ($eventos->count() > 0) {
	    foreach ($eventos as $row) {
	        $e[] = [
	            'id' => $row->id,
	            'title' => $row->paciente,
	            'start' => $row->data . 'T' . $row->hora_agendada,
	            'end' => $row->data . 'T' . $row->hora_agendada,
	            'url' => route('clinica.agendamentos.edit', $row->id),
	        ];
	    }
	}

	echo json_encode($e);

@endphp
