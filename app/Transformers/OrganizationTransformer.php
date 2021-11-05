<?php

namespace App\Transformers;

class OrganizationTransformer
{
    public function transform(array $data)
    {
        return [
            'name' => $data->name,
            'description' => $data->description,
            'type' => $data->type,
            'profile_picture' => $data->profile_picture,
            'meta' => [
                'email' => $data->email,
                'address' => $data->address,
                'phone' => $data->phone,
                'website' => $data->website,
            ]
        ];
    }
}
