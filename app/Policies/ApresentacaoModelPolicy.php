<?php

namespace App\Policies;

use App\Models\User;

// use Illuminate\Auth\Access\Response;

class ApresentacaoModelPolicy
{
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin';
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin';
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin';
	}

	/**
	 * Determine whether the user can update the field.
	 */
	public function edit_rotulo(User $user): bool
	{
		return $user->nivel === 'root';
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin';
	}

	/**
	 * Determine whether the user can delete the model.
	 */
	public function delete(User $user): bool
	{
		return $user->nivel === 'root' || $user->nivel === 'admin';
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
