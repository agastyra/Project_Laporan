<?php

namespace App\Http\Livewire;

use App\Models\akun;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use PDF;

class BukuBesar extends Component
{
    public $selectedAkun = '';
    public $akun = '';
    public $tanggal_awal = '';
    public $tanggal_akhir = '';
    public $query = [];

    protected $rules = [
        'selectedAkun' => 'required',
        'tanggal_awal' => 'required',
        'tanggal_akhir' => 'required',
    ];

    public function mount()
    {
        session()->forget('akun_id');

        if (request('akun_id') && request('tanggal_awal_filter') && request('tanggal_akhir_filter')) {
            $akun = akun::where('id', request('akun_id'))->first();
            $this->akun = "( $akun->no_account ) $akun->name_account";

            $query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
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
                            WHERE `akun_id` = " . request('akun_id') . " AND
                            `date` BETWEEN '" . request('tanggal_awal_filter') . "'
                            AND '" . request('tanggal_akhir_filter') . "'
                            ORDER BY `date`, `created_at` ASC
                        ";
            $this->query = DB::select($query);
        } elseif (request('akun_id') || (request('tanggal_awal_filter') && request('tanggal_akhir_filter'))) {
            $akun = akun::where('id', request('akun_id'))->first();
            $this->akun = "( $akun->no_account ) $akun->name_account";

            $query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
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
                            WHERE `akun_id` = " . request('akun_id') . "
                            ORDER BY `date`, `created_at` ASC
                        ";
            $this->query = DB::select($query);
        } else {
            $this->akun = "Silahkan pilih akun terlebih dahulu!";
        }
    }

    function print() {
        $buku_besar = [];
        $akun = '';
        $dataAkun = [];

        if (request('akun_id') && request('tanggal_awal_filter') && request('tanggal_akhir_filter')) {
            $dataAkun = akun::where('id', request('akun_id'))->first();
            $akun = "( $dataAkun->no_account ) $dataAkun->name_account";
            $query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
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
                            WHERE `akun_id` = " . request('akun_id') . " AND
                            `date` BETWEEN '" . request('tanggal_awal_filter') . "'
                            AND '" . request('tanggal_akhir_filter') . "'
                            ORDER BY `date`, `created_at` ASC
                        ";
            $buku_besar = DB::select($query);
        } elseif (request('akun_id') || (request('tanggal_awal_filter') && request('tanggal_akhir_filter'))) {
            $dataAkun = akun::where('id', request('akun_id'))->first();
            $akun = "( $dataAkun->no_account ) $dataAkun->name_account";
            $query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
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
                            WHERE `akun_id` = " . request('akun_id') . "
                            ORDER BY `date`, `created_at` ASC
                        ";
            $buku_besar = DB::select($query);
        } else {
            if (session('akun_id')) {
                $dataAkun = akun::where('id', session('akun_id'))->first();
                $akun = "( $dataAkun->no_account ) $dataAkun->name_account";
                $query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
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
                            WHERE `akun_id` = " . session('akun_id') . "
                            ORDER BY `date`, `created_at` ASC
                        ";
                $buku_besar = DB::select($query);
            } else {
                $buku_besar = [];
            }
        }

        $pdf = PDF::loadView('documents.print-buku-besar', [
            'buku_besar' => $buku_besar,
            'akun' => $akun,
            'tanggal_awal' => request('tanggal_awal_filter'),
            'tanggal_akhir' => request('tanggal_akhir_filter'),
        ]);

        return $pdf->stream();
    }

    public function updatedSelectedAkun($value)
    {
        if ($value) {
            $akun = akun::where('id', $value)->first();
            $this->akun = "( $akun->no_account ) $akun->name_account";
            session()->put('akun_id', $value);

            $query = "SELECT `id`, `date`, `keterangan`, `akun_id`, `no_account`, `name_account`,
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
            $this->query = DB::select($query);

        } else {
            $this->akun = '';
            $this->query = [];
            session()->forget('akun_id');
        }
    }

    public function render()
    {
        $accounts = akun::orderBy('no_account', 'asc')->get();

        $query = $this->query;

        return view('livewire.buku-besar', [
            'accounts' => $accounts,
            'query' => $query,
        ])->layout('components.layout.app');
    }
}
