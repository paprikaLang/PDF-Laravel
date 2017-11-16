<?php
use Illuminate\Support\Facades\App;
use Barryvdh\Snappy\Facades\SnappyImage;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $snappy = App::make('snappy.pdf');
    //to file
    $html = '<h1>Paprika</h1><p>Hello World!</p>';
    $snappy->generateFromHtml($html,'/tmp/hello.pdf');
    $snappy->generate('http://www.github.com','/tmp/github.pdf');
    //output
    return new \Illuminate\Http\Response(
        $snappy->getOutputFromHtml($html),
        200,
        array(
            'Content-Type'   =>'application/pdf',
            'Content-Disposition'  => 'attachment; filename="file.pdf"'
        )
    );
});
Route::get('/web', function (Request $request) {
    $snappy = App::make('snappy.pdf');
    $name = $request -> name;
    $snappy->generate($name,'/tmp/web.pdf');
    //output
    return new \Illuminate\Http\Response(
        $snappy->getOutput($name),
        200,
        array(
            'Content-Type'   =>'application/pdf',
            'Content-Disposition'  => 'attachment; filename="web.pdf"'
        )
    );
});