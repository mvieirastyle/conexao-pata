<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use function Laravel\Prompts\clear;

class UserController extends Controller
{
    private function getUsersCacheKey()
    {
        $filters = request()->only(['name', 'email', 'admin']);
        $page = request('page', 1);

        $version = Cache::get('users_cache_version', 1);

        return 'users_' . $version . '_' . md5(json_encode($filters) . '_page_' . $page);
    }
    public function showList()
    {
        $users =  Cache::remember($this->getUsersCacheKey(), now()->addHours(3), function () {
            $query = User::query();

            if (request('name')) {
                $query->where('name', 'like', '%' . request('name') . '%');
            }

            if (request('email')) {
                $query->where('email', 'like', '%' . request('email') . '%');
            }

            if (request()->has('admin')) {
                $query->where('admin', request('admin'));
            }

            return $query->paginate(6)->withQueryString();
        });

        return view('pages.admin.users.list', [
            'users' => $users,
        ]);
    }


    public function Showadd()
    {
        $users = User::all();
        return view('pages.admin.users.add', [
            'users' => $users,
        ]);
    }

    public function add(UserRequest $request)
    {
        $request->validated();

        User::createNewAdmin($request->all());

        Cache::increment('users_cache_version');

        return redirect('/admin/users/list')->with('success', 'Utilizador adicionado com sucesso');
    }


    public function showEdit(int $id)
    {
        $user = User::all()->find($id);
        return view('pages.admin.users.edit', [
            'user' => $user,
        ]);
    }


    public function update(UpdateRequest $request, int $id)
    {
        User::findOrFail($id);
        $request->validated();

        User::updateUser($id, $request->all());

        Cache::increment('users_cache_version');

        if (Auth::user()->admin) {
            return redirect('/admin/users/list')->with('success', 'Utilizador editado com sucesso');
        } else {
            return redirect('/profile')->with('success', 'Suas informações foram atualizadas com sucesso');
        }
    }

    public function delete($id)
    {
        User::deleteUser($id);

        Cache::increment('users_cache_version');

        return redirect('/admin/users/list')->with('success', 'Utilizador removido com sucesso');
    }

    public function showProfile()
    {
        $user = Auth::user();

        return view('pages.profile', [
            'user' => $user,
        ]);
    }
}
