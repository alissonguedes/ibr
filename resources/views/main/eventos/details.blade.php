<x-site-layout>
	<x-slot:body>

		{{-- <div class="title_page">EVENTOS</div> --}}

		<div class="content_int">

			@if (request()->routeIs('site.eventos.details'))
				<div class="video_culto mt-3">
					{!! $post->url ?? '<img src="' . route('home.eventos.show-image', $post->id) . '?action=preview" class="responsive-img">' !!}
				</div>
			@endif

			<style>
				iframe {
					width: 100% !important;
				}

				.video_ministerio iframe {
					height: 75vh !important;
					border: none !important;
				}
			</style>

			<div class="bloco">
				<div class="title_bloco_esquerdo">
					@if (request()->routeIs('site.eventos.details'))
						<div class="t1">{{ $post->evento }}</div>
					@else
						<div class="t1">Inscrição - {{ $post->evento }}</div>
					@endif

					@if (request()->routeIs('site.eventos.details'))
						<div class="data cor_verde">
							{{ show_date($post->data_ini) }}
						</div>
					@else
						<p>
							Data do evento: {{ show_date($post->data_ini) }} à {{ show_date($post->data_fim) }}
						</p>
					@endif

				</div>
				<div class="conj_bloco">

					@if (request()->routeIs('site.eventos.inscricoes'))
						@php
							$errors = [];
							if (session()->exists('errors')) {
							    $errors = session()->get('errors');
							    $errors = $errors->messages();
							}
						@endphp
						<div class="row">
							<div class="col s12 m6 l6 offset-m3 offset-l3">

								@php
									$errors = [];
									if (session()->exists('errors')) {
									    $errors = session()->get('errors');
									    $errors = $errors->messages();
									}
								@endphp

								@if (session()->has('message'))
									<div id="message" class="row">
										<div class="col s12">
											<div class="padding-1 green green-text text-darken-4 lighten-4 border green-border border-lighten-3 message">
												{{ session()->get('message') }}
											</div>
										</div>
									</div>
								@endif

								<form action="{{ route('site.eventos.post', $post->evento_slug) }}" method="post" enctype="multipart/form-data">

									@csrf
									<input type="hidden" name="evento" value="{{ $post->id }}">

									<div class="input-field @isset($errors['nome']) error @endisset"">
										<div class="material-symbols-outlined prefix">person</div>
										<x-text-input name="nome" id="nome" value="{{ old('nome') }}" placeholder="Nome" />
										@isset($errors['nome'])
											<div class="error">{{ $errors['nome'][0] }}</div>
										@endisset
									</div>
									<div class="input-field @isset($errors['cpf']) error @endisset"">
										<div class="material-symbols-outlined prefix">id_card</div>
										<x-text-input name="cpf" id="cpf" value="{{ old('cpf') }}" placeholder="CPF" />
										@isset($errors['cpf'])
											<div class="error">{{ $errors['cpf'][0] }}</div>
										@endisset
									</div>
									<div class="input-field @isset($errors['rg']) error @endisset"">
										<div class="material-symbols-outlined prefix">id_card</div>
										<x-text-input name="rg" id="rg" value="{{ old('rg') }}" placeholder="RG" />
										@isset($errors['rg'])
											<div class="error">{{ $errors['rg'][0] }}</div>
										@endisset
									</div>
									<div class="input-field @isset($errors['email']) error @endisset"">
										<div class="material-symbols-outlined prefix">alternate_email</div>
										<x-text-input name="email" id="email" value="{{ old('email') }}" placeholder="E-Mail" />
										@isset($errors['email'])
											<div class="error">{{ $errors['email'][0] }}</div>
										@endisset
									</div>
									<div class="input-field @isset($errors['telefone']) error @endisset"">
										<div class="material-symbols-outlined prefix">phone</div>
										<x-text-input name="telefone" id="telefone" value="{{ old('telefone') }}" placeholder="Telefone" />
										@isset($errors['telefone'])
											<div class="error">{{ $errors['telefone'][0] }}</div>
										@endisset
									</div>
									<div class="input-field @isset($errors['uf']) error @endisset">
										<div class="material-symbols-outlined prefix">globe</div>
										<select name="uf" id="uf" data-url="{{ route('estados') }}">
											<option selected disabled>Informe seu estado</option>
											@if (isset($estados))
												@foreach ($estados as $uf)
													<option value="{{ $uf->id }}" @selected(old('uf') == $uf->id ?? $uf->estado == 'Paraiba')>{{ $uf->estado }}</option>
												@endforeach
											@endif
										</select>
										@isset($errors['uf'])
											<div class="error">{{ $errors['uf'][0] }}</div>
										@endisset
									</div>
									<div class="input-field @isset($errors['cidade']) error @endisset">
										<div class="material-symbols-outlined prefix">location_on</div>
										<select name="cidade" id="cidade">
											<option selected disabled>Informe sua cidade</option>
											@if (isset($cidades))
												@foreach ($cidades as $cidade)
													<option value="{{ $cidade->id }}" @selected(old('cidade') == $cidade->id ?? $cidade->cidade == 'Joao Pessoa')>{{ $cidade->cidade }}</option>
												@endforeach
											@endif
										</select>
										@isset($errors['cidade'])
											<div class="error">{{ $errors['cidade'][0] }}</div>
										@endisset
									</div>

									<div class="right">
										<button type="submit" class="waves-effect waves-dark btn teal">Enviar</button>
									</div>

								</form>
							</div>
						</div>
						<style>
							.dropdown-content.select-dropdown {
								max-height: 300px;
							}

							.select-dropdown.dropdown-trigger {
								font-family: inherit !important;
							}

							.select-dropdown li.disabled,
							.select-dropdown li.disabled>span,
							.select-dropdown li.optgroup {
								color: rgba(0, 0, 0, 0.3);
								background-color: transparent;
							}

							.dropdown-content li>a,
							.dropdown-content li>span {
								font-size: 16px;
								color: inherit;
								display: block;
								line-height: 22px;
								padding: 14px 16px;
							}
						</style>
					@else
						<div class="text_bloco">
							{!! $post->descricao !!}
						</div>
					@endif
				</div>
			</div>

			@if (!request()->routeIs('site.eventos.inscricoes'))
				<a href="{{ route('site.eventos.inscricoes', $post->evento_slug) }}">
					<div class="bt_insc">FAÇA SUA INSCRIÇÃO</div>
				</a>
				{{-- @else
				<a href="{{ route('site.eventos.details', $post->evento_slug) }}">
					<div class="bt_insc">Voltar</div>
				</a> --}}
			@endif

			@if (isset($eventos) && $eventos->count() > 0)
				<div class="outros_ministerios">

					<div class="subtitle_pages cor_cinza">
						Veja também
						<br>
						<span class="cor_verde">Outros Eventos</span>
					</div>

					<div class="area_ministerios">

						<div class="row">
							@foreach ($eventos as $i => $evento)
								<div class="col s12 m6 l4">
									<a href="{{ route('site.eventos.details', $evento->titulo_slug) }}">
										<div class="card border-radius-20 z-depth-3">
											<div class="card-image" style="height: 300px; overflow: hidden;">
												<div class="mascara" style="position: absolute; background: transparent; top: 0; left: 0; right: 0; bottom: 0; z-index: 9;"></div>
												<img src="{{ route('home.eventos.show-image', $evento->id) . '?action=preview' }}" height="210">
												{!! $evento->url !!}
											</div>
											<div class="card-content center-align gradient-0deg-grey-grey">
												<h5 class="card-title mb-6 mt-0">{{ $evento->titulo }}</h5>
												<small class="grey-text text-darken-3">{{ date('d/m/Y', strtotime($evento->data)) }}</small>
												<p class="bold black-text mt-6">{{ $evento->subtitulo }}</p>
											</div>
										</div>
									</a>
								</div>
							@endforeach
						</div>
					</div>

				</div>
			@endif

		</div>

	</x-slot:body>

</x-site-layout>
