<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $language = Language::where('is_default', true)->first();

        $services = [
            [
                'title'       => 'HDPE',
                'slug'        => 'hdpe',
                'type'        => null,
                'image'       => 'hdpe.jpg',
                'content'     => 'High-density polyethylene (HDPE) is a type of plastic that is made from the monomer ethylene. It is a strong, durable, and lightweight material that is often used in the manufacture of plastic bags, bottles, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'LDPE',
                'slug'        => 'ldpe',
                'type'        => null,
                'image'       => 'ldpe.jpg',
                'content'     => 'Low-density polyethylene (LDPE) is a type of plastic that is made from the monomer ethylene. It is a soft, flexible, and lightweight material that is often used in the manufacture of plastic bags, films, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'LLDPE',
                'slug'        => 'lldpe',
                'type'        => null,
                'image'       => 'lldpe.jpg',
                'content'     => 'Linear low-density polyethylene (LLDPE) is a type of plastic that is made from the monomers ethylene and propylene. It is a strong, flexible, and lightweight material that is often used in the manufacture of plastic bags, films, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'MDPE',
                'slug'        => 'mdpe',
                'type'        => null,
                'image'       => 'mdpe.jpg',
                'content'     => 'Medium-density polyethylene (MDPE) is a type of plastic that is made from the monomer ethylene. It is a strong, durable, and lightweight material that is often used in the manufacture of plastic bags, bottles, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'PPR',
                'slug'        => 'ppr',
                'type'        => null,
                'image'       => 'ppr.jpg',
                'content'     => 'Polypropylene (PP) is a type of plastic that is made from the monomer propylene. It is a strong, durable, and lightweight material that is often used in the manufacture of plastic bags, bottles, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'PPC',
                'slug'        => 'ppc',
                'type'        => null,
                'image'       => 'ppc.jpg',
                'content'     => 'Polypropylene copolymers (PPC) are a type of plastic that is made from the monomers propylene and ethylene. They are a strong, durable, and lightweight material that is often used in the manufacture of plastic bags, bottles, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'PPH',
                'slug'        => 'pph',
                'type'        => null,
                'image'       => 'pph.jpg',
                'content'     => 'Polyphenylene oxide (PPO) is a type of plastic that is made from the monomers phenylene oxide and bisphenol A. It is a strong, durable, and lightweight material that is often used in the manufacture of plastic bags, bottles, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'EVA',
                'slug'        => 'eva',
                'type'        => null,
                'image'       => 'eva.jpg',
                'content'     => 'Ethylene-vinyl acetate (EVA) is a type of plastic that is made from the monomers ethylene and vinyl acetate. It is a soft, flexible, and lightweight material that is often used in the manufacture of plastic bags, films, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'EMA',
                'slug'        => 'ema',
                'type'        => null,
                'image'       => 'ema.jpg',
                'content'     => 'Ethylene-methyl acrylate (EMA) is a type of plastic that is made from the monomers ethylene and methyl acrylate. It is a soft, flexible, and lightweight material that is often used in the manufacture of plastic bags, films, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'EBA',
                'slug'        => 'eba',
                'type'        => null,
                'image'       => 'eba.jpg',
                'content'     => 'Ethylene-butyl acrylate (EBA) is a type of plastic that is made from the monomers ethylene and butyl acrylate. It is a soft, flexible, and lightweight material that is often used in the manufacture of plastic bags, films, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'EEA',
                'slug'        => 'eea',
                'type'        => null,
                'image'       => 'eea.jpg',
                'content'     => 'Ethylene-ethyl acrylate (EEA) is a type of plastic that is made from the monomers ethylene and ethyl acrylate. It is a soft, flexible, and lightweight material that is often used in the manufacture of plastic bags, films, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
            [
                'title'       => 'EPEM',
                'slug'        => 'epem',
                'type'        => null,
                'image'       => 'epem.jpg',
                'content'     => 'Ethylene-propylene-ethylidene norbornene (EPEM) is a type of plastic that is made from the monomers ethylene, propylene, and ethylidene norbornene. It is a strong, durable, and lightweight material that is often used in the manufacture of plastic bags, bottles, and toys.',
                'status'      => 1,
                'features'    => null,
                'options'     => null,
                'language_id' => $language->id,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
