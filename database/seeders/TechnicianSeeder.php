<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TechnicianSeeder extends Seeder
{
    public function run(): void
    {
        $technicians = [
            [ "name" => "Alejandro Alvarado1", "user_id" => "ALVARA56", "display_name" => "Alejandro Alvarado1", "email" => "alejandro_alvarado_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Alondra Reyna", "user_id" => "REYNAA22", "display_name" => "Alondra Reyna", "email" => "alondra_reyna_grupoti@whirlpool.com", "position" => "", "location" => "Ramos Arizpe", "cost_center_account_number" => "", "cost_center_name" => "Ramos Arizpe", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Andres Hernandez", "user_id" => "HERNA289", "display_name" => "Andres Hernandez", "email" => "andres_hernandez_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Antonio Ivon", "user_id" => "NONEA2", "display_name" => "Antonio Ivon", "email" => "antonio_ivon_grupoti@whirlpool.com", "position" => "", "location" => "Guadalajara CAAW", "cost_center_account_number" => "", "cost_center_name" => "Guadalajara CAAW", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Axel Tovar", "user_id" => "TOVARA17", "display_name" => "Axel Tovar", "email" => "axel_tovar_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Cinthya Alvarez", "user_id" => "ALVARC40", "display_name" => "Cinthya Alvarez", "email" => "cinthya_alvarez_grupoti@whirlpool.com", "position" => "", "location" => "Ramos Arizpe", "cost_center_account_number" => "", "cost_center_name" => "Ramos Arizpe", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Eber Gonzalez", "user_id" => "GONZAE91", "display_name" => "Eber Gonzalez", "email" => "eber_gonzalez_grupoti@whirlpool.com", "position" => "", "location" => "Ramos Arizpe", "cost_center_account_number" => "", "cost_center_name" => "Ramos Arizpe", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Edgar Lara", "user_id" => "LARAE21", "display_name" => "Edgar Lara", "email" => "edgar_lara_grupoti@whirlpool.com", "position" => "", "location" => "Ramos Arizpe", "cost_center_account_number" => "", "cost_center_name" => "Ramos Arizpe", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Edgar Lugo", "user_id" => "LUGOE5", "display_name" => "Edgar Lugo", "email" => "edgar_lugo_grupoti@whirlpool.com", "position" => "", "location" => "México CEDIS", "cost_center_account_number" => "", "cost_center_name" => "México CEDIS", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Emmanuel Lopez", "user_id" => "LOPEZE77", "display_name" => "Emmanuel Lopez", "email" => "emmanuel_lopez_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Erick Estrada", "user_id" => "ESTRAE14", "display_name" => "Erick Estrada", "email" => "erick_estrada_grupoti@whirlpool.com", "position" => "", "location" => "Celaya ERNA", "cost_center_account_number" => "", "cost_center_name" => "Celaya ERNA", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Gaston Sanchez", "user_id" => "SANCHG27", "display_name" => "Gaston Sanchez", "email" => "gaston_sanchez_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Gerardo Pineda", "user_id" => "PINEDG2", "display_name" => "Gerardo Pineda", "email" => "gerardo_pineda_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Joel Treviño", "user_id" => "TREVJI18", "display_name" => "Joel Treviño", "email" => "joel_trevino_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Josue Covarrubias", "user_id" => "COVARJ9", "display_name" => "Josue Covarrubias", "email" => "josue_covarrubias_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Mitzi Salado", "user_id" => "SALADM2", "display_name" => "Mitzi Salado", "email" => "mitzi_salado_grupoti@whirlpool.com", "position" => "", "location" => "Monterrey IT", "cost_center_account_number" => "", "cost_center_name" => "Monterrey IT", "supervisor" => "", "type" => "technician" ],
            [ "name" => "Pedro Jimenez", "user_id" => "JIMENP19", "display_name" => "Pedro Jimenez", "email" => "pedro_jimenez_grupoti@whirlpool.com", "position" => "", "location" => "Celaya ERNA", "cost_center_account_number" => "", "cost_center_name" => "Celaya ERNA", "supervisor" => "", "type" => "technician" ],
        ];

        foreach ($technicians as &$technician) {
            $technician['password'] = Hash::make('password123');
        }

        DB::table('tecnicos')->insert($technicians);

    }
}
