<?php

namespace App\Http\Controllers;

use ClaudioDekker\WordGenerator\Generator;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\CreateShortUrlRequest;
use App\Http\Requests\RedirectShortUrl;
use Illuminate\Http\Request;
use App\Models\Url;
use Carbon\Carbon;

class UrlController extends Controller
{
  public function newShortUrl(CreateShortUrlRequest $request)
  {
    $generator = new Generator();
    $url = new Url();
    $urlName = isset($request->customUrlName) ? $request->customUrlName : $generator->generate('-');
    $expiration = isset($request->expiration) ? Carbon::now()->addDays($request->expiration) : Carbon::now()->addDays(3);
    $baseUrl = url('/').'/api/redirect/?identifier=';

    return $url->create([
      'url' => $request->url,
      'identifier' => $urlName,
      'short_url' => $baseUrl.$urlName,
      'expiration' => $expiration,
    ]);
  }

  public function redirect(RedirectShortUrl $request) 
  {
    $url = new Url();
    $url = $url->where('identifier', $request->identifier)->first();
    if (!isset($url)) {
      return response()->json(['success' => 'false', 'message' => 'the requested URL does not exist'], 404);
    }
    return redirect()->to($url->url);
  }
}
