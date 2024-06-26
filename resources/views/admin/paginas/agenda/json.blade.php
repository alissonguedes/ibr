@php

	$e = [];

	if ($eventos->count() > 0) {
	    foreach ($eventos as $row) {
	        $e[] = [
	            'id' => $row->id,
	            'title' => substr($row->evento, 0, 30) . '...',
	            'start' => $row->data_ini, // . 'T' . $row->hora_agendada,
	            'end' => $row->data_fim, // . 'T' . $row->hora_agendada,
	            'url' => route('admin.paginas.agenda.edit', $row->id),
	        ];
	    }
	}

	echo json_encode($e);

@endphp
