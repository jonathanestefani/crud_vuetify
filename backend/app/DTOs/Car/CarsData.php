<?php

namespace App\DTOs\Car;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class CarsData extends DataTransferObject
{

    public ?int $country_id;
    public ?int $state_id;
    public ?int $city_id;
    public ?string $photo;
    public ?string $brand;
    public ?string $model;
    public ?string $description;
    public ?int $year;
    public ?int $mileage;
    public ?string $gearbox_type;
    public ?string $phone;
    public ?float $total;

    public static function fromRequest(Request $request): self
    {
        return new CarsData([
            'country_id' => $request->get('country_id'),
            'state_id' => $request->get('state_id'),
            'city_id' => $request->get('city_id'),
            'photo' => $request->get('photo'),
            'brand' => $request->get('brand'),
            'model' => $request->get('model'),
            'description' => $request->get('description'),
            'year' => $request->get('year'),
            'mileage' => $request->get('mileage'),
            'gearbox_type' => $request->get('gearbox_type'),
            'phone' => $request->get('phone'),
            'total' => $request->get('total'),
        ]);
    }

    public static function rules(): array
    {
        return [
            'country_id' => ['required', 'numeric', 'max:20'],
            'state_id' => ['required', 'numeric', 'max:20'],
            'city_id' => ['required', 'numeric', 'max:20'],
            'photo' => ['max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'year' => ['required', 'numeric', 'max:4'],
            'mileage' => ['required', 'numeric', 'max:20'],
            'gearbox_type' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'total' => ['required', 'numeric', 'max:20'],
        ];
    }

    public static function rulesTranslation(): array
    {
        return [
            'country_id' => 'O país é obrigatório',
            'state_id' => 'O estado é obrigatório',
            'city_id' => 'A cidade é obrigatória',
            'brand' => 'A marca é obrigatória',
            'model' => 'O modelo é obrigatório',
            'description' => 'A descrição é obrigatória',
            'year' => 'O ano é obrigatório',
            'mileage' => 'A quilometragem é obrigatória',
            'gearbox_type' => 'O tipo de câmbio',
            'phone' => 'O telefone é obrigatório',
            'total' => 'O total é obrigatório'
        ];
    }
}
