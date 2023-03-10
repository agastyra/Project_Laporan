<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;

class NeracaSaldo extends Component
{
    public $query = [];
    public $bulan = '';
    public $tahun = '';
    public $sumDebet = 0;
    public $sumKredit = 0;
    public $selectedMonth = '';

    public function mount()
    {
        session()->forget('bulan_filter');

        $this->selectedMonth = date('Y-m');
        session()->put('bulan_filter', date('Y-m'));

        $query = "SELECT `id`, `date`, `akun_id`, `no_account`, `name_account`,
                        CASE
                            WHEN `debet` = '-' THEN '-'
                            ELSE CAST(`saldo_akhir` AS DOUBLE)
                        END AS `debet`,
                        CASE
                            WHEN `kredit` = '-' THEN '-'
                            ELSE CAST(`saldo_akhir` AS DOUBLE)
                        END AS `kredit`
                    FROM (
                          SELECT `id`, `date`, `akun_id`, `no_account`, `name_account`, 
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
                            SELECT jm.`id`, jm.`date`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jmd.`debet`, jmd.`kredit`
                                , jm.`created_at`
                            FROM `jurnal_memorials` jm
                            JOIN `jurnal_memorial_details` jmd ON jm.id = jmd.`jurnal_memorial_id`
                            JOIN `akuns` ON jmd.`akun_id` = `akuns`.`id`

                            UNION ALL

                            SELECT jp.`id`, jp.`date`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jpd.`debet`, jpd.`kredit`
                                , jp.`created_at`
                            FROM `jurnal_penyesuaians` jp
                            JOIN `jurnal_penyesuaian_details` jpd ON jp.id = jpd.`jurnal_penyesuaian_id`
                            JOIN `akuns` ON jpd.`akun_id` = `akuns`.`id`
                          ) AS buku_besar
                            ORDER BY `created_at` DESC
                    ) AS neraca_saldo
                    WHERE MONTH(`date`) = '" . date('m') . "'
                    AND YEAR(`date`) = '" . date('Y') . "'
                    GROUP BY akun_id";
        $this->query = DB::select($query);

        for ($i = 0; $i < count($this->query); $i++) {
            if ($this->query[$i]->debet != '-') {
                $this->sumDebet = $this->sumDebet + $this->query[$i]->debet;
            }
        }

