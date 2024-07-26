<?php

namespace App\Policies;

use App\Models\Admin\PostModel;
use App\Models\User;

// use Illuminate\Auth\Access\Response;

class PostModelPolicy
{

	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin' || $user->nivel === 'pastor' || $user->nivel === 'financeiro';
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, PostModel $post, $categoria = 'post'): bool
	{

		$p = $post->getPermissao($categoria);

		return $user->nivel === 'root' || $user->nivel === 'admin' || (isset($p->perimssao) && $p->permissao === 'list');

	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin' || $user->nivel === 'pastor';
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin' || $user->nivel === 'pastor';
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin' || $user->nivel === 'pastor';
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, PastorModel $pastorModel): bool
	{
		//
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, PastorModel $pastorModel): bool
	{
		//
	}
}
