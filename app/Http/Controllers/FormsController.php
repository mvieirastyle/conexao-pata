<?php

namespace App\Http\Controllers;

use App\Mail\NotificationEmail;
use App\Mail\NotificationVolunteerEmail;
use App\Mail\NotificationFatEmail;
use App\Models\Animal;
use App\Models\FormFat;
use App\Models\FormVolunteer;
use App\Models\FormAdoption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class FormsController extends Controller
{
    public function showVolunteerForm()
    {
        return view('pages.form-volunteer');
    }

    public function showFatForm()
    {
        return view('pages.form-fat');
    }

    public function sendVolunteerForm(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:25',
            'email' => 'required|email|max:55',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:50',
            'id_number' => 'required|string|max:9',
            'phone' => 'required|string|max:9',
            'address' => 'required|string|max:255',
            'occupation' => 'required|string|max:255',
            'company_school' => 'nullable|string|max:255',
            'hobbies' => 'nullable|string|max:255',
            'transport' => 'required|string|max:255',

            'animals.*' => 'string',
            'area.*' => 'string',
            'activities.*' => 'string',
            'courses.*' => 'string',

            'accident_responsibility' => 'accepted',
            'adaptation_terms' => 'accepted'
        ]);

        FormVolunteer::createNew($data);

        Mail::to('conexaopata@email.com')->send(new NotificationVolunteerEmail());

        return redirect('/volunteer')->with('success', 'Formulário de voluntariado enviado com sucesso!');
    }

    public function sendFatForm(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:25',
            'email' => 'required|email|max:55',
            'birth_date' => 'required|date',
            'nationality' => 'required|string|max:50',
            'id_number' => 'required|string|max:9',
            'phone' => 'required|string|max:9',

            'fat_experience' => 'nullable|string|max:255',

            'availability' => 'required|string|max:255',

            'animals.*' => 'string',
            'residence_type.*' => 'string',

            'accident_responsibility' => 'accepted',
            'adaptation_terms' => 'accepted'
        ]);

        FormFat::createNew($data);

        Mail::to('conexaopata@email.com')->send(new NotificationFatEmail());

        return redirect('/volunteer')->with('success', 'Formulário de FAT enviado com sucesso!');
    }

    public function showAdoptionForm(int $id)
    {
        $animal = Animal::findOrFail($id);

        return view('pages.form-adoption', [
            'animal' => $animal
        ]);
    }

    public function sendAdoptionForm(Request $request, $id)
    {
        $animal = Animal::findOrFail($id);

        $data = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'birth_date' => 'required|date',
            'nationality' => 'required|string',
            'id_number' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',

            'animals.*' => 'string',
            'residence_type.*' => 'string',
            'wall_height' => 'nullable|string',

            'lifestyle' => 'nullable|string',
            'daily_routine' => 'nullable|string',
            'dog_walks' => 'nullable|string',
            'house_access' => 'nullable|string',
            'vacation_plans' => 'nullable|string',
            'veterinarian' => 'nullable|string',
            'past_animals' => 'nullable|string',
            'concerns' => 'nullable|string',
            'unacceptable_behaviors' => 'nullable|string',
            'undesired_behaviors' => 'nullable|string',
            'dog_training' => 'nullable|string',

            'adoption_decision' => 'required|string',
            'life_changes' => 'required|string',
            'past_separations' => 'required|string',
            'family_constraints' => 'required|string',
            'responsibility' => 'accepted',
        ]);

        FormAdoption::createNew($data, $animal->id);

        Mail::to('conexaopata@email.com')->send(new NotificationEmail());

        return redirect('/animal/' . $id)->with('success', 'Formulário de adoção enviado com sucesso!');
    }


    private function getVolunteersCacheKey()
    {
        $filters = request()->only(['email', 'phone', 'tab']);
        $page = request('page', 1);

        $version = Cache::get('volunteers_cache_version', 1);

        return 'volunteers_' . $version . '_' . md5(json_encode($filters) . '_page_' . $page);
    }

    public function showVolunteerRequests()
    {
        $activeTab = request('tab', 'pendentes');

        $formVolunteers = Cache::remember(
            $this->getVolunteersCacheKey(),
            now()->addHours(3),
            function () use ($activeTab) {

                $query = FormVolunteer::query();

                if (request('email')) {
                    $query->where('email', 'like', '%' . request('email') . '%');
                }

                if (request('phone')) {
                    $query->where('phone', 'like', '%' . request('phone') . '%');
                }

                if ($activeTab === 'pendentes') {
                    $query->where('accept', 0);
                }

                if ($activeTab === 'aceitos') {
                    $query->where('accept', 1);
                }

                return $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
            }
        );

        return view('pages.admin.animal.volunteer-request', [
            'formVolunteers' => $formVolunteers,
            'activeTab' => $activeTab,
        ]);
    }

    public function showVolunteersRequests($id)
    {
        $formVolunteer = FormVolunteer::query()->findOrFail($id);

        return view('pages.admin.animal.info-volunteer', [
            'formVolunteer' => $formVolunteer,
        ]);
    }

    public function acceptVolunteer($id)
    {
        $formVolunteer = FormVolunteer::query()->findOrFail($id);

        $formVolunteer->update([
            'accept' => 1,
        ]);

        Cache::forget('volunteers_cache_version');

        return redirect('/admin/animal/volunteer-requests')->with('success', 'Pedido de voluntariado aceito. Já entramos em contato com o voluntario');
    }

    public function rejectVolunteer($id)
    {
        $volunteer = FormVolunteer::findOrFail($id);

        $volunteer->delete();

        Cache::forget('volunteers_cache_version');

        return redirect('/admin/animal/volunteer-requests')->with('success', 'Pedido de voluntariado negado. Já entramos em contato com o voluntario');
    }

        private function getFatsCacheKey()
    {
        $filters = request()->only(['email', 'phone', 'tab']);
        $page = request('page', 1);

        $version = Cache::get('fats_cache_version', 1);

        return 'fats_' . $version . '_' . md5(json_encode($filters) . '_page_' . $page);
    }

    public function showFatRequests(){
      $activeTab = request('tab', 'pendentes');

        $formFat = Cache::remember(
            $this->getFatsCacheKey(),
            now()->addHours(3),
            function () use ($activeTab) {

                $query = FormFat::query();

                if (request('email')) {
                    $query->where('email', 'like', '%' . request('email') . '%');
                }

                if (request('phone')) {
                    $query->where('phone', 'like', '%' . request('phone') . '%');
                }

                if ($activeTab === 'pendentes') {
                    $query->where('accept', 0);
                }

                if ($activeTab === 'aceitos') {
                    $query->where('accept', 1);
                }

                return $query->orderBy('id', 'desc')->paginate(10)->withQueryString();
            }
        );

          return view('pages.admin.animal.fat-requests', [
            'formFat' => $formFat,
            'activeTab' => $activeTab,
        ]);
    }

    public function showFatRequest($id)
    {
        $formFat = FormFat::query()->findOrFail($id);

        return view('pages.admin.animal.info-fat', [
            'formFat' => $formFat,
        ]);
    }
}