        for ($i = 0; $i < count($this->query); $i++) {
            if ($this->query[$i]->kredit != '-') {
                $this->sumKredit = $this->sumKredit + $this->query[$i]->kredit;
            }
        }
    }

    public function render()
    {
        $neraca_saldo = $this->query;

        return view('livewire.neraca-saldo', ['neraca_saldo' => $neraca_saldo])
            ->layout('components.layout.app');
    }

    public function updatedSelectedMonth($value)
    {
        if ($value) {
            session()->put('bulan_filter', $value);

            $value = explode('-', $value);
            $this->tahun = $value[0];
            $this->bulan = $value[1];

            $this->sumDebet = 0;
            $this->sumKredit = 0;

            $query = "SELECT `id`, `date`, `akun_id`, `no_account`, `name_account`,
                        CASE
                            WHEN `debet` = '-' THEN '-'
                            ELSE CAST(`saldo_akhir` AS DOUBLE)
                        END AS `debet`,
                        CASE
                            WHEN `kredit` = '-' THEN '-'
                            ELSE CAST(`saldo_akhir` AS DOUBLE)
                        END AS `kredit`
                    FROM (
                          SELECT `id`, `date`, `akun_id`, `no_account`, `name_account`, 
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
                            SELECT jm.`id`, jm.`date`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jmd.`debet`, jmd.`kredit`
                                , jm.`created_at`
                            FROM `jurnal_memorials` jm
                            JOIN `jurnal_memorial_details` jmd ON jm.id = jmd.`jurnal_memorial_id`
                            JOIN `akuns` ON jmd.`akun_id` = `akuns`.`id`

                            UNION ALL

                            SELECT jp.`id`, jp.`date`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jpd.`debet`, jpd.`kredit`
                                , jp.`created_at`
                            FROM `jurnal_penyesuaians` jp
                            JOIN `jurnal_penyesuaian_details` jpd ON jp.id = jpd.`jurnal_penyesuaian_id`
                            JOIN `akuns` ON jpd.`akun_id` = `akuns`.`id`
                          ) AS buku_besar
                            ORDER BY `created_at` DESC
                    ) AS neraca_saldo
                    WHERE MONTH(`date`) = '" . $this->bulan . "'
                    AND YEAR(`date`) = '" . $this->tahun . "'
                    GROUP BY akun_id";
            $this->query = DB::select($query);

            for ($i = 0; $i < count($this->query); $i++) {
                if ($this->query[$i]->debet != '-') {
                    $this->sumDebet = $this->sumDebet + $this->query[$i]->debet;
                }
            }

            for ($i = 0; $i < count($this->query); $i++) {
                if ($this->query[$i]->kredit != '-') {
                    $this->sumKredit = $this->sumKredit + $this->query[$i]->kredit;
                }
            }
        } else {
            session()->forget('bulan_filter');
            $this->query = [];
            $this->sumDebet = 0;
            $this->sumKredit = 0;
        }
    }

    public function print()
    {   
        $neraca_saldo = [];
        $tahun = '';
        $bulan = '';
        $sumDebet = 0;
        $sumKredit = 0;

        if (session()->has('bulan_filter')) {
            $bulan_filter = explode('-', session('bulan_filter'));
            $tahun = $bulan_filter[0];
            $bulan = $bulan_filter[1];

            $query = "SELECT `id`, `date`, `akun_id`, `no_account`, `name_account`,
                        CASE
                            WHEN `debet` = '-' THEN '-'
                            ELSE CAST(`saldo_akhir` AS DOUBLE)
                        END AS `debet`,
                        CASE
                            WHEN `kredit` = '-' THEN '-'
                            ELSE CAST(`saldo_akhir` AS DOUBLE)
                        END AS `kredit`
                    FROM (
                          SELECT `id`, `date`, `akun_id`, `no_account`, `name_account`, 
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
                            SELECT jm.`id`, jm.`date`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jmd.`debet`, jmd.`kredit`
                                , jm.`created_at`
                            FROM `jurnal_memorials` jm
                            JOIN `jurnal_memorial_details` jmd ON jm.id = jmd.`jurnal_memorial_id`
                            JOIN `akuns` ON jmd.`akun_id` = `akuns`.`id`

                            UNION ALL

                            SELECT jp.`id`, jp.`date`, `akuns`.id AS akun_id, `akuns`.`no_account`, `akuns`.`name_account`, akuns.`type_account`,
                                jpd.`debet`, jpd.`kredit`
                                , jp.`created_at`
                            FROM `jurnal_penyesuaians` jp
                            JOIN `jurnal_penyesuaian_details` jpd ON jp.id = jpd.`jurnal_penyesuaian_id`
                            JOIN `akuns` ON jpd.`akun_id` = `akuns`.`id`
                          ) AS buku_besar
                            ORDER BY `created_at` DESC
                    ) AS neraca_saldo
                    WHERE MONTH(`date`) = '" . $bulan . "'
                    AND YEAR(`date`) = '" . $tahun . "'
                    GROUP BY akun_id";
            $neraca_saldo = DB::select($query);

            for ($i = 0; $i < count($neraca_saldo); $i++) {
                if ($neraca_saldo[$i]->debet != '-') {
                    $sumDebet = $sumDebet + $neraca_saldo[$i]->debet;
                }
            }

            for ($i = 0; $i < count($neraca_saldo); $i++) {
                if ($neraca_saldo[$i]->kredit != '-') {
                    $sumKredit = $sumKredit + $neraca_saldo[$i]->kredit;
                }
            }
        }

        $data = [
            "title" => "Neraca Saldo | " . date('F Y', strtotime(session('bulan_filter'))),
            "mergeData" => [0123],
            "neraca_saldo" => $neraca_saldo,
            "sumDebet" => $sumDebet,
            "sumKredit" => $sumKredit,
            "bulan" => date('F Y', strtotime(session('bulan_filter')))
        ];

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($pdfOptions);
        $paperSize = 'A4';
        $paperOrientation = 'portrait';
        $config = app(Repository::class);
        $files = app(Filesystem::class);
        $view = app(Factory::class);
        $pdf = new PDF($dompdf, $config, $files, $view, $paperSize, $paperOrientation);
        $pdf->loadView('documents.print-neraca-saldo', $data);
        return $pdf->stream('documents.print-neraca-saldo');
        // return view('NeracaSaldo.print');
    }
}
