<?php

namespace App\Http\Livewire;

use App\Models\akun;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BukuBesar extends Component
{
    public $selectedAkun = '';
    public $akun = '';
    public $query = '';

    public function mount()
    {
        $this->query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
                            `CASE
                                WHEN `debet` = 0 THEN '-'
                                ELSE `debet`
                            END AS debet,
                            CASE
                                WHEN `kredit` = 0 THEN '-'
                                ELSE `kredit`
                            END AS kredit,
                            CASE
                                WHEN `type_account` = 1 OR `type_account` = 3
                                    THEN SUM(`debet` - `kredit`) OVER (PARTITION BY `akun_id` ORDER BY `date`, `created_at`)
                                ELSE SUM(`kredit` - `debet`) OVER (PARTITION BY `akun_id` ORDER BY `date`, `created_at`)
                            END AS saldo_akhir
                        FROM (
                        SELECT jm.`id`, jm.`date`, 'Jurnal Umum' AS `keterangan`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                            jmd.`debet`, jmd.`kredit`
                            , jm.`created_at`
                        FROM `jurnal_memorials` jm
                        JOIN `jurnal_memorial_details` jmd ON jm.id = jmd.`jurnal_memorial_id`
                        JOIN `akuns` ON jmd.`akun_id` = `akuns`.`id`

                        UNION ALL

                        SELECT jp.`id`, jp.`date`, 'Jurnal Penyesuaian' AS `keterangan`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                            jpd.`debet`, jpd.`kredit`
                            , jp.`created_at`
                        FROM `jurnal_penyesuaians` jp
                        JOIN `jurnal_penyesuaian_details` jpd ON jp.id = jpd.`jurnal_penyesuaian_id`
                        JOIN `akuns` ON jpd.`akun_id` = `akuns`.`id`
                        ) AS buku_besar
                        ORDER BY `date`, `created_at` ASC`
                    ";
    }

    public function render()
    {
        $accounts = akun::orderBy('no_account', 'asc')->get();

        $buku_besar = DB::select($this->query);

        return view('livewire.buku-besar', [
            'accounts' => $accounts,
            'buku_besar' => $buku_besar,
        ])->layout('components.layout.app');
    }

    public function updatedSelectedAkun($value)
    {
        if ($value) {
            $akun = akun::where('id', $value)->first();
            $this->akun = "( $akun->no_account ) $akun->name_account";

            $this->query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
                                CASE
                                    WHEN `debet` = 0 THEN '-'
                                    ELSE `debet`
                                END AS debet,
                                CASE
                                    WHEN `kredit` = 0 THEN '-'
                                    ELSE `kredit`
                                END AS kredit,
                                CASE
                                    WHEN `type_account` = 1 OR `type_account` = 3
                                        THEN SUM(`debet` - `kredit`) OVER (PARTITION BY `akun_id` ORDER BY `date`, `created_at`)
                                    ELSE SUM(`kredit` - `debet`) OVER (PARTITION BY `akun_id` ORDER BY `date`, `created_at`)
                                END AS saldo_akhir
                            FROM (
                            SELECT jm.`id`, jm.`date`, 'Jurnal Umum' AS `keterangan`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jmd.`debet`, jmd.`kredit`
                                , jm.`created_at`
                            FROM `jurnal_memorials` jm
                            JOIN `jurnal_memorial_details` jmd ON jm.id = jmd.`jurnal_memorial_id`
                            JOIN `akuns` ON jmd.`akun_id` = `akuns`.`id`

                            UNION ALL

                            SELECT jp.`id`, jp.`date`, 'Jurnal Penyesuaian' AS `keterangan`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jpd.`debet`, jpd.`kredit`
                                , jp.`created_at`
                            FROM `jurnal_penyesuaians` jp
                            JOIN `jurnal_penyesuaian_details` jpd ON jp.id = jpd.`jurnal_penyesuaian_id`
                            JOIN `akuns` ON jpd.`akun_id` = `akuns`.`id`
                            ) AS buku_besar
                            WHERE `akun_id` = $value
                            ORDER BY `date`, `created_at` ASC
                        ";

        } else {
            $this->akun = '';
            $this->query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
                                CASE
                                    WHEN `debet` = 0 THEN '-'
                                    ELSE `debet`
                                END AS debet,
                                CASE
                                    WHEN `kredit` = 0 THEN '-'
                                    ELSE `kredit`
                                END AS kredit,
                                CASE
                                    WHEN `type_account` = 1 OR `type_account` = 3
                                        THEN SUM(`debet` - `kredit`) OVER (PARTITION BY `akun_id` ORDER BY `date`, `created_at`)
                                    ELSE SUM(`kredit` - `debet`) OVER (PARTITION BY `akun_id` ORDER BY `date`, `created_at`)
                                END AS saldo_akhir
                            FROM (
                            SELECT jm.`id`, jm.`date`, 'Jurnal Umum' AS `keterangan`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jmd.`debet`, jmd.`kredit`
                                , jm.`created_at`
                            FROM `jurnal_memorials` jm
                            JOIN `jurnal_memorial_details` jmd ON jm.id = jmd.`jurnal_memorial_id`
                            JOIN `akuns` ON jmd.`akun_id` = `akuns`.`id`

                            UNION ALL

                            SELECT jp.`id`, jp.`date`, 'Jurnal Penyesuaian' AS `keterangan`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jpd.`debet`, jpd.`kredit`
                                , jp.`created_at`
                            FROM `jurnal_penyesuaians` jp
                            JOIN `jurnal_penyesuaian_details` jpd ON jp.id = jpd.`jurnal_penyesuaian_id`
                            JOIN `akuns` ON jpd.`akun_id` = `akuns`.`id`
                            ) AS buku_besar
                            ORDER BY `date`, `created_at` ASC
                        ";
        }
    }
}
