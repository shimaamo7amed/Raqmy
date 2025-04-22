<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('', function () {
    $routeCollection = Route::getRoutes();

    echo "<table style='width:100%;  border: 1px solid black; border-collapse: collapse;' >";
    echo "<tr style='  border: 1px solid black; border-collapse: collapse;' >";
    echo "<td width='10%' style='border: 1px solid black; border-collapse: collapse;'><h4>HTTP Method</h4></td>";
    echo "<td width='30%' style='border: 1px solid black; border-collapse: collapse;'><h4>Route</h4></td>";
    echo "<td width='30%' style='border: 1px solid black; border-collapse: collapse;'><h4>Route</h4></td>";
    echo "<td width='10%' style='border: 1px solid black; border-collapse: collapse;'><h4>Name</h4></td>";
    echo "<td width='50%' style='border: 1px solid black; border-collapse: collapse;'><h4>Corresponding Action</h4></td>";
    echo "</tr>";
    foreach ($routeCollection as $value) {
        echo "<tr>";
        echo "<td style='border: 1px solid black; border-collapse: collapse;'>" . $value->methods()[0] . "</td>";
        echo "<td style='border: 1px solid black; border-collapse: collapse;'><a target='_blank' href='" . url('') . '/' . $value->uri() . "'>" . url('') . '/' . $value->uri() . "</a></td>";
        echo "<td style='border: 1px solid black; border-collapse: collapse;'>" . url("") . "/" . $value->uri() . "</td>";
        echo "<td style='border: 1px solid black; border-collapse: collapse;'>" . $value->getName() . "</td>";
        echo "<td style='border: 1px solid black; border-collapse: collapse;'>" . $value->getActionName() . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    $value = "i love laravel";
    // $data =
    //     \Center\Http\Services\system\CenterSystemRuleGroupServices::GetSystemRules();
    // return $data;
});
Route::get('mail', function () {
    $data = [
        'code_array' => str_split(123456)
    ];
    return view("mails.verify", $data);
});

Route::get('change-language/{lang}', function ($lang) {
    if (in_array($lang, ['ar', 'en'])) {
        session(['locale' => $lang]);
        app()->setLocale($lang);
    }
    return redirect()->back();
})->name('change-language');
