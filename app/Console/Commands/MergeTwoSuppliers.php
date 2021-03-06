<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MergeTwoSuppliers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:merge2suppliers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        DB::disableQueryLog();
//        $supplier_1 = DB::table('supplier_1')
//            ->select('codart as code', 'descrizione_aggiuntiva as nome', 'descrizione_articolo as description',
//                DB::raw("CAST(prezzolistino AS DECIMAL(10, 2)) AS price"),
//                DB::raw("CAST(disponibilita AS UNSIGNED) AS stock"),
//                DB::raw("CAST(ean AS UNSIGNED) AS ean"),
//                DB::raw("CAST(spesespedizione AS DECIMAL(10, 2)) AS shipping_cost"),
//                'categoria as category', 'descrizione_marca as brand')
//            ->get()->toArray();
//
//
//        $supplier_1 = array_map(function ($value) {
//            return (array)$value;
//        }, $supplier_1);
//
//        foreach (array_chunk($supplier_1,1000) as $chunk_data) {
//            DB::table('products_suppliers')->insert($chunk_data);
//        }
//
//        unset($supplier_1);
//
//        $supplier_2 = DB::table('supplier_2')
//            ->select('codice as code', 'nome as nome', 'descrizione as description',
//                DB::raw("CAST(prezzo AS DECIMAL(10, 2)) AS price"),
//                DB::raw("CAST(pezzi AS UNSIGNED) AS stock"),
//                DB::raw("CAST(ean AS UNSIGNED) AS ean"),
//                'categoria as category', 'produttore as brand')
//            ->get()->toArray();
//
//        $supplier_2 = array_map(function ($value) {
//            return (array)$value;
//        }, $supplier_2);
//
//        foreach (array_chunk($supplier_2,1000) as $chunk_data) {
//            DB::table('products_suppliers')->insert($chunk_data);
//        }
//
//        unset($supplier_2);
//
//
        $products = DB::table('products_suppliers')
                        ->select('nome AS name', 'code', 'description', 'price', 'stock', 'shipping_cost', 'category', 'brand', 'products_suppliers.ean')
                        ->join(
                                DB::raw('(SELECT ean , MIN(price) MinPrice
                                                FROM products_suppliers
                                                GROUP BY ean) grouped'),
                                function ($join) {
                                    $join->on('products_suppliers.ean', '=', 'grouped.ean')
                                         ->on('products_suppliers.price', '=', 'grouped.MinPrice');
                                })
                        ->get()->toArray();

//        dd(count($products));
//
        $products = array_map(function ($value) {
            return (array)$value;
        }, $products);

        foreach (array_chunk($products,500) as $chunk_data)
            DB::table('products2')->upsert($chunk_data, 'ean');

//        $duplicates = DB::table('products_suppliers')
//            ->select('ean', (DB::raw('COUNT(ean)')))
//            ->groupBy('ean')
//            ->havingRaw('COUNT(ean) > 1')
//            ->get();
//        dd($duplicates);
        return Command::SUCCESS;
    }
}
